<?php
class ProductQueryEntity
{
    // columns: name, orders, quantity
    protected $name;
    protected $orders;
    protected $units;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        if(isset($data['Name'])) { $this->name = $data['Name']; }
        if(isset($data['UnitsSold'])) { $this->units = $data['UnitsSold']; }
        if(isset($data['NumberOfOrders'])) { $this->orders = $data['NumberOfOrders']; }
    }

    public function getName() {
        return $this->name;
    }

    public function getOrders() {
        return $this->orders;
    }

    public function getUnits() {
        return $this->units;
    }
}