<?php
class DependantEntity
{
    protected $id;
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

    public function setName($name) {
        $this->name = $name;
    }

    public function setSin($sin) {
        $this->sin = $sin;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }
}