<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentData = [
            [
                'transaction_amount' => 245.90,
                'installments' => 3,
                'token' => 'ae4e50b2a8f3h6d9f2c3a4b5d6e7f8g9',
                'payment_method_id' => 'master',
                'entity_type' => 'individual',
                'type' => 'customer',
                'email' => 'example_random@gmail.com',
                'identification_type' => 'CPF',
                'identification_number' => '12345678909',
                'notification_url' => 'https://webhook.site/your-unique-id',
                'created_at' => '2024-01-01',
                'updated_at' => '2024-01-01',
                'status' => 'PAID',
            ],
            [
                'transaction_amount' => 150.00,
                'installments' => 2,
                'token' => 'a1b2c3d4e5f6g7h8i9j0',
                'payment_method_id' => 'visa',
                'entity_type' => 'individual',
                'type' => 'customer',
                'email' => 'another_example@gmail.com',
                'identification_type' => 'RG',
                'identification_number' => '987654321',
                'notification_url' => 'https://webhook.site/another-unique-id',
                'created_at' => '2024-01-02',
                'updated_at' => '2024-01-02',
                'status' => 'PENDING',
            ],
        ];

        foreach ($paymentData as $data) {
            Payment::create($data);
        }
    }
}
