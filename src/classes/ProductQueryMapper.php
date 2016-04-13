<?php
class ProductQueryMapper extends Mapper
{    
    /**
     * Gets a list of products
     *
     * @return [ProductQuery]  List of products
     */
    public function getProducts() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new CustomerEntity($row);
        //}
        $dummy = [];
        $results[] = new ProductQueryEntity($dummy);

        return $results;
    }

    public function processQuery() {
        $get_top3_products_sql = "SELECT io.ItemId as id, SUM(io.Quantity) as quantity, COUNT(io.OrderId) as orders
            FROM ItemsOrdered io
            WHERE io.OrderId IN (
                SELECT o.Id
                FROM Orders o
                WHERE o.DateOfPurchase < DATE_ADD(NOW(), INTERVAL -12 MONTH))
            GROUP BY io.ItemId";

        $stmt = $this->db->query($get_top3_products_sql);
        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = new ProductQueryEntity($row);
        }

        foreach ($results as $value) {
            $item_id = $value->getId();

            $get_item_name_sql = "SELECT Name
                FROM Item
                WHERE Id = $item_id";

            $stmt = $this->db->query($get_item_name_sql);
            $row = $stmt->fetch();

            if ($row)
                $value->setName($row['Name']);
            else
                throw new Exception("Item ID $item_id does not exists in item table");
        }

        $top3 = [];

        $results_copy = array();
        $results_copy = $results;

        for($i = 0; $i < 3; $i++) { # Dumbest implementation of a sort ever.
            $highest_valued_item = $this->getHighestValueItem($results_copy); # Mutative call on results_copy
            if (!in_array($highest_valued_item, $top3))
                array_push($top3, $highest_valued_item);
        }  

        return $top3;
    }

    private function getHighestValueItem(&$items) {
        $highest_value = 0;
        $highest_value_item = NULL;
        $index = 0;

        foreach ($items as $item) {
            $item_id = $item->getId();

            $get_price_of_item = "SELECT Price
                FROM Inventory
                WHERE ItemId = $item_id";

            $stmt = $this->db->query($get_price_of_item);
            $row = $stmt->fetch();

            if ($row) {
                $item_price = $row['Price'];

                $value = $item_price * $item->getQuantity();

                if ($value > $highest_value) {
                    $highest_value = $value;
                    $highest_value_item = $item;
                    unset($items[$index]);
                }
            }
            else
                throw new Exception("Item ID $item_id does not exists in inventory table");
            $index += 1;
        }
        return $highest_value_item;
    }
}