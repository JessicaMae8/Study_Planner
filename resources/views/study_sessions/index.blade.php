<!DOCTYPE html>
<html>
<head>
    <title>Study Sessions</title>
</head>
<body>

    <h1>My Study Sessions</h1>

    <a href="{{ route('study-sessions.create') }}">
        Add Study Session
    </a>

    <hr>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($studySessions->count() > 0)

        @foreach($studySessions as $studySession)

            <h3>
                {{ $studySession->subject->name }}
            </h3>

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

            <a href="{{ route('study-sessions.show', $studySession->id) }}">
                View
            </a>

            <a href="{{ route('study-sessions.edit', $studySession->id) }}">
                Edit
            </a>

            <form
                action="{{ route('study-sessions.destroy', $studySession->id) }}"
                method="POST"
                style="display:inline;"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Delete
                </button>
            </form>

            <hr>

        @endforeach

    @else

        <p>No study sessions found.</p>

    @endif

</body>
</html>