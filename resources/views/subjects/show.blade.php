<!DOCTYPE html>
<html>
<head>
    <title>View Subject</title>
</head>
<body>

    <h1>Subject Details</h1>

    <h2>{{ $subject->name }}</h2>

    <p>
        <strong>Description:</strong>
        {{ $subject->description }}
    </p>

    <p>
        <strong>User ID:</strong>
        {{ $subject->user_id }}
    </p>

    <br>

    <a href="{{ route('subjects.edit', $subject->id) }}">
        Edit Subject
    </a>

    <br><br>

    <a href="{{ route('subjects.index') }}">
        Back to Subjects
    </a>

</body>
</html>