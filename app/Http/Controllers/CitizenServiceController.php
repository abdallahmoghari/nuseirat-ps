<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CitizenServiceController extends Controller
{
    public function services()
    {
        return response()->view('citizen.services');
    }

    public function createRequest($type)
    {
        if (!in_array($type, array_keys(ServiceRequest::SERVICE_TYPES))) {
            abort(404);
        }
        $serviceName = ServiceRequest::SERVICE_TYPES[$type];
        return response()->view('citizen.create-request', compact('type', 'serviceName'));
    }

    public function storeRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_type' => 'required|in:' . implode(',', array_keys(ServiceRequest::SERVICE_TYPES)),
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        if (!$validator->fails()) {
            $serviceRequest = new ServiceRequest();
            $serviceRequest->tracking_number = ServiceRequest::generateTrackingNumber();
            $serviceRequest->citizen_id = Auth::guard('citizen')->id();
            $serviceRequest->service_type = $request->service_type;
            $serviceRequest->description = $request->description;
            $serviceRequest->status = 'pending';

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/requests', $fileName);
                $serviceRequest->file_path = 'requests/' . $fileName;
            }

            $serviceRequest->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم تقديم الطلب بنجاح',
                'tracking_number' => $serviceRequest->tracking_number,
            ], 200);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    public function myRequests()
    {
        $requests = ServiceRequest::where('citizen_id', Auth::guard('citizen')->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return response()->view('citizen.my-requests', compact('requests'));
    }

    public function showRequest($id)
    {
        $request = ServiceRequest::with('employee')
            ->where('citizen_id', Auth::guard('citizen')->id())
            ->findOrFail($id);
        return response()->view('citizen.show-request', compact('request'));
    }

    public function inquiryForm()
    {
        return response()->view('citizen.inquiry');
    }

    public function storeInquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if (!$validator->fails()) {
            $inquiry = new Inquiry();
            $inquiry->citizen_id = Auth::guard('citizen')->id();
            $inquiry->subject = $request->subject;
            $inquiry->message = $request->message;
            $inquiry->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إرسال الاستفسار بنجاح',
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
        $citizen = Auth::guard('citizen')->user();
        return response()->view('citizen.profile', compact('citizen'));
    }
}
