<?php
class ColorMapper extends Mapper
{    
    /**
     * Gets a list of colors
     *
     * @return [Color]  List of colors
     */
    public function getColors() {
        $sql = "select * from Colors";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = new ColorEntity($row);
        }

        return $results;
    }
}