<?php
class EmployeeEntity
{
    protected $id;
    protected $name;
    protected $sin;
    protected $dob;
    protected $address;
    protected $phone;
    protected $position;

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
        $this->name = "Patrick";
        $this->sin = 1234567;
        $this->dob = $now->format('Y-m-d H:i:s');    // MySQL datetime format;
        $this->address = "20 John Ave";
        $this->phone = "555-555-5555";
        $this->position = "Supreme Ruler";
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSin() {
        return $this->sin;
    }

    public function getDob() {
        return $this->dob;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPosition() {
        return $this->position;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSin($sin) {
        $this->sin = $sin;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setPosition($position) {
        $this->position = $position;
    }
}