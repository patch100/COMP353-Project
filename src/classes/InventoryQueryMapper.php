<?php
class InventoryQueryMapper extends Mapper
{    
    /**
     * Gets a list of products
     *
     * @return [ProductQuery]  List of products
     */

    public function processQuery($date) {
        $get_inventory_sql = "SELECT Item.Name, round(avg(ItemsOrdered.Quantity * Inventory.Price),2) as average
            FROM Item natural join ItemsOrdered
            join Orders on ItemsOrdered.OrderId = Orders.Id
            join Inventory on Item.Id = Inventory.ItemId
            WHERE Orders.DateOfPurchase > $date
            GROUP BY Item.Name
            ORDER BY average desc;";

        $stmt = $this->db->query($get_inventory_sql);
        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = new InventoryQueryEntity($row);
        }

        return $results;
    }
}