<?php
class PaymentEntity
{
    protected $name;
    protected $orderId;
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

        $this->date = $data['Oustanding_Payment'];
        $this->amount = $data['Name'];
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
}