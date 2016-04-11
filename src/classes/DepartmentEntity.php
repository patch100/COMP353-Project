<?php
class DepartmentEntity
{
    protected $id;
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
        if(isset($data['Id'])) {
            $this->id = $data['Id'];
        }
        $this->name = $data['Name'];
        $this->room = $data['RoomNumber'];
        $this->fax = $data['FaxNumber'];
        $this->phoneOne = $data['PhoneNumber1'];
        $this->phoneTwo = $data['PhoneNumber2'];
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