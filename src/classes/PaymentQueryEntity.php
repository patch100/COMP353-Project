<?php
class PaymentQueryEntity
{
    protected $name;
    protected $orderId;
    protected $amount;
    protected $date;
    protected $method;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        if(isset($data['OrderNumber'])) {
            $this->orderId = $data['OrderNumber'];
        }

        $this->date = $data['DateShipped'];
        $this->amount = $data['Balance'];
        $this->method = $data['PaymentMethod'];
        $this->name = $data['Name'];
    }

    public function getId() {
        return $this->orderId;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getName() {
        return $this->name;
    }

    public function getDate() {
        return $this->date;
    }

    public function getMethod() {
        return $this->method;
    }
}