<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
</head>
<body>

    <h1>Add New Subject</h1>

    <form action="{{ route('subjects.store') }}" method="POST">

        @csrf

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" id="user_id" required>

        <br><br>

        <label for="name">Subject Name:</label>
        <input type="text" name="name" id="name" required>

        <br><br>

        <label for="description">Description:</label>
        <br>
        <textarea name="description" id="description" rows="5"></textarea>

        <br><br>

        <button type="submit">Save Subject</button>

    </form>

    <br>

    <a href="{{ route('subjects.index') }}">Back to Subjects</a>

</body>
</html>
