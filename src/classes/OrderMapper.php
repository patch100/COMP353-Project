<?php
class OrderMapper extends Mapper
{    
    /**
     * Gets a list of orders
     *
     * @return [OrderEntity]  List of orders
     */
    public function getOrders() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new OrderEntity($row);
        //}
        $dummy = [];
        $results[] = new OrderEntity($dummy);

        return $results;
    }

    /**
     * Get one order by its ID
     *
     * @param int $id The ID of the order
     * @return OrderEntity  The order
     */
    public function getOrderById($id) {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->prepare($sql);
        //$result = $stmt->execute(["customer_id" => $customer_id]);
        //if($result) {
        //    return new OrderEntity($stmt->fetch());
        //}
        $dummy = [];
        return new OrderEntity($dummy);
    }

    /**
     * Save a order
     *
     * @param OrderEntity the order object
     */
    public function save(OrderEntity $order) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "insert into orders (name, address, phone) values (:name, :address, :phone)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $order->getName(),
            "address" => $order->getAddress(),
            "phone" => $order->getPhone(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    /**
     * Delete a order
     *
     * @param OrderEntity the order object
     */
    public function delete(OrderEntity $order) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "DELETE FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $order->getId()
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}