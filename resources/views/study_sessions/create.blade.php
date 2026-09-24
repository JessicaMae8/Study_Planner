<!DOCTYPE html>
<html>
<head>
    <title>Add Study Session</title>
</head>
<body>

    <h1>Add New Study Session</h1>

    <form action="{{ route('study-sessions.store') }}" method="POST">

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

        <label for="study_task_id">Study Task ID:</label>
        <input
            type="number"
            name="study_task_id"
            id="study_task_id"
        >

        <br><br>

        <label for="started_at">Started At:</label>
        <input
            type="datetime-local"
            name="started_at"
            id="started_at"
            required
        >

        <br><br>

        <label for="ended_at">Ended At:</label>
        <input
            type="datetime-local"
            name="ended_at"
            id="ended_at"
        >

        <br><br>

        <label for="notes">Notes:</label>
        <br>

        <textarea
            name="notes"
            id="notes"
            rows="5"
        ></textarea>

        <br><br>

        <button type="submit">Save Study Session</button>

    </form>

    <br>

    <a href="{{ route('study-sessions.index') }}">
        Back to Study Sessions
    </a>

</body>
</html>