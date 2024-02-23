<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function createPayment(array $data)
    {
        return Payment::create($data);
    }

    public function getAllPayments()
    {
        return Payment::all();
    }

    public function getPaymentById($paymentId)
    {
        return Payment::findOrFail($paymentId);
    }

    public function updatePaymentStatus($paymentId, $status)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->status = $status;
        $payment->save();
    }

    public function cancelPayment($paymentId)
    {
        $this->updatePaymentStatus($paymentId, 'CANCELED');
    }
}
