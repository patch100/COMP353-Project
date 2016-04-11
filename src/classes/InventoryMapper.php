<?php
class InventoryMapper extends Mapper
{    
    /**
     * Gets a inventory
     *
     * @return [InventoryEntity]  List of items
     */
    public function getItems() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new CustomerEntity($row);
        //}
        $dummy = [];
        $results[] = new InventoryEntity($dummy);

        return $results;
    }

    /**
     * Get one item by its ID
     *
     * @param int $id The ID of the item
     * @return InventoryEntity  The item
     */
    public function getItemById($id) {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->prepare($sql);
        //$result = $stmt->execute(["customer_id" => $customer_id]);
        //if($result) {
        //    return new CustomerEntity($stmt->fetch());
        //}
        $dummy = [];
        return new InventoryEntity($dummy);
    }

    /**
     * Save a item
     *
     * @param InventoryEntity the item object
     */
    public function save(InventoryEntity $item) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "insert into inventory (name, itemId, units, price, date) values (:name, :itemId, :units, :price, :date)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $item->getName(),
            "itemId" => $item->getItemId(),
            "units" => $item->getUnits(),
            "price" => $item->getPrice(),
            "date" => $item->getDate(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}