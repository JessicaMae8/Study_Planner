<!DOCTYPE html>
<html>
<head>
    <title>View Study Task</title>
</head>
<body>

    <h1>Study Task Details</h1>

    <h2>{{ $studyTask->title }}</h2>

    <p>
        <strong>Subject:</strong>
        {{ $studyTask->subject->name }}
    </p>

    <p>
        <strong>Description:</strong>
        {{ $studyTask->description }}
    </p>

    <p>
        <strong>Due Date:</strong>
        {{ $studyTask->due_date }}
    </p>

    <p>
        <strong>Priority:</strong>
        {{ $studyTask->priority }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ $studyTask->status }}
    </p>

    <p>
        <strong>User ID:</strong>
        {{ $studyTask->user_id }}
    </p>

    <br>

    <a href="{{ route('study-tasks.edit', $studyTask->id) }}">
        Edit Study Task
    </a>

    <br><br>

    <a href="{{ route('study-tasks.index') }}">
        Back to Study Tasks
    </a>

</body>
</html>