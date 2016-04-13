<?php
class InvoicesQueryMapper extends Mapper
{    
    /**
     * Gets a list of products
     *
     * @return [ProductQuery]  List of products
     */

    public function processQuery($name, $orderId) {

        $customer_info_sql = "SELECT Name , Telephone, Address
            FROM Customer
            WHERE Name = '$name';";

        $stmt = $this->db->query($customer_info_sql);
        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = new InvoicesQueryEntity($row);
        }

        foreach ($results as $value) {
            $customer_name = $value->getName();

            $order_info_sql = "SELECT DateOfPurchase, Balance
                FROM Orders join HasOrdered on Id = OrderId
                WHERE CNumber = (
                    SELECT CustomerNumber
                    FROM Customer
                    WHERE Name = '$customer_name'
                ) AND OrderId = $orderId;";

            $stmt = $this->db->query($order_info_sql);

            $row = $stmt->fetch();

            if ($row) {
                $value->setDateOfPurchase($row['DateOfPurchase']);
                $value->setBalance($row['Balance']);
            }

            $items_information_sql = "SELECT Name, ItemsOrdered.Quantity, Price
                FROM ItemsOrdered
                join Item on ItemsOrdered.ItemId = Item.Id
                join Inventory on Item.Id = Inventory.ItemId
                WHERE OrderId = $orderId;";

            $stmt = $this->db->query($items_information_sql);


            while($row = $stmt->fetch()) {
                $item_array = [];

                $item_array[] = $row['Name'];
                $item_array[] = $row['Quantity'];
                $item_array[] = $row['Price'];

                $value->addItem($item_array);
            }

            $payment_sql = "SELECT PaymentDate, Amount 
                FROM Payment
                WHERE OrderId = $orderId;";

            $stmt = $this->db->query($payment_sql);
            $row = $stmt->fetch();

            if ($row) {
                $value->setPaymentDate($row['PaymentDate']);
                $value->setAmount($row['Amount']);
            }
        }

        return $results;
    }
}