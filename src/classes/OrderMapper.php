<?php
class OrderMapper extends Mapper
{    
    /**
     * Gets a list of orders
     *
     * @return [OrderEntity]  List of orders
     */
    public function getOrders() {
        $sql = "SELECT * FROM Orders";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = new OrderEntity($row);
        }

        return $results;
    }

    /**
     * Get one order by its ID
     *
     * @param int $id The ID of the order
     * @return OrderEntity  The order
     */
    public function getOrderById($id) {
        $sql = "SELECT * FROM Orders WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $id]);
        if($result) {
           return new OrderEntity($stmt->fetch());
        }
        return new OrderEntity($dummy);
    }

    /**
     * save a order
     * TODO Fix save
     * @param OrderEntity the order object
     */
    public function save(OrderEntity $order) {
        $id = (int)$this->count() + 1;
        $sql = "INSERT INTO Orders (Id, PaymentMethod, DateOfPurchase, Balance) VALUES (:id, :method, :date_m, :total)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id,
            "mehod" => $order->getMethod(),
            "date_m" => $order->getDate(),
            "total" => $order->getTotal(),
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

            /**
     * Update a Order
     *
     * @param OrderEntity the order object
     */
    public function update(OrderEntity $order) {
        $sql = "UPDATE Orders SET PaymentMethod = :method, DateOfPurchase = :date_m, Balance = :total WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "method" => $order->getMethod(),
            "date_m" => $order->getDate(),
            "total" => $order->getTotal(),
            "id" => (int)$order->getId(),
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    /**
     * count 
     *
     * @param 
     */
    public function count() {
        $sql = "SELECT Id FROM Orders ORDER BY Id DESC LIMIT 1";
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
     * Delete a order
     *
     * @param OrderEntity the order object
     */
    public function delete(OrderEntity $order) {
        $sql = "DELETE FROM Orders WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $order->getId()]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}