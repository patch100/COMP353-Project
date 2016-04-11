<?php
class EmployeeMapper extends Mapper
{    
    /**
     * Gets a list of employees
     *
     * @return [EmployeeEntity]  List of employee
     */
    public function getEmployees() {
        $sql = "SELECT * FROM Employee";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = new EmployeeEntity($row);
        }

        return $results;
    }

        /**
     * Gets a list of dependants
     *
     * @return [EmployeeEntity]  List of employee
     */
    public function getDependants(EmployeeEntity $employee) {
        $dependant_mapper = new DependantMapper($this->db);
        $sql = "SELECT SSN FROM IsCareGiver WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $employee->getId()]);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = $dependant_mapper->getDependantById($row['SSN']);
        }

        return $results;
    }

    /**
     * Get one employee by its ID
     *
     * @param int $id The ID of the Employee
     * @return EmployeeEntity  The Employee
     */
    public function getEmployeeById($id) {
        $sql = "SELECT * FROM Employee WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $id]);
        if($result) {
           return new EmployeeEntity($stmt->fetch());
        }
    }


    /**
     * Save a Employee
     *
     * @param EmployeeEntity the Employee object
     */
    public function save(EmployeeEntity $employee, $data) {
        $id = $this->count() + 1;
        $sql = "insert into Employee (Id, Name, SSN, DateOfBirth, Address, Telephone, Position, email) values (:id, :name, :sin, :dob, :address, :phone, :position, :email)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id,
            "name" => $employee->getName(),
            "sin" => $employee->getSin(),
            "dob" => $employee->getDob(),
            "address" => $employee->getAddress(),
            "phone" => $employee->getPhone(),
            "position" => $employee->getPosition(),
            "email" => $employee->getEmail(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }

        $sql = "insert into HasEmployees (DeptId, EmpId, IsManager, StartDate, EndDate) values (:deptId, :empId, :manager, :start, :end)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "deptId" => (int)$data['deptId'],
            "empId" => $id,
            "manager" => $data['manager'],
            "start" => $data['start'],
            "end" => $data['end'],
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

        /**
     * Update a Employee
     *
     * @param EmployeeEntity the employee object
     */
    public function update(EmployeeEntity $employee, $data) {
        $sql = "update Employee SET Name = :name, Address = :address, Telephone = :phone, DateOfBirth = :dob, SSN = :sin, Position = :position, email = :email where Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $employee->getName(),
            "address" => $employee->getAddress(),
            "phone" => $employee->getPhone(),
            "dob" => $employee->getDob(),
            "sin" => $employee->getSin(),
            "position" => $employee->getPosition(),
            "email" => $employee->getEmail(),
            "id" => (int)$employee->getId(),
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }

        $sql = "update HasEmployees SET DeptId = :deptId, IsManager = :manager, StartDate = :start, EndDate = :end where EmpId = :empId";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "deptId" => (int)$data['deptId'],
            "empId" => $employee->getId(),
            "manager" => $data['manager'],
            "start" => $data['start'],
            "end" => $data['end'],
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
        $sql = "SELECT Id FROM Employee ORDER BY Id DESC LIMIT 1";
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
     * Delete a Employee
     *
     * @param EmployeeEntity the Employee object
     */
    public function delete(EmployeeEntity $employee) {
        $sql = "DELETE FROM Employee WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $employee->getId()]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}