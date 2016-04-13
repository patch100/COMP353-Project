<?php
class ProductQueryMapper extends Mapper
{    
    public function processQuery() {
        $sql = "SELECT Item.Name, SUM(ItemsOrdered.Quantity) AS UnitsSold, COUNT(Item.Name) AS NumberOfOrders
From Item join ItemsOrdered on Item.Id = ItemsOrdered.ItemId
join  Orders on ItemsOrdered.OrderId = Orders.Id
join Inventory on ItemsOrdered.ItemId = Inventory.ItemId
WHERE Orders.DateOfPurchase > date_sub(now(), interval 12 month)
GROUP BY Item.Name
ORDER BY SUM(ItemsOrdered.Quantity)*Inventory.Price DESC
limit 3";

        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new ProductQueryEntity($row);
        }
        return $results;
    }

    // private function getHighestValueItem(&$items) {
    //     $highest_value = 0;
    //     $highest_value_item = NULL;
    //     $index = 0;

    //     foreach ($items as $item) {
    //         $item_id = $item->getId();

    //         $get_price_of_item = "SELECT Price
    //             FROM Inventory
    //             WHERE ItemId = $item_id";

    //         $stmt = $this->db->query($get_price_of_item);
    //         $row = $stmt->fetch();

    //         if ($row) {
    //             $item_price = $row['Price'];

    //             $value = $item_price * $item->getQuantity();

    //             if ($value > $highest_value) {
    //                 $highest_value = $value;
    //                 $highest_value_item = $item;
    //                 unset($items[$index]);
    //             }
    //         }
    //         else
    //             throw new Exception("Item ID $item_id does not exists in inventory table");
    //         $index += 1;
    //     }
    //     return $highest_value_item;
    // }
}