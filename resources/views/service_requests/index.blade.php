<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests - Study Planner</title>
</head>
<body>

    <h1>Service Requests</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        Logged in as:
        <strong>{{ auth()->user()->name }}</strong>
        ({{ auth()->user()->role }})
    </p>

    @if (auth()->user()->role === 'student')
        <p>
            <a href="{{ route('service-requests.create') }}">
                Create New Request
            </a>
        </p>
    @endif

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    @if ($serviceRequests->isEmpty())
        <p>No requests found.</p>
    @else
        @foreach ($serviceRequests as $serviceRequest)
            <div>
                <h2>{{ $serviceRequest->item_name }}</h2>

                <p>
                    Request ID:
                    {{ $serviceRequest->id }}
                </p>

                <p>
                    Requester:
                    {{ $serviceRequest->requester_name }}
                </p>

                <p>
                    Quantity:
                    {{ $serviceRequest->quantity }}
                </p>

                <p>
                    Purpose:
                    {{ $serviceRequest->purpose }}
                </p>

                <p>
                    Status:
                    {{ $serviceRequest->status }}
                </p>

                <a href="{{ route('service-requests.show', $serviceRequest) }}">
                    View Request
                </a>
            </div>

            <hr>
        @endforeach
    @endif

</body>
</html>