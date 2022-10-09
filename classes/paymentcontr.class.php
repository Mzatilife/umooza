<?php
class PaymentContr extends Payment
{
    // This function passes data to upload payment
    public function uploadPayment($reference, $amount)
    {
        return $this->uploadsPayment($reference, $amount);
    }

    // This function passes data to upload payment
    public function rentProperty($pay_id, $prop_id, $cust_id, $code,  $price)
    {
        return $this->rentsProperty($pay_id, $prop_id, $cust_id, $code,  $price);
    }

    // This function passes data to upload payment
    public function checkPayment($refno)
    {
        return $this->checksPayment($refno);
    }

    // This function passes data to confirm code
    public function confirmCode($id, $code)
    {
        return $this->confirmsCode($id, $code);
    }

    // This function passes data to change payment status
    public function changePaymentStatus($id, $st)
    {
        return $this->changesPaymentStatus($id, $st);
    }

    // This function passes data to view the code and other details 
    public function viewRentalCode($id)
    {
        return $this->viewsRentalCode($id);
    }

    // This function passes data to rental details based on id
    public function viewRented($id)
    {
        return $this->viewsRented($id);
    }

    // This function passes data to view payment
    public function viewPayment($st, $st2)
    {
        return $this->viewsPayment($st, $st2);
    }

    // This function passes data to view payment without status
    public function viewPaymentWithoutStatus()
    {
        return $this->viewsPaymentWithoutStatus();
    }

    // This function passes data to Count properties under offer
    public function countPayment($st, $st2)
    {
        return $this->countsPayment($st, $st2);
    }

    // This function passes an id to change rented status in the rented properties table
    public function changeRenstatus($id, $st)
    {
        return $this->changesRenstatus($id, $st);
    }

    // This function passes an id to change rented status using the prop id in the rented properties table
    public function changeRenstatusPropid($id, $st)
    {
        return $this->changesRenstatusPropid($id, $st);
    }

    // This function passes data to view real payment
    public function viewRealPayment($st, $st2)
    {
        return $this->viewsRealPayment($st, $st2);
    }

    // This function passes data to view finances for the landlord
    public function viewLandlordFinances($id, $st1, $st2, $st3, $st4)
    {
        return $this->viewsLandlordFinances($id, $st1, $st2, $st3, $st4);
    }

    // This function passes data to count finances for the landlord
    public function countLandlordFinances($id, $st1, $st2)
    {
        return $this->countsLandlordFinances($id, $st1, $st2);
    }

    // This function passes data to sum prices
    public function sumPrices($type, $st1, $st2)
    {
        return $this->sumsPrices($type, $st1, $st2);
    }

    // This function passes data to sum prices for the landlord 
    public function sumLandlordPrices($type, $id, $st1, $st2)
    {
        return $this->sumsLandlordPrices($type, $id, $st1, $st2);
    }
}
