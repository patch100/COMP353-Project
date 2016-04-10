<?php
class CustomerEntity
{
    protected $name;
    protected $room;
    protected $fax;
    protected $phoneOne;
    protected $phoneTwo;

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
        $this->id = 1;
        $this->name = "Patrick";
        $this->fax = "514-999-9999";
        $this->room = "514-999-9999";
        $this->phoneOne = "514-999-9999";
        $this->phoneTwo = "514-999-9999";
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getRoom() {
        return $this->room;
    }

    public function getFax() {
        return $this->fax;
    }

    public function getPhoneOne() {
        return $this->phoneOne;
    }

    public function getPhoneTwo() {
        return $this->phoneTwo;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setRoom($room_number) {
         $this->room = $room_number;
    }

    public function setFax($fax) {
         $this->fax = $fax;
    }

    public function setPhoneOne($phone_1) {
         $this->phoneOne = $phone_1;
    }

    public function setPhoneTwo($phone_2) {
         $this->phoneTwo = $phone_2;
    }
}