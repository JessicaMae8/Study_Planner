<?php

namespace App\Http\Controllers;

use App\Models\StudyTask;
use Illuminate\Http\Request;

class StudyTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studyTasks = StudyTask::with('subject')->get();

        return view('study_tasks.index', compact('studyTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study_tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        StudyTask::create([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('study-tasks.index')
            ->with('success', 'Study task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studyTask = StudyTask::with('subject')->findOrFail($id);

        return view('study_tasks.show', compact('studyTask'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studyTask = StudyTask::findOrFail($id);

        return view('study_tasks.edit', compact('studyTask'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $studyTask = StudyTask::findOrFail($id);

        $studyTask->update([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('study-tasks.index')
            ->with('success', 'Study task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studyTask = StudyTask::findOrFail($id);

        $studyTask->delete();

        return redirect()
            ->route('study-tasks.index')
            ->with('success', 'Study task deleted successfully!');
    }
}