<?php
class CustomerMapper extends Mapper
{    
    /**
     * Gets a list of customers
     *
     * @return [CustomerEntity]  List of customers
     */
    public function getCustomers() {
        $sql = "select * from Customer";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = new CustomerEntity($row);
        }

        return $results;
    }

    /**
     * Get one customer by its ID
     *
     * @param int $customer_id The ID of the customer
     * @return CustomerEntity  The customer
     */
    public function getCustomerById($customer_id) {
        $sql = "SElECT * FROM Customer WHERE CustomerNumber = :customer_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["customer_id" => $customer_id]);
        if($result) {
           return new CustomerEntity($stmt->fetch());
        }
    }

    /**
     * Save a customer
     *
     * @param CustomerEntity the customer object
     */
    public function save(CustomerEntity $customer) {
        $id = $this->count() + 1;
        $sql = "insert into Customer (CustomerNumber, Name, Address, Telephone) values (:Number, :Name, :Address, :Telephone)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "Number" => $id,
            "Name" => $customer->getName(),
            "Address" => $customer->getAddress(),
            "Telephone" => $customer->getPhoneNumber(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    /**
     * Update a customer
     *
     * @param CustomerEntity the customer object
     */
    public function update(CustomerEntity $customer) {
        $sql = "UPDATE Customer SET Name = :name, Address = :address, Telephone = :phone WHERE CustomerNumber = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $customer->getName(),
            "address" => $customer->getAddress(),
            "phone" => $customer->getPhoneNumber(),
            "id" => (int)$customer->getId(),
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
        $sql = "SELECT CustomerNumber FROM Customer ORDER BY CustomerNumber DESC LIMIT 1;";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $count = 0;
        if($result) {
           $row = $stmt->fetch();
           $count = (int)$row['CustomerNumber'];
        }
        
        return $count;
    }   

    /**
     * Delete a customer
     *
     * @param CustomerEntity the customer object
     */
    public function delete(CustomerEntity $customer) {
        $sql = "DELETE FROM Customer WHERE CustomerNumber = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $customer->getId()]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
        return $result;
    }
}