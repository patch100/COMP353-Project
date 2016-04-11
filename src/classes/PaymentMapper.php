<?php
class PaymentMapper extends Mapper
{    
    /**
     * Gets a list of Payments
     *
     * @return [PaymentEntity]  List of Payments
     */
    public function getPayments() {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->query($sql);
        //$results = [];
        //while($row = $stmt->fetch()) {
        //    $results[] = new CustomerEntity($row);
        //}
        $dummy = [];
        $results[] = new PaymentEntity($dummy);

        return $results;
    }

    /**
     * Get one Payment by its ID
     *
     * @param int $id The ID of the Payment
     * @return PaymentEntity  The Payment
     */
    public function getPaymentById($id) {
        //TODO WRITE SQL (Preferabbly in another file, full of queries)
        //$sql = "";
        //$stmt = $this->db->prepare($sql);
        //$result = $stmt->execute(["customer_id" => $customer_id]);
        //if($result) {
        //    return new CustomerEntity($stmt->fetch());
        //}
        $dummy = [];
        return new PaymentEntity($dummy);
    }

    /**
     * Save a payment
     *
     * @param PaymentEntity the payment object
     */
    public function save(PaymentEntity $payment) {
        //TODO WRITE INSERTSQL (Preferabbly in another file, full of queries)
        $sql = "insert into payments (date, orderId, amount) values (:date, :orderId, :amount)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "date" => $payment->getDate(),
            "orderId" => $payment->getOrderId(),
            "amount" => $payment->getAmount(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}