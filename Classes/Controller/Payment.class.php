<?php
    interface PaymentInterface
    {
        public function payNow($amount);
    }
    class Verve implements PaymentInterface
    {
        public function payNow($amount)
        {
            echo "Pay ".$amount." Through ".__CLASS__;
        }
    }
    class Mastercard implements PaymentInterface
    {
        public function payNow($amount)
        {
            echo "Pay ".$amount." Through ".__CLASS__;
        }
    }
    class Visa implements PaymentInterface
    {
        public function payNow($amount)
        {
            echo "Pay ".$amount." Through ".__CLASS__;
        }
    }
    class Paypal implements PaymentInterface
    {
        public function payNow($amount)
        {
            echo "Pay ".$amount." Through ".__CLASS__;
        }
    }

    class Payment
    {
        public function buyNow(PaymentInterface $payType) 
        {
            $payType->payNow(4000);
        }
    }
?>