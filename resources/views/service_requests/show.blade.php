<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Request - Study Planner</title>
</head>
<body>

    <h1>Service Request #{{ $serviceRequest->id }}</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        <strong>Requester:</strong>
        {{ $serviceRequest->requester_name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $serviceRequest->requester_email }}
    </p>

    <p>
        <strong>Item:</strong>
        {{ $serviceRequest->item_name }}
    </p>

    <p>
        <strong>Quantity:</strong>
        {{ $serviceRequest->quantity }}
    </p>

    <p>
        <strong>Purpose:</strong>
        {{ $serviceRequest->purpose }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ $serviceRequest->status }}
    </p>

    @if (auth()->user()->role === 'admin')
        <hr>

        <h2>Update Status</h2>

        <form method="POST"
              action="{{ route('service-requests.update-status', $serviceRequest) }}">

            @csrf
            @method('PATCH')

            <label for="status">Status:</label>

            <select name="status" id="status" required>
                <option value="pending"
                    {{ $serviceRequest->status === 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="approved"
                    {{ $serviceRequest->status === 'approved' ? 'selected' : '' }}>
                    Approved
                </option>

                <option value="rejected"
                    {{ $serviceRequest->status === 'rejected' ? 'selected' : '' }}>
                    Rejected
                </option>
            </select>

            <button type="submit">Update Status</button>
        </form>
    @endif

    <br>

    <a href="{{ route('service-requests.index') }}">
        Back to Requests
    </a>

</body>
</html>