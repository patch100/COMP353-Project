<?php
class CustomerQueryEntity
{
    protected $name;
    protected $totalItemsOrdered;
    protected $grandTotal;

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
        if(isset($data['total_items_ordered'])) { $this->totalItemsOrdered = $data['total_items_ordered']; }
        if(isset($data['grand_total'])) { $this->grandTotal = $data['grand_total']; }
    }

    public function getName() {
        return $this->name;
    }

    public function getTotalItemsOrdered() {
        return $this->totalItemsOrdered;
    }

    public function getGrandTotal() {
        return $this->grandTotal;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setTotalItemsOrdered($totalItemsOrdered) {
         $this->totalItemsOrdered = $totalItemsOrdered;
    }
}