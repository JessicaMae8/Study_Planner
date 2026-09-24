<?php

namespace App\Http\Controllers;

use App\Models\StudySession;
use Illuminate\Http\Request;

class StudySessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studySessions = StudySession::with([
            'subject',
            'studyTask'
        ])->get();

        return view('study_sessions.index', compact('studySessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study_sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'study_task_id' => 'nullable|exists:study_tasks,id',
            'started_at' => 'required|date',
            'ended_at' => 'nullable|date|after_or_equal:started_at',
            'notes' => 'nullable|string',
        ]);

        StudySession::create([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'study_task_id' => $request->study_task_id,
            'started_at' => $request->started_at,
            'ended_at' => $request->ended_at,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('study-sessions.index')
            ->with('success', 'Study session created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studySession = StudySession::with([
            'subject',
            'studyTask'
        ])->findOrFail($id);

        return view('study_sessions.show', compact('studySession'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studySession = StudySession::findOrFail($id);

        return view('study_sessions.edit', compact('studySession'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'study_task_id' => 'nullable|exists:study_tasks,id',
            'started_at' => 'required|date',
            'ended_at' => 'nullable|date|after_or_equal:started_at',
            'notes' => 'nullable|string',
        ]);

        $studySession = StudySession::findOrFail($id);

        $studySession->update([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'study_task_id' => $request->study_task_id,
            'started_at' => $request->started_at,
            'ended_at' => $request->ended_at,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('study-sessions.index')
            ->with('success', 'Study session updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studySession = StudySession::findOrFail($id);

        $studySession->delete();

        return redirect()
            ->route('study-sessions.index')
            ->with('success', 'Study session deleted successfully!');
    }
}