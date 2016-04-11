<?php
class InventoryEntity
{   
    protected $itemId;
    protected $date;
    protected $price;
    protected $units;
    protected $item;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        if(isset($data['ItemId'])) {
            $this->itemId = $data['ItemId'];
        }

        $this->date = $data['DateOfManufacture'];
        $this->price = $data['Price'];
        $this->units = $data['Quantity'];
    }

    public function getId() {
        return $this->itemId;
    }

    public function getItem() {
        return $this->item;
    }

    public function getDate() {
        return $this->date;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getUnits() {
        return $this->units;
    }

    public function setItem($item) {
        $this->item = $item;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setUnits($units) {
        $this->units = $units;
    }
}