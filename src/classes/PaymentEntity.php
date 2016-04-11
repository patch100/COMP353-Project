<?php
class PaymentEntity
{
    protected $id;
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
        //TODO UNCOMMENT AND SET PROPER DATA
        // if(isset($data['id'])) {
        //     $this->id = $data['id'];
        // }
        // $this->name = $data['name'];
        // $this->address = $data['address'];
        // $this->phone = $data['phone'];
        $now = new DateTime();
        $this->id = 1;
        $this->date = $now->format('Y-m-d H:i:s');    // MySQL datetime format;;
        $this->amount = 87;
        $this->setOrder(new OrderEntity($data));
    }

    public function getId() {
        return $this->id;
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

    public function getOrderId() {
        return $this->orderId;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function setOrder($order) {
        $this->order = $order;
        $this->orderId = $order->getId();
    }

    public function setOrderId($id) {
        $this->orderId = $id;
    }
}