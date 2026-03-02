<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure;
use App\Models\Installement;
use App\Models\Payment;
use App\Models\Semester;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('sucess'),
                'cancel_url' => route('studentDashboard'),
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $request->price,
                    ],
                ],
            ],
        ]);
        // dd($response);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    session()->put('service_name', $request->service_name);

                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('studentDashboard');
        }

    }

    public function sucess(Request $request)
    {
        $paymentId = 0;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $student = Students::where('user_id', Auth::user()->id)->first();
            $feeStruct = FeeStructure::where([
                'course_id' => $student->course_id,
                'semester_id' => $student->semester_id,
            ])->first();
            if ($student && $feeStruct) {

                // echo $student->roll_no;
                // exit;
                $payment = Payment::where(['student_id' => $student->id, 'fee_structure_id' => $feeStruct->id])->first();
                $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

                if (! empty($payment)) {

                    $payment->amount_paid += $amount;

                    if ($payment->amount_paid < $feeStruct->total_amount) {
                        $payment->status = 2;
                    } else {
                        $payment->status = 1;
                    }

                } else {

                    $payment = new Payment;
                    $payment->student_id = $student->id;
                    $payment->fee_structure_id = $feeStruct->id;
                    $payment->amount_paid = $amount;
                    $payment->payment_mode = 'online';
                    $payment->transaction_id = $response['id'];
                    $payment->payment_date = now()->toDateString();

                    if ($amount < $feeStruct->total_amount) {
                        $payment->status = 2;
                    } else {
                        $payment->status = 1;
                    }
                }
                $semester = Semester::where(['course_id' => $student->course_id, 'semester_name' => $feeStruct->id])->first();
                $payment->due_date = $semester->end_date;
                $payment->save();
                $paymentId = $payment->id;
                $lastInstallment = Installement::where('payment_id', $paymentId)
                    ->orderBy('installment_no', 'desc')
                    ->first();

                $installement = new Installement;
                $installement->payment_id = $paymentId;
                if (! empty($lastInstallment)) {
                    $installement->installment_no = $lastInstallment->installment_no + 1;
                } else {
                    $installement->installment_no = 1;
                }
                $installement->amount = $amount;

                $installement->due_date = $semester->end_date;
                $installement->paid_date = now()->toDateString();
                $installement->status = 'paid';
                $installement->transaction_id = $response['id'];
                $installement->payment_mode = 'online';
                $installement->save();

                return redirect()->route('studentDashboard');

            } else {
                echo 'fail';
                exit;
            }

        }
    }
}
