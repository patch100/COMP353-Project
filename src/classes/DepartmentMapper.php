<?php
class DepartmentMapper extends Mapper
{    
    /**
     * Gets a list of departments
     *
     * @return [DepartmentEntity]  List of departments
     */
    public function getDepartments() {
        $sql = "SELECT * FROM Department";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = new DepartmentEntity($row);
        }
        return $results;
    }

    /**
     * Get one department by its ID
     *
     * @param int $department_id The ID of the department
     * @return DepartmentEntity  The department
     */
    public function getDepartmentById($department_id) {
        $sql = "SELECT * FROM Department WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $department_id]);
        if($result) {
           return new DepartmentEntity($stmt->fetch());
        }
    }


    /**
     * Save a department
     *
     * @param DepartmentEntity the department object
     */
    public function save(DepartmentEntity $department) {
        $id = $this->count();
        $sql = "insert into Department (Id, Name, PhoneNumber1, PhoneNumber2, RoomNumber, FaxNumber) values (:id, :name, :phone_1, :phone_2, :room_number, :fax)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id,
            "name" => $department->getName(),
            "phone_1" => $department->getPhoneOne(),
            "phone_2" => $department->getPhoneTwo(),
            "room_number" => $department->getRoomNumber(),
            "fax" => $department->getFax(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    /**
     * Update a department
     *
     * @param DepartmentEntity the department object
     */
    public function update(DepartmentEntity $department) {
        $sql = "UPDATE Department SET Name = :name, RoomNumber = :room_number, FaxNumber = :fax, PhoneNumber1 = :phone_1, PhoneNumber2 = :phone_2 WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $department->getName(),
            "room_number" => $department->getRoomNumber(),
            "fax" => $department->getFax(),
            "phone_1" => $department->getPhoneOne(),
            "phone_2" => $department->getPhoneTwo(),
            "id" => $department->getId(),
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
        $sql = "SELECT Id FROM Department ORDER BY Id DESC LIMIT 1;";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $count = 0;
        if($result) {
           $row = $stmt->fetch();
           $count = (int)$row['id'];
        }
        
        return $count;
    }   

    /**
     * Delete a department
     *
     * @param DepartmentEntity the department object
     */
    public function delete(DepartmentEntity $department) {
        $sql = "DELETE FROM Department WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $department->getId()]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}