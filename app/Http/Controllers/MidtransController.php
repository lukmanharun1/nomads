<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TranscationSuccess;
use App\Transaction;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // set konfigurasi midtrans
        Config::$serverKey = "SB-Mid-server-ziWbynE1_MzDzhc9dBv1-BlM";
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        // buat instance midtrans notification
        $notification = new Notification();

        // pecah order id agar bisa diterima oleh database
        $order = explode('-', $notification->order_id);
        // Assign ke variabel midtrans notification
        $status = $notification->transcation_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id =  $order[1];

        // cari transaksi berdasarkan id
        $transaction = Transaction::findOrFail($order_id);
        // handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challege') {
                    $transaction->transcation_status = 'CHALLENGE';
                } else {
                    $transaction->transcation_status = 'SUCCESS';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->transcation_status = 'SUCCESS';
        }
        else if ($status == 'pending') {
            $transaction->transcation_status = 'PENDING';
        }
        else if ($status == 'deny') {
            $transaction->transcation_status = 'FAILED';
        }
        else if ($status == 'exipire') {
            $transaction->transcation_status = 'EXPIRED';
        }
        else if ($status == 'cancel') {
            $transaction->transcation_status = 'FAILED';
        }

        // simpan transaksi
        $transaction->save();
        if ($transaction) {
            if ($status == 'capture' && $status == 'accept') {
                Mail::to($transaction->user)->send(new TranscationSuccess($transaction));
            } else if ($status == 'settlement') {
                Mail::to($transaction->user)->send(new TranscationSuccess($transaction));
            }
            else if ($status == 'success') {
                Mail::to($transaction->user)->send(new TranscationSuccess($transaction));
            }
            else if ($status == 'capture' && $fraud == 'challenge') {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            }
            else {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment not settlement'
                    ]
                ]);
            }
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification success'
                ]
            ]);
        }
    }

    public function finishRedirect(Request $request)
    {
        return view('pages.success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('pages.unfinish');
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.failed');
    }
}
