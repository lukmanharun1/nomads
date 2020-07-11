<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\TranscationSuccess;
use App\Transaction;
use Illuminate\Http\Request;
use App\TransactionDetail;
use App\TravelPackage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item =  Transaction::with(['details', 'travel_Package', 'user'])->findOrFail($id);
        return view('pages.checkout', [
            'item' => $item
        ]);
    }

    public function process(Request $request, $id)
    {
        $travel_package = TravelPackage::findOrFail($id);
        $transaction = Transaction::create([
            'travel_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'aditional_visa' => 0,
            'transaction_total' => $travel_package->price,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'nationality' => 'ID',
            'is_visa' => false,
            'doe_passport' => Carbon::now()->addYears(5)
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);
        $transaction = Transaction::with(['details', 'travel_package'])
            ->findOrFail($item->transactions_id);

        if ($item->is_visa) {
            $transaction->transaction_total -= 100;
            $transaction->aditional_visa -= 100;
        }
        $transaction->transaction_total -= $transaction->travel_package->price;

        $transaction->save();
        $item->delete();
        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'is_visa' => 'required|boolean',
            'doe_passport' => 'required'
        ]);
        $data = $request->all();
        $data['transactions_id'] = $id;
        TransactionDetail::create($data);

        $transaction = Transaction::with(['travel_package'])->find($id);
        if ($request->is_visa) {
            $transaction->transaction_total += 100;
            $transaction->aditional_visa += 100;
        }
        $transaction->transaction_total += $transaction->travel_package->price;

        $transaction->save();
        return redirect()->route('checkout', $id);
    }
    public function success(Request $request, $id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrFail($id);
        $transaction->transaction_status = 'PENDING';
        $transaction->save();

        // set konfigurasi midtrans
        Config::$serverKey = "SB-Mid-server-ziWbynE1_MzDzhc9dBv1-BlM";
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // buat array untuk kirim ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'TEST-' . $transaction->id,
                'gross_amount' => (int) $transaction->transaction_total
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email
            ],
            'enabled_payments' => ['gopay'],
            'vtweb' => []
        ];

        try {
            // ambil halaman payment ke halaman midtrans
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;


            // redirect ke halaman midtrans
            return redirect()->away($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // return $transaction;
        // kirim email ke user e-ticket nya
        // Mail::to($transaction->user)->send(
        //     new TranscationSuccess($transaction)
        // );
        // return view('pages.success');
    }
}
