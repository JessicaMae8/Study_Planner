<!DOCTYPE html>
<html>
<head>
    <title>View Study Session</title>
</head>
<body>

    <h1>Study Session Details</h1>

    <h2>{{ $studySession->subject->name }}</h2>

    <p>
        <strong>Study Task:</strong>
        {{ $studySession->studyTask
            ? $studySession->studyTask->title
            : 'No task assigned' }}
    </p>

    <p>
        <strong>Started At:</strong>
        {{ $studySession->started_at }}
    </p>

    <p>
        <strong>Ended At:</strong>
        {{ $studySession->ended_at ?? 'Not ended yet' }}
    </p>

    <p>
        <strong>Notes:</strong>
        {{ $studySession->notes ?? 'No notes' }}
    </p>

    <p>
        <strong>User ID:</strong>
        {{ $studySession->user_id }}
    </p>

    <br>

    <a href="{{ route('study-sessions.edit', $studySession->id) }}">
        Edit Study Session
    </a>

    <br><br>

    <a href="{{ route('study-sessions.index') }}">
        Back to Study Sessions
    </a>

</body>
</html>