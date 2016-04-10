<?php
class OrderEntity
{
    protected $id;
    protected $total;
    protected $date;
    protected $method;

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
        $this->total = 9999;
        $this->date = $now->format('Y-m-d H:i:s');    // MySQL datetime format
        $this->method = "credit";
    }

    public function getId() {
        return $this->id;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getdate() {
        return $this->date;
    }

    public function getMethod() {
        return $this->method;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setdate($date) {
        $this->date = $date;
    }

    public function setMethod($method) {
        $this->method = $method;
    }
}