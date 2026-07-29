<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CitizenAuthController extends Controller
{
    public function showRegister()
    {
        return response()->view('citizen.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:citizens,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string',
            'id_number' => 'nullable|string|unique:citizens,id_number',
        ]);

        if (!$validator->fails()) {
            $citizen = Citizen::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'id_number' => $request->id_number,
            ]);

            Auth::guard('citizen')->login($citizen);

            return response()->json([
                'icon' => 'success',
                'title' => 'تم التسجيل بنجاح',
            ], 200);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function showLogin()
    {
        return response()->view('citizen.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!$validator->fails()) {
            if (Auth::guard('citizen')->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'تم تسجيل الدخول بنجاح',
                ], 200);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
                ], 400);
            }
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('citizen')->logout();
        $request->session()->invalidate();
        return redirect('/citizen/login');
    }
}
