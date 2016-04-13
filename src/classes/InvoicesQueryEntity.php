<?php
class InvoicesQueryEntity
{
    // columns: name, orders, quantity
    protected $name;
    protected $telephone;
    protected $address;
    protected $dateOfPurchase;
    protected $balance;
    protected $items;
    protected $paymentDate;
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
        #$this->name = "Fire Truck";
        #$this->orders = 10;
        #$this->quantity = 100;

        #if(isset($data['name'])) { $this->name = $data['name']; }
        if(isset($data['Name'])) { $this->name = $data['Name']; }
        if(isset($data['Telephone'])) { $this->telephone = $data['Telephone']; }
        if(isset($data['Address'])) { $this->address = $data['Address']; }
        $this->items = [];
    }

    public function getName() {
        return $this->name;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getDateOfPurchase() {
        return $this->dateOfPurchase;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getItems() {
        return $this->items;
    }

    public function getPaymentDate() {
        return $this->paymentDate;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setDateOfPurchase($dateOfPurchase) {
        $this->dateOfPurchase = $dateOfPurchase;
    }

    public function setBalance($balance) {
        $this->balance = $balance;
    }

    public function addItem($item) {
        $this->items[] = $item;
    }

    public function setPaymentDate($paymentDate) {
        $this->paymentDate = $paymentDate;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }
}