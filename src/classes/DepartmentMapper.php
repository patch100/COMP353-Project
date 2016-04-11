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
     * Gets a list of departments
     *
     * @return [DepartmentEntity]  List of departments
     */
    public function processQuery($id) {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new DepartmentEntity($row);
        //}

        // First gets the employees according to the department ID

        $get_employees_sql = "SELECT e.Id, e.Name
                FROM Employee e
                WHERE e.Id IN 
                    (SELECT he.EmpId
                        FROM HasEmployees he
                        WHERE he.DeptId IN 
                            (SELECT d.Id
                                FROM Department d
                                WHERE d.Id = $id));";

        $stmt = $this->db->query($get_employees_sql);
        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = new DepartmentEntity($row);
        }

        foreach ($results as $value) {
            $employee_id = $value->getId();

            $get_parttime_employee_sql = "SELECT Id
                FROM PartTimeEmployee
                WHERE Id = $employee_id;";

            $stmt = $this->db->query($get_parttime_employee_sql);

            $row = $stmt->fetch();

            if ($row) # Employee is part-time
                $value->setStatus('Part-Time'); # No time to define constants
            else {
                $get_fulltime_employee_sql = 
                "SELECT Id
                FROM FullTimeEmployee
                WHERE Id = $employee_id;
                ";

                $stmt = $this->db->query($get_fulltime_employee_sql);
                $row = $stmt->fetch();

                if ($row)
                    $value->setStatus('Full-Time'); # No time to define constants
                else
                    throw new Exception("Employee ID $employee_id not in Part-time nor in Full-time tables.");
            }

            $get_count_of_dependants = "SELECT COUNT(ed.name) as count
                FROM EmployeeDependant ed
                WHERE ed.SSN IN (
                    SELECT icg.SSN
                        FROM IsCareGiver icg
                        WHERE icg.id = $employee_id)";

            $stmt = $this->db->query($get_count_of_dependants);
            $row = $stmt->fetch();

            if ($row)
                $value->setCountDependents($row['count']);
            else
                $value->setCountDependents(0);
        }

        #$dummy = [];
        #$results[] = new DepartmentEntity($dummy);

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
        $id = $this->count() + 1;
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