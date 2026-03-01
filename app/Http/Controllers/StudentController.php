<?php

namespace App\Http\Controllers;

use App\Models\Installement;
use App\Models\Payment;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student = Students::where(['user_id' => Auth::user()->id])->first();
        $payment = Payment::where(['student_id' => $student->id, 'fee_structure_id' => $student->semester_id])->first();
        $lastInstallment = Installement::where('payment_id', $payment->id)
            ->orderBy('installment_no', 'desc')
            ->first();

        return view('studentDashboard.index', [
            'lastInstallment' => $lastInstallment,
        ]);
    }
}
