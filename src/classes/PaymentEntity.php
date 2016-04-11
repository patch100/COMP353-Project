<?php
class PaymentEntity
{
    protected $orderId;
    protected $order;
    protected $date;
    protected $amount;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        if(isset($data['OrderId'])) {
            $this->orderId = $data['OrderId'];
        }

        $this->date = $data['PaymentDate'];
        $this->amount = $data['Amount'];
    }

    public function getId() {
        return $this->orderId;
    }

    public function getDate() {
        return $this->date;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function setOrder($order) {
        $this->order = $order;
    }
}