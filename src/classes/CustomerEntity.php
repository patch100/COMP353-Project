<?php
class CustomerEntity
{
    protected $id;
    protected $name;
    protected $address;
    protected $phone;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
         if(isset($data['CustomerNumber'])) {
            $this->id = $data['CustomerNumber'];
        }

        $this->name = $data['Name'];
        $this->address = $data['Address'];
        $this->phone = $data['Telephone'];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhoneNumber() {
        return $this->phone;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPhoneNumber($phone) {
        $this->phone = $phone;
    }
}