<?php
class InventoryEntity
{   
    protected $id;
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
        //TODO UNCOMMENT AND SET PROPER DATA
        // if(isset($data['id'])) {
        //     $this->id = $data['id'];
        // }
        // $this->name = $data['name'];
        // $this->address = $data['address'];
        // $this->phone = $data['phone'];
        $now = new DateTime();
        $this->id = 1;
        $this->date = $now->format('Y-m-d H:i:s');    // MySQL datetime format;;
        $this->price = 100;
        $this->units = 100;
        $this->setItem(new ItemEntity($data));
    }

    public function getId() {
        return $this->id;
    }

    public function getItemId() {
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

    public function setId($id) {
        $this->id = $id;
    }

    public function setItem($item) {
        $this->item = $item;
        $this->itemId = $item->getId();
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