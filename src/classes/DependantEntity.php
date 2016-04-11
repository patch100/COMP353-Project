<?php
class DependantEntity
{
    protected $name;
    protected $sin;
    protected $dob;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        if(isset($data['SSN'])) {
            $this->sin = $data['SSN'];
        }

        $this->name = $data['Name'];
        $this->dob = $data['DateOfBirth'];
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

    public function setName($name) {
        $this->name = $name;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }
}