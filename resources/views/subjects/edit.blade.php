<!DOCTYPE html>
<html>
<head>
    <title>Edit Subject</title>
</head>
<body>

    <h1>Edit Subject</h1>

    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label for="user_id">User ID:</label>
        <input
            type="number"
            name="user_id"
            id="user_id"
            value="{{ $subject->user_id }}"
            required
        >

        <br><br>

        <label for="name">Subject Name:</label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ $subject->name }}"
            required
        >

        <br><br>

        <label for="description">Description:</label>
        <br>

        <textarea
            name="description"
            id="description"
            rows="5"
        >{{ $subject->description }}</textarea>

        <br><br>

        <button type="submit">Update Subject</button>

    </form>

    <br>

    <a href="{{ route('subjects.index') }}">
        Back to Subjects
    </a>

</body>
</html>