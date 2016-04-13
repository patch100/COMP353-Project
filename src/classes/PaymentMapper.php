<?php
class PaymentMapper extends Mapper
{    
    /**
     * Gets a list of Payments
     *
     * @return [PaymentEntity]  List of Payments
     */
    public function getPayments() {
        $sql = "SELECT * FROM Payment";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
           $results[] = new PaymentEntity($row);
        }
        return $results;
    }

    /**
     * Get one Payment by its ID
     *
     * @param int $id The ID of the Payment
     * @return PaymentEntity  The Payment
     */
    public function getPaymentById($id) {
        $sql = "SELECT * FROM Payment WHERE OrderId = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $id]);
        if($result) {
           return new PaymentEntity($stmt->fetch());
        }
    }

        /**
     * Update a payment
     *
     * @param PaymentEntity the payment object
     */
    public function update(PaymentEntity $payment) {
        $sql = "UPDATE Payment SET Amount = :amount, PaymentDate = :date_m WHERE OrderId = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "amount" => $payment->getAmount(),
            "date_m" => $payment->getDate(),
            "id" => (int)$payment->getId(),
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function processQuery($logger) {

        $sql = "SELECT Customer.Name, HasOrdered.OrderId,(Orders.Balance - Payment.Amount) AS Oustanding_Payment
FROM Customer natural join HasOrdered
join Orders on HasOrdered.OrderId = Orders.Id
join Payment on HasOrdered.OrderId = Payment.OrderId
WHERE Payment.Amount < Orders.Balance";

        $stmt = $this->db->query($sql);
        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = new PaymentQueryEntity($row);
            print_r($row);
        }

        return $results;
    }

    /**
     * Save a payment
     *
     * @param PaymentEntity the payment object
     */
    public function save(PaymentEntity $payment) {
        $sql = "insert into Payment (OrderId, PaymentDate, Amount) values (:id, :date, :amount)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $payment->getId(),
            "date" => $payment->getDate(),
            "amount" => $payment->getAmount(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

        /**
     * Delete a payment
     *
     * @param PaymentEntity the payment object
     */
    public function delete(PaymentEntity $payment) {
        $sql = "DELETE FROM Payment WHERE OrderId = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $payment->getId()]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
        return $result;
    }
}