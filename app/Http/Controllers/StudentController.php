<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure;
use App\Models\Installement;
use App\Models\Payment;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student = Students::where('user_id', Auth::id())->first();

        if (! $student) {
            abort(404, 'Student not found');
        }

        $payment = Payment::where([
            'student_id' => $student->id,
            'fee_structure_id' => $student->semester_id,
        ])->first();

        $lastInstallment = null;
        $installementList = null;

        if ($payment) {
            $lastInstallment = Installement::where('payment_id', $payment->id)
                ->orderBy('installment_no', 'desc')
                ->first();
            $installementList = Installement::where('payment_id', $payment->id)->orderBy('installment_no')->get();
            // echo $installementList;
            // exit;
        }

        $feeStructure = FeeStructure::where([
            'course_id' => $student->course_id,
            'semester_id' => $student->semester_id,
        ])->first();

        return view('studentDashboard.index', compact(
            'lastInstallment',
            'feeStructure',
            'payment',
            'installementList'
        ));
    }
}
