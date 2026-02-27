<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed',
            'role' => 'required|in:1,2,3',
        ]);
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();
        if ($request->role == 3) {
            Students::create([
                'user_id' => $user->id,
                'roll_no' => $request->roll_no,
                'course_id' => $request->course_id,
                'semester_id' => $request->semester_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'admission_date' => $request->admission_date,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('login')
            ->with('success', 'Registration Successful');
    }

    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('user_email', $user->email);
            Session::put('user_role', $user->role);
            $agent = new Agent;
            Session::put('device', $agent->device());
            Session::put('browser', $agent->browser());
            Session::put('platform', $agent->platform());
            \Log::info('Login detected', [
                'user_id' => $user->id,
                'device' => $agent->device(),
                'browser' => $agent->browser(),
                'platform' => $agent->platform(),
                'ip' => $request->ip(),
            ]);

            return redirect('/');
        } else {
            return back()->with('error', 'Invalid email or password.');
        }
    }
}
