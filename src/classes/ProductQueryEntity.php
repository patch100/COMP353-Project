<?php
class ProductQueryEntity
{
    // columns: name, orders, quantity
    protected $name;
    protected $orders;
    protected $quantity;
    protected $id;

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
        if(isset($data['id'])) { $this->id = $data['id']; }
        if(isset($data['orders'])) { $this->orders = $data['orders']; }
        if(isset($data['quantity'])) { $this->quantity = $data['quantity']; }
    }

    public function getId() {
        return $this->id;
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

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setOrders($orders) {
         $this->orders = $orders;
    }

    public function setQuantity($quantity) {
         $this->quantity = $quantity;
    }
}