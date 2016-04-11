<?php
class ProductQueryEntity
{
    // columns: name, orders, quantity
    protected $name;
    protected $orders;
    protected $quantity;

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
        $this->name = "Fire Truck";
        $this->orders = 10;
        $this->quantity = 100;
    }

    public function getName() {
        return $this->name;
    }

    public function getOrders() {
        return $this->orders;
    }

    public function getQuantity() {
        return $this->quantity;
    }
}