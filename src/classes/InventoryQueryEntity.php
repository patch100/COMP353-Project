<?php
class InventoryQueryEntity
{
    // columns: name, orders, quantity
    protected $name;
    protected $average;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        //TODO UNCOMMENT AND SET PROPER DATA
        // if(isset($data['id'])) {
        //     $this->id = $data['id'];
        // }
        // $this->name = $data['name'];
        // $this->address = $data['address'];
        // $this->phone = $data['phone'];
        #$this->name = "Fire Truck";
        #$this->orders = 10;
        #$this->quantity = 100;

        #if(isset($data['name'])) { $this->name = $data['name']; }
        if(isset($data['Name'])) { $this->name = $data['Name']; }
        if(isset($data['average'])) { $this->average = $data['average']; }
    }

    public function getName() {
        return $this->name;
    }

    public function getAverage() {
        return $this->average;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAverage($average) {
        $this->average = $average;
    }
}