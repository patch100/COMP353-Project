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
    protected $email;

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
        $this->sin = $data['SSN'];
        $this->dob = $data['DateOfBirth'];
        $this->address = $data['Address'];
        $this->phone = $data['Telephone'];
        $this->position = $data['Position'];
        $this->email = $data['email'];
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

    public function getEmail() {
        return $this->email;
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

    public function setEmail($email) {
        $this->email = $email;
    }
}