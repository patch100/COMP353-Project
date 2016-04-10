<?php
class DependantMapper extends Mapper
{    
    /**
     * Gets a list of dependants
     *
     * @return [DependantEntity]  List of dependants
     */
    public function getDependants() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new DepartmentEntity($row);
        //}
        $dummy = [];
        $results[] = new DependantEntity($dummy);

        return $results;
    }

    /**
     * Get one dependant by its ID
     *
     * @param int $id The ID of the Dependant
     * @return DependantEntity  The Dependant
     */
    public function getDependantById($id) {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->prepare($sql);
        //$result = $stmt->execute(["department_id" => $department_id]);
        //if($result) {
        //    return new DepartmentEntity($stmt->fetch());
        //}
        $dummy = [];
        return new DependantEntity($dummy);
    }


    /**
     * Save a Dependant
     *
     * @param DependantEntity the Dependant object
     */
    public function save(DependantEntity $dependant) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "insert into dependants (name, sin, dob) values (:name, :sin, :dob)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $dependant->getName(),
            "sin" => $dependant->getSin(),
            "dob" => $dependant->getDob(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    /**
     * Delete a dependant
     *
     * @param DependantEntity the department object
     */
    public function delete(DependantEntity $dependant) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "DELETE FROM dependants WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $dependant->getId()
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}