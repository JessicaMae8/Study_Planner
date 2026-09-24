<!DOCTYPE html>
<html>
<head>
    <title>Edit Study Task</title>
</head>
<body>

    <h1>Edit Study Task</h1>

    <form action="{{ route('study-tasks.update', $studyTask->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label for="user_id">User ID:</label>
        <input
            type="number"
            name="user_id"
            id="user_id"
            value="{{ $studyTask->user_id }}"
            required
        >

        <br><br>

        <label for="subject_id">Subject ID:</label>
        <input
            type="number"
            name="subject_id"
            id="subject_id"
            value="{{ $studyTask->subject_id }}"
            required
        >

        <br><br>

        <label for="title">Task Title:</label>
        <input
            type="text"
            name="title"
            id="title"
            value="{{ $studyTask->title }}"
            required
        >

        <br><br>

        <label for="description">Description:</label>
        <br>

        <textarea
            name="description"
            id="description"
            rows="5"
        >{{ $studyTask->description }}</textarea>

        <br><br>

        <label for="due_date">Due Date:</label>
        <input
            type="date"
            name="due_date"
            id="due_date"
            value="{{ $studyTask->due_date }}"
        >

        <br><br>

        <label for="priority">Priority:</label>
        <select name="priority" id="priority" required>

            <option value="Low"
                {{ $studyTask->priority == 'Low' ? 'selected' : '' }}>
                Low
            </option>

            <option value="Medium"
                {{ $studyTask->priority == 'Medium' ? 'selected' : '' }}>
                Medium
            </option>

            <option value="High"
                {{ $studyTask->priority == 'High' ? 'selected' : '' }}>
                High
            </option>

        </select>

        <br><br>

        <label for="status">Status:</label>
        <select name="status" id="status" required>

            <option value="Pending"
                {{ $studyTask->status == 'Pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="In Progress"
                {{ $studyTask->status == 'In Progress' ? 'selected' : '' }}>
                In Progress
            </option>

            <option value="Completed"
                {{ $studyTask->status == 'Completed' ? 'selected' : '' }}>
                Completed
            </option>

        </select>

        <br><br>

        <button type="submit">Update Study Task</button>

    </form>

    <br>

    <a href="{{ route('study-tasks.index') }}">
        Back to Study Tasks
    </a>

</body>
</html>