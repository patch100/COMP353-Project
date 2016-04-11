<?php
class ProductQueryMapper extends Mapper
{    
    /**
     * Gets a list of products
     *
     * @return [ProductQuery]  List of products
     */
    public function getProducts() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new CustomerEntity($row);
        //}
        $dummy = [];
        $results[] = new ProductQueryEntity($dummy);

        return $results;
    }
}