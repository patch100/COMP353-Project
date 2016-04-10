<?php
class DepartmentMapper extends Mapper
{    
    /**
     * Gets a list of departments
     *
     * @return [DepartmentEntity]  List of departments
     */
    public function getDepartments() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new DepartmentEntity($row);
        //}
        $dummy = [];
        $results[] = new DepartmentEntity($dummy);

        return $results;
    }

    /**
     * Get one department by its ID
     *
     * @param int $department_id The ID of the department
     * @return DepartmentEntity  The department
     */
    public function getDepartmentById($department_id) {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->prepare($sql);
        //$result = $stmt->execute(["department_id" => $department_id]);
        //if($result) {
        //    return new DepartmentEntity($stmt->fetch());
        //}
        $dummy = [];
        return new DepartmentEntity($dummy);
    }


    /**
     * Save a department
     *
     * @param DepartmentEntity the department object
     */
    public function save(DepartmentEntity $department) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "insert into departments (name, room_number, fax, phone_1, phone_2) values (:name, :room_number, :fax, :phone_1, :phone_2)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $department->getName(),
            "room_number" => $department->getRoomNumber(),
            "fax" => $department->getFax(),
            "phone_1" => $department->getPhoneOne(),
            "phone_2" => $department->getPhoneTwo(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    /**
     * Delete a department
     *
     * @param DepartmentEntity the department object
     */
    public function delete(DepartmentEntity $department) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "DELETE FROM departments WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $department->getId()
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}