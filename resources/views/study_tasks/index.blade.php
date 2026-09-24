<!DOCTYPE html>
<html>
<head>
    <title>Study Tasks</title>
</head>
<body>

    <h1>My Study Tasks</h1>

    <a href="{{ route('study-tasks.create') }}">Add Study Task</a>

    <hr>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($studyTasks->count() > 0)

        @foreach($studyTasks as $studyTask)

            <h3>{{ $studyTask->title }}</h3>

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

            <a href="{{ route('study-tasks.show', $studyTask->id) }}">
                View
            </a>

            <a href="{{ route('study-tasks.edit', $studyTask->id) }}">
                Edit
            </a>

            <form
                action="{{ route('study-tasks.destroy', $studyTask->id) }}"
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

        <p>No study tasks found.</p>

    @endif

</body>
</html>