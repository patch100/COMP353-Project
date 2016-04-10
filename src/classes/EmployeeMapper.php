<?php
class EmployeeMapper extends Mapper
{    
    /**
     * Gets a list of dependants
     *
     * @return [EmployeeEntity]  List of employee
     */
    public function getEmployees() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new DepartmentEntity($row);
        //}
        $dummy = [];
        $results[] = new EmployeeEntity($dummy);

        return $results;
    }

    /**
     * Get one employee by its ID
     *
     * @param int $id The ID of the Employee
     * @return EmployeeEntity  The Employee
     */
    public function getEmployeeById($id) {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->prepare($sql);
        //$result = $stmt->execute(["department_id" => $department_id]);
        //if($result) {
        //    return new DepartmentEntity($stmt->fetch());
        //}
        $dummy = [];
        return new EmployeeEntity($dummy);
    }


    /**
     * Save a Employee
     *
     * @param EmployeeEntity the Employee object
     */
    public function save(EmployeeEntity $employee) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "insert into employees (name, sin, dob, address, phone, position) values (:name, :sin, :dob, :address, :phone, :position)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $employee->getName(),
            "sin" => $employee->getSin(),
            "dob" => $employee->getDob(),
            "address" => $employee->getAddress(),
            "phone" => $employee->getPhone(),
            "position" => $employee->getPosition(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    /**
     * Delete a Employee
     *
     * @param EmployeeEntity the Employee object
     */
    public function delete(Employee $employee) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "DELETE FROM employee WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $employee->getId()
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}