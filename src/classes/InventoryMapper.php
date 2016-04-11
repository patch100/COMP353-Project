<?php
class InventoryMapper extends Mapper
{    
    /**
     * Gets a inventory
     *
     * @return [InventoryEntity]  List of items
     */
    public function getItems() {
        $sql = "SELECT * FROM Inventory";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $inv_item = new InventoryEntity($row);
           $item_mapper = new ItemMapper($this->db);
           $item = $item_mapper->getItemById($inv_item->getId());
           $inv_item->setItem($item);
           $results[] = $inv_item;
        }
        return $results;
    }

    /**
     * Get one item by its ID
     *
     * @param int $id The ID of the item
     * @return InventoryEntity  The item
     */
    public function getItemById($id) {
        $sql = "SELECT * FROM Inventory where ItemId = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $id]);
        if($result) {
           return new InventoryEntity($stmt->fetch());
        }
    }

    /**
     * Save a item
     *
     * @param InventoryEntity the item object
     */
    public function save(InventoryEntity $item) {
        $sql = "insert into Inventory (ItemId, Quantity, Price, DateOfManufacture) values (:itemId, :units, :price, :date)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "itemId" => $item->getId(),
            "units" => $item->getUnits(),
            "price" => $item->getPrice(),
            "date" => $item->getDate(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    /**
     * Save a item
     *
     * @param InventoryEntity the item object
     */
    public function update(InventoryEntity $item) {
        $sql = "UPDATE Inventory SET Quantity = :units, Price = :price, DateOfManufacture = :date_m WHERE ItemId = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "units" => $item->getUnits(),
            "price" => $item->getPrice(),
            "date_m" => $item->getDate(),
            "id" => $item->getId(),
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }
}