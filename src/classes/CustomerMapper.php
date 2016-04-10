<?php
class CustomerMapper extends Mapper
{    
    /**
     * Gets a list of customers
     *
     * @return [CustomerEntity]  List of customers
     */
    public function getCustomers() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new CustomerEntity($row);
        //}
        $dummy = [];
        $results[] = new CustomerEntity($dummy);

        return $results;
    }

    /**
     * Get one customer by its ID
     *
     * @param int $customer_id The ID of the customer
     * @return CustomerEntity  The customer
     */
    public function getCustomerById($customer_id) {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->prepare($sql);
        //$result = $stmt->execute(["customer_id" => $customer_id]);
        //if($result) {
        //    return new CustomerEntity($stmt->fetch());
        //}
        $dummy = [];
        return new CustomerEntity($dummy);
    }

    /**
     * Save a customer
     *
     * @param CustomerEntity the customer object
     */
    public function save(CustomerEntity $customer) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "insert into customers (name, address, phone) values (:name, :address, :phone)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $customer->getName(),
            "address" => $customer->getAddress(),
            "phone" => $customer->getPhone(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

        /**
     * Delete a customer
     *
     * @param CustomerEntity the customer object
     */
    public function delete(CustomerEntity $customer) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "DELETE FROM customers WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $customer->getId()
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}