<!DOCTYPE html>
<html>
<head>
    <title>Add Study Task</title>
</head>
<body>

    <h1>Add New Study Task</h1>

    <form action="{{ route('study-tasks.store') }}" method="POST">

        @csrf

        <label for="user_id">User ID:</label>
        <input
            type="number"
            name="user_id"
            id="user_id"
            required
        >

        <br><br>

        <label for="subject_id">Subject ID:</label>
        <input
            type="number"
            name="subject_id"
            id="subject_id"
            required
        >

        <br><br>

        <label for="title">Task Title:</label>
        <input
            type="text"
            name="title"
            id="title"
            required
        >

        <br><br>

        <label for="description">Description:</label>
        <br>

        <textarea
            name="description"
            id="description"
            rows="5"
        ></textarea>

        <br><br>

        <label for="due_date">Due Date:</label>
        <input
            type="date"
            name="due_date"
            id="due_date"
        >

        <br><br>

        <label for="priority">Priority:</label>
        <select name="priority" id="priority" required>
            <option value="Low">Low</option>
            <option value="Medium" selected>Medium</option>
            <option value="High">High</option>
        </select>

        <br><br>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Pending" selected>Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select>

        <br><br>

        <button type="submit">Save Study Task</button>

    </form>

    <br>

    <a href="{{ route('study-tasks.index') }}">
        Back to Study Tasks
    </a>

</body>
</html>