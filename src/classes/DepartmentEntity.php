<?php
class CustomerEntity
{
    protected $name;
    protected $room_number;
    protected $fax;
    protected $phone_1;
    protected $phone_2;

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
        $this->room_number = "514-999-9999";
        $this->phone_1 = "514-999-9999";
        $this->phone_2 = "514-999-9999";

    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getRoomNumber() {
        return $this->room_number;
    }

    public function getFax() {
        return $this->fax;
    }

    public function getPhoneOne() {
        return $this->phone_1;
    }

    public function getPhoneTwo() {
        return $this->phone_2;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getRoomNumber($room_number) {
         $this->room_number = $room_number;
    }

    public function getFax($fax) {
         $this->fax = $fax;
    }

    public function getPhoneOne($phone_1) {
         $this->phone_1 = $phone_1;
    }

    public function getPhoneTwo($phone_2) {
         $this->phone_2 = $phone_2;
    }