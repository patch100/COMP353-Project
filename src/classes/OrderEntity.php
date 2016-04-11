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
        if(isset($data['Id'])) {
            $this->id = $data['Id'];
        }

        $this->total = $data['Balance'];
        $this->date = $data['DateOfPurchase'];
        $this->method = $data['PaymentMethod'];
    }

    public function getId() {
        return $this->id;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getDate() {
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