<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Request - Study Planner</title>
</head>
<body>

    <h1>Create Service Request</h1>

    <p>
        Logged in as:
        <strong>{{ auth()->user()->name }}</strong>
    </p>

    @if ($errors->any())
        <div>
            <strong>Please correct the following:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('service-requests.store') }}">
        @csrf

        <div>
            <label for="item_name">Item Name:</label>
            <input
                type="text"
                id="item_name"
                name="item_name"
                value="{{ old('item_name') }}"
                maxlength="150"
                required
            >
        </div>

        <br>

        <div>
            <label for="quantity">Quantity:</label>
            <input
                type="number"
                id="quantity"
                name="quantity"
                value="{{ old('quantity') }}"
                min="1"
                required
            >
        </div>

        <br>

        <div>
            <label for="purpose">Purpose:</label>
            <textarea
                id="purpose"
                name="purpose"
                maxlength="2000"
                required
            >{{ old('purpose') }}</textarea>
        </div>

        <br>

        <button type="submit">Submit Request</button>

        <a href="{{ route('service-requests.index') }}">
            Cancel
        </a>
    </form>

</body>
</html>