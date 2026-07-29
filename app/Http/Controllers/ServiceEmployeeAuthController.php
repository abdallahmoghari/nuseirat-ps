<?php

namespace App\Http\Controllers;

use App\Models\ServiceEmployee;
use App\Models\ServiceRequest;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ServiceEmployeeAuthController extends Controller
{
    public function showLogin()
    {
        return response()->view('cms.service_employee.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!$validator->fails()) {
            if (Auth::guard('service_employee')->attempt($request->only('email', 'password'))) {
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
        Auth::guard('service_employee')->logout();
        $request->session()->invalidate();
        return redirect('/');
    }

    public function dashboard()
    {
        $pendingCount = ServiceRequest::where('status', 'pending')->count();
        $underStudyCount = ServiceRequest::where('status', 'under_study')->count();
        $completedCount = ServiceRequest::where('status', 'completed')->count();
        $inquiryCount = Inquiry::whereNull('employee_id')->count();
        $recentRequests = ServiceRequest::with('citizen')->orderBy('created_at', 'desc')->take(5)->get();
        return response()->view('cms.service_employee.dashboard', compact(
            'pendingCount', 'underStudyCount', 'completedCount', 'inquiryCount', 'recentRequests'
        ));
    }

    public function requests()
    {
        $requests = ServiceRequest::with('citizen')->orderBy('created_at', 'desc')->paginate(10);
        return response()->view('cms.service_employee.requests', compact('requests'));
    }

    public function showRequest($id)
    {
        $request = ServiceRequest::with('citizen', 'employee')->findOrFail($id);
        return response()->view('cms.service_employee.show-request', compact('request'));
    }

    public function updateStatus(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'status' => 'required|in:pending,under_study,awaiting_review,completed',
            'admin_response' => 'nullable|string',
            'response_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        if (!$validator->fails()) {
            $serviceRequest = ServiceRequest::findOrFail($id);
            $serviceRequest->status = $req->status;
            $serviceRequest->employee_id = Auth::guard('service_employee')->id();
            if ($req->filled('admin_response')) {
                $serviceRequest->admin_response = $req->admin_response;
            }
            if ($req->hasFile('response_file')) {
                $file = $req->file('response_file');
                $fileName = 'response_' . time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/requests', $fileName);
                $serviceRequest->file_path = 'requests/' . $fileName;
            }
            $serviceRequest->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم تحديث الحالة بنجاح',
            ], 200);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function inquiries()
    {
        $inquiries = Inquiry::with('citizen')->orderBy('created_at', 'desc')->paginate(10);
        return response()->view('cms.service_employee.inquiries', compact('inquiries'));
    }

    public function showInquiry($id)
    {
        $inquiry = Inquiry::with('citizen', 'employee')->findOrFail($id);
        return response()->view('cms.service_employee.show-inquiry', compact('inquiry'));
    }

    public function respondInquiry(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'response' => 'required|string',
        ]);

        if (!$validator->fails()) {
            $inquiry = Inquiry::findOrFail($id);
            $inquiry->response = $req->response;
            $inquiry->employee_id = Auth::guard('service_employee')->id();
            $inquiry->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إرسال الرد بنجاح',
            ], 200);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function profile()
    {
        $employee = Auth::guard('service_employee')->user();
        return response()->view('cms.service_employee.profile', compact('employee'));
    }

    public function updateProfile(Request $request)
    {
        $employee = Auth::guard('service_employee')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:service_employees,email,' . $employee->id,
            'phone' => 'nullable|string',
            'password' => 'nullable|min:6|confirmed',
        ]);

        if (!$validator->fails()) {
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;

            if ($request->filled('password')) {
                $employee->password = Hash::make($request->password);
            }

            $employee->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم تحديث الملف الشخصي بنجاح',
            ], 200);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }
}
