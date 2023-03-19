<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $table = 'order_payment';

    public static function insertPaymentResponse($userId, $paymentStatus, $pgResponse)
    {
        $insertData = [
            'user_id' => $userId,
            'payment_method' => 'Stripe',
            'response_string' => json_encode($pgResponse),
            'txn_status' => $paymentStatus,
        ];
        if ($paymentStatus === 'SUCCESS') {
            $insertData['txn_id'] = $pgResponse['id'];
            $insertData['amount'] = $pgResponse['amount_captured'];
            $insertData['txn_status'] = $pgResponse['status'];
            $insertData['txn_datetime'] = date('Y-m-d H:i:s');
            return self::insertGetId($insertData);
        } elseif ($paymentStatus === 'FAILED') {
            return self::insertGetId($insertData);
        } else {
            return self::insertGetId($insertData);
        }
    }
}
