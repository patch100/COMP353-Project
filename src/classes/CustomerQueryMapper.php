<?php
class CustomerQueryMapper extends Mapper
{    
    /**
     * Gets a list of products
     *
     * @return [ProductQuery]  List of products
     */
    /*public function getProducts() {
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
    }*/

    public function processQuery() {
        $get_top3_customers_sql = "SELECT Name, sum(ItemsOrdered.Quantity) as total_items_ordered, round(sum(Price * ItemsOrdered.Quantity),2) as grand_total
            FROM ItemsOrdered natural join HasOrdered
            join Inventory on ItemsOrdered.ItemId = Inventory.ItemId
            join Customer on Customer.CustomerNumber = HasOrdered.CNumber
            join Orders on ItemsOrdered.OrderId = Orders.Id
            WHERE Orders.DateOfPurchase > date_sub(now(), interval 12 month)
            GROUP BY CNumber
            ORDER BY grand_total desc
            limit 3;";

        $stmt = $this->db->query($get_top3_customers_sql);
        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = new CustomerQueryEntity($row);
        }

        return $results;
    }

}