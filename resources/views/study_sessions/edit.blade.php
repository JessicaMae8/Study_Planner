<!DOCTYPE html>
<html>
<head>
    <title>Edit Study Session</title>
</head>
<body>

    <h1>Edit Study Session</h1>

    <form action="{{ route('study-sessions.update', $studySession->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label for="user_id">User ID:</label>
        <input
            type="number"
            name="user_id"
            id="user_id"
            value="{{ $studySession->user_id }}"
            required
        >

        <br><br>

        <label for="subject_id">Subject ID:</label>
        <input
            type="number"
            name="subject_id"
            id="subject_id"
            value="{{ $studySession->subject_id }}"
            required
        >

        <br><br>

        <label for="study_task_id">Study Task ID:</label>
        <input
            type="number"
            name="study_task_id"
            id="study_task_id"
            value="{{ $studySession->study_task_id }}"
        >

        <br><br>

        <label for="started_at">Started At:</label>
        <input
            type="datetime-local"
            name="started_at"
            id="started_at"
            value="{{ $studySession->started_at
                ? \Carbon\Carbon::parse($studySession->started_at)->format('Y-m-d\TH:i')
                : '' }}"
            required
        >

        <br><br>

        <label for="ended_at">Ended At:</label>
        <input
            type="datetime-local"
            name="ended_at"
            id="ended_at"
            value="{{ $studySession->ended_at
                ? \Carbon\Carbon::parse($studySession->ended_at)->format('Y-m-d\TH:i')
                : '' }}"
        >

        <br><br>

        <label for="notes">Notes:</label>
        <br>

        <textarea
            name="notes"
            id="notes"
            rows="5"
        >{{ $studySession->notes }}</textarea>

        <br><br>

        <button type="submit">Update Study Session</button>

    </form>

    <br>

    <a href="{{ route('study-sessions.index') }}">
        Back to Study Sessions
    </a>

</body>
</html>