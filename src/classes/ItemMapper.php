<?php
class ItemMapper extends Mapper
{    
    /**
     * Gets a list of items
     *
     * @return [ItemEntity]  List of items
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
        $results[] = new ItemEntity($dummy);

        return $results;
    }

    /**
     * Get one item by its ID
     *
     * @param int $id The ID of the item
     * @return iItemEntity  The item
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
        return new ItemEntity($dummy);
    }

    /**
     * Save a item
     *
     * @param ItemEntity the item object
     */
    public function save(ItemEntity $item) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "insert into items (name, color) values (:name, :color)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $customer->getName(),
            "color" => $customer->getAddress(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    /**
     * Delete a Item
     *
     * @param ItemEntity the Item object
     */
    public function delete(ItemEntity $item) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "DELETE FROM items WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $item->getId()
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}