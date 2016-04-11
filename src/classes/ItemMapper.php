<?php
class ItemMapper extends Mapper
{    
    /**
     * Gets a list of items
     *
     * @return [ItemEntity]  List of items
     */
    public function getItems() {
        $sql = "SELECT * FROM Item";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = new ItemEntity($row);
        }

        return $results;
    }

    /**
     * Get one item by its ID
     *
     * @param int $id The ID of the item
     * @return iItemEntity  The item
     */
    public function getItemById($id) {
        $sql = "SELECT * FROM Item where Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $id]);
        if($result) {
           return new ItemEntity($stmt->fetch());
        }
    }

    /**
     * Save a item
     *
     * @param ItemEntity the item object
     */
    public function save(ItemEntity $item) {
        $id = $this->count() + 1;
        $sql = "insert into Item (Id, Name) values (:id, :name)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id,
            "name" => $item->getName(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }

        $sql = "insert into HasColor (ItemId, Color) values (:id, :color)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id,
            "color" => $item->getColor(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

        /**
     * count 
     *
     * @param 
     */
    public function count() {
        $sql = "select Id from Item order by Id desc limit 1";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $count = 0;
        if($result) {
           $row = $stmt->fetch();
           $count = (int)$row['Id'];
        }
        
        return $count;
    } 

    /**
     * Update a customer
     *
     * @param item 
     */
    public function update(ItemEntity $item) {
        $sql = "update Item SET Name = :name WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $item->getName(),
            "id" => $item->getId(),
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }

        $sql = "update HasColor set Color = :color where ItemId = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "color" => $item->getColor(),
            "id" => $item->getId(),
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
        $sql = "delete from Item where Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $item->getId()
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}