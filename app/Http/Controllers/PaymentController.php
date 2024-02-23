<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaymentRepository;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment(Request $request)
    {
        try {
            $requestData = $request->validate([
                'transaction_amount' => 'required|numeric',
                'installments' => 'required|integer',
                'token' => 'required|string',
                'payment_method_id' => 'required|string',
                'payer.email' => 'required|email',
                'payer.identification.type' => 'required|string',
                'payer.identification.number' => 'required|string',
            ]);

            $defaultFields = [
                'entity_type' => 'individual',
                'type' => 'customer',
                'notification_url' => 'https://webhook.site/your-unique-id', 
            ];

            $mergedData = array_merge($requestData, $defaultFields);

            $payment = $this->paymentRepository->createPayment($mergedData);

            return response()->json($payment, 201, [], JSON_UNESCAPED_SLASHES);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Invalid payment provided.'], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function listPayments()
    {
        $payments = $this->paymentRepository->getAllPayments();

        return response()->json($payments);
    }

    public function viewPayment($paymentId)
    {
        $payment = $this->paymentRepository->getPaymentById($paymentId);

        if ($payment) {
            return response()->json($payment);
        } else {
            return response()->json(['error' => 'Payment not found.'], 404);
        }
    }

    public function confirmPayment(Request $request, $paymentId)
    {
        $data = $request->validate([
            'status' => 'required|string|in:PAID',
        ]);

        $payment = $this->paymentRepository->getPaymentById($paymentId);

        if ($payment) {
            $this->paymentRepository->updatePaymentStatus($paymentId, $data['status']);
            return response()->json([], 204);
        } else {
            return response()->json(['error' => 'Payment not found.'], 404);
        }
    }

    public function cancelPayment($paymentId)
    {
        $payment = $this->paymentRepository->getPaymentById($paymentId);

        if ($payment) {
            $this->paymentRepository->cancelPayment($paymentId);
            return response()->json([], 204);
        } else {
            return response()->json(['error' => 'Payment not found.'], 404);
        }
    }
}

