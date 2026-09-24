<!DOCTYPE html>
<html>
<head>
    <title>Subjects</title>
</head>
<body>

    <h1>My Subjects</h1>

    <a href="{{ route('subjects.create') }}">Add Subject</a>

    <hr>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($subjects->count() > 0)

        @foreach($subjects as $subject)

            <h3>{{ $subject->name }}</h3>

            <p>{{ $subject->description }}</p>

            <a href="{{ route('subjects.show', $subject->id) }}">
                View
            </a>

            <a href="{{ route('subjects.edit', $subject->id) }}">
                Edit
            </a>

            <form action="{{ route('subjects.destroy', $subject->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="submit">
                    Delete
                </button>

            </form>

            <hr>

        @endforeach

    @else

        <p>No subjects found.</p>

    @endif

</body>
</html>