<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the requests.
     */
    public function index()
    {
        Gate::authorize('viewAny', ServiceRequest::class);

        $user = auth()->user();

        if ($user->role === 'admin') {
            $serviceRequests = ServiceRequest::latest()->get();
        } else {
            $serviceRequests = ServiceRequest::where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return view('service_requests.index', compact('serviceRequests'));
    }

    /**
     * Show the form for creating a new request.
     */
    public function create()
    {
        Gate::authorize('create', ServiceRequest::class);

        return view('service_requests.create');
    }

    /**
     * Store a newly created request.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', ServiceRequest::class);

        $validated = $request->validate([
            'item_name' => ['required', 'string', 'max:150'],
            'quantity' => ['required', 'integer', 'min:1'],
            'purpose' => ['required', 'string', 'max:2000'],

            // Students are not allowed to supply these fields.
            'user_id' => ['prohibited'],
            'status' => ['prohibited'],
            'is_admin' => ['prohibited'],
            'role' => ['prohibited'],
        ]);

        $user = auth()->user();

        ServiceRequest::create([
            'user_id' => $user->id,
            'requester_name' => $user->name,
            'requester_email' => $user->email,
            'item_name' => $validated['item_name'],
            'quantity' => $validated['quantity'],
            'purpose' => $validated['purpose'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('service-requests.index')
            ->with('success', 'Request submitted successfully.');
    }

    /**
     * Display the specified request.
     */
    public function show(ServiceRequest $serviceRequest)
    {
        Gate::authorize('view', $serviceRequest);

        return view('service_requests.show', compact('serviceRequest'));
    }

    /**
     * Update the status of a request.
     */
    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        Gate::authorize('updateStatus', $serviceRequest);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $serviceRequest->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('service-requests.show', $serviceRequest)
            ->with('success', 'Request status updated successfully.');
    }
}