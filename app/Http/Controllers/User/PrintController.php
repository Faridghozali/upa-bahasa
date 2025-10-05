<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Transaction\TransactionInterface as TransactionService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function printExamCard($transactionId)
    {
        $transaction = $this->transactionService->find($transactionId);
        $exam = $transaction->exam;
        $user = $transaction->user;

        $pdf = Pdf::loadView('member_card.exam_card', [
            'transaction' => $transaction,
            'exam' => $exam,
            'user' => $user
        ])->setPaper('A4', 'landscape');

        return $pdf->stream('exam_card_' . $user->name . '.pdf');
    }
}
