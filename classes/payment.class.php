<?php

class Payment extends Dbh
{
    // FUNCTION TO UPLOAD THE PAYMENT DETAILS
    protected function uploadsPayment($reference, $amount)
    {
        $sql = "INSERT INTO payments (`reference`, `amount`, `status`, `payment_date`) VALUES (?, ?, ?, NOW())";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$reference, $amount, 0]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO RENT A PROPERTY
    protected function rentsProperty($pay_id, $prop_id, $cust_id, $code,  $price)
    {
        $sql = "INSERT INTO rented_properties (`payment_id`, `prop_id`, `customer_id`, `rent_code`, `rent_price`, `rental_date`, `ren_status`) VALUES (?, ?, ?, ?, ?, NOW(), 0)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$pay_id, $prop_id, $cust_id, $code,  $price]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO CHECK PAYMENT
    protected function checksPayment($refno)
    {
        $sql = "SELECT * FROM payments WHERE `reference` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$refno]);
        $result = $stmt->rowCount();
        if ($result == 1) {
            return $stmt->fetch();
        }
    }

    // FUNCTION TO CONFIRM CODE
    protected function confirmsCode($id, $code)
    {
        $sql = "SELECT * FROM `rented_properties` WHERE `prop_id` = ? AND `rent_code` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, $code]);
        $result = $stmt->rowCount();
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO CHANGE PAYMENT STATUS
    protected function changesPaymentStatus($id, $st)
    {
        $sql = "UPDATE `payments` SET `status` = ? WHERE `payments`.`payment_id` = ?;";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$st, $id]);
    }

    // FUNCTION TO SHOW CODE
    protected function viewsRentalCode($id)
    {
        $sql = "SELECT * FROM `rented_properties` INNER JOIN `properties` ON rented_properties.prop_id = properties.prop_id INNER JOIN `users` ON properties.user_id = users.user_id WHERE rented_properties.customer_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO SHOW RENTED PROPERTY
    protected function viewsRented($id)
    {
        $sql = "SELECT * FROM `rented_properties` WHERE prop_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // FUNCTION TO SHOW RENTED PROPERTY
    protected function viewsPayment($st, $st2)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `properties` ON rented_properties.prop_id = properties.prop_id INNER JOIN `users` ON properties.user_id = users.user_id WHERE rented_properties.ren_status = ? OR rented_properties.ren_status = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st, $st2]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO SHOW RENTED PROPERTY WITHOUT STATUS
    protected function viewsPaymentWithoutStatus()
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `properties` ON rented_properties.prop_id = properties.prop_id INNER JOIN `users` ON properties.user_id = users.user_id ";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    // FUNCTION TO SHOW RENTED PROPERTY
    protected function countsPayment($st, $st2)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `properties` ON rented_properties.prop_id = properties.prop_id INNER JOIN `users` ON properties.user_id = users.user_id WHERE rented_properties.ren_status = ? OR rented_properties.ren_status = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st, $st2]);
        return $stmt->rowCount();
    }

    // FUNCTION TO CHANGE PAYMENT STATUS
    protected function changesRenstatus($id, $st)
    {
        $sql = "UPDATE `rented_properties` SET `ren_status` = ? WHERE `rented_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$st, $id]);
    }

    // FUNCTION TO CHANGE RENTED STATUS USING PROP ID
    protected function changesRenstatusPropid($id, $st)
    {
        $sql = "UPDATE `rented_properties` SET `ren_status` = ? WHERE `prop_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$st, $id]);
    }

    // FUNCTION TO SHOW PAYMENTS
    protected function viewsRealPayment($st, $st2)
    {
        $sql = "SELECT * FROM `payments` WHERE `status` = ? OR `status` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st, $st2]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO SHOW RENTED PROPERTY
    protected function viewsLandlordFinances($id, $st1, $st2, $st3, $st4)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `properties` ON rented_properties.prop_id = properties.prop_id WHERE properties.user_id = ? AND (rented_properties.ren_status = ? OR rented_properties.ren_status = ? OR rented_properties.ren_status = ? OR rented_properties.ren_status = ?) ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, $st1, $st2, $st3, $st4]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO COUNT RENTED PROPERTY
    protected function countsLandlordFinances($id, $st1, $st2)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `properties` ON rented_properties.prop_id = properties.prop_id WHERE properties.user_id = ? AND (rented_properties.ren_status = ? OR rented_properties.ren_status = ?) ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, $st1, $st2]);
        return $stmt->rowCount();
    }

    //FUNCTION SUMS COMMISSION AND PROERTY OWNER FEE
    protected function sumsPrices($type, $st1, $st2)
    {
        $sql = "SELECT SUM($type) AS $type FROM `rented_properties` WHERE `ren_status` = ? OR `ren_status` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st1, $st2]);
        return $stmt->fetch();
    }

    protected function sumsLandlordPrices($type, $id, $st1, $st2)
    {
        $sql = "SELECT SUM($type) AS $type FROM `rented_properties` INNER JOIN `properties` ON rented_properties.prop_id = properties.prop_id WHERE properties.user_id = ? AND (rented_properties.ren_status = ? OR rented_properties.ren_status = ?) ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, $st1, $st2]);
        return $stmt->fetch();
    }
}
