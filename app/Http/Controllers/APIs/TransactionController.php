<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Transaction\TransactionInterface as TransactionService;
use App\Services\Contracts\Schedule\ScheduleInterface as ScheduleService;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $scheduleService;

    public function __construct(TransactionService $transactionService, ScheduleService $scheduleService)
    {
        $this->transactionService = $transactionService;
        $this->scheduleService = $scheduleService;

        // Initialize Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function callback(Request $request, $transactionId)
    {
        $transaction = $this->transactionService->find($transactionId);

        $params = [
          'transaction_details' => [
              'order_id' => $transaction->id,
              'gross_amount' => $transaction->total_purchases
          ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'status' => 'success',
            'message' => 'Checkout successful',
            'data' => [
                'snap_token' => $snapToken,
                'transaction' => $transaction
            ],
        ]);
    }

    public function paymentSuccess(Request $request, $transactionId)
    {
        $transaction = $this->transactionService->find($transactionId);
        $schedule = $this->scheduleService->find($transaction->exam->schedule_id);

        $transaction->update([
            'transaction_status' => 'done',
            'snap_token' => $request->snap_token,
            'voucher_token' => strtoupper(Str::random(15))
        ]);

        $schedule->update([
            'participants' => $schedule->participants + 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment successful',
            'data' => $request->all(),
        ]);
    }
}
