<?php
class DependantMapper extends Mapper
{    
    /**
     * Gets a list of dependants
     *
     * @return [DependantEntity]  List of dependants
     */
    public function getDependants() {
        $sql = "SELECT * FROM EmployeeDependant";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = new DependantEntity($row);
        }

        return $results;
    }

    /**
     * Get one dependant by its ID
     *
     * @param int $id The ID of the Dependant
     * @return DependantEntity  The Dependant
     */
    public function getDependantById($id) {
        $sql = "SELECT * FROM EmployeeDependant WHERE SSN = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $id]);
        if($result) {
           return new DependantEntity($stmt->fetch());
        }
    }


    /**
     * Save a Dependant
     *
     * @param DependantEntity the Dependant object
     */
    public function save(DependantEntity $dependant) {
        $sql = "insert into EmployeeDependant (Name, SSN, DateOfBirth) values (:name, :sin, :dob)";
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
     * Save a Dependant
     *
     * @param DependantEntity the Dependant object
     */
    public function updateCareGiver($employee_id, $dependant) {
        $sql = "insert into IsCareGiver (Id, SSN) values (:id, :sin)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => (int)$employee_id,
            "sin" => (int)$dependant->getSin(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

            /**
     * Update a DependantEntity
     *
     * @param DependantEntity the DependantEntity object
     */
    public function update(DependantEntity $dependant) {
        $sql = "UPDATE EmployeeDependant SET Name = :name, DateOfBirth = :dob WHERE SSN = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $dependant->getName(),
            "dob" => $dependant->getDob(),
            "id" => (int)$dependant->getSin(),
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    } 

    /**
     * Delete a dependant
     *
     * @param DependantEntity the department object
     */
    public function delete(DependantEntity $dependant) {
        $sql = "DELETE FROM EmployeeDependant WHERE SSN = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $dependant->getSin()
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}