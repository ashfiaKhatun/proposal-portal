<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function indexThesis()
    {
        $proposals = Proposal::where('type', 'thesis')
            ->with('student', 'assignedTeacher')
            ->get();  // Fetch all thesis proposals from the database

        $supervisors = User::where('role', 'supervisor')->get();

        return view('template.home.proposals.index_thesis', compact('proposals', 'supervisors'));  // Return the view with proposals
    }

    public function indexProject()
    {
        $proposals = Proposal::where('type', 'project')
            ->with('student', 'assignedTeacher')
            ->get();  // Fetch all thesis proposals from the database

        $supervisors = User::where('role', 'supervisor')->get();

        return view('template.home.proposals.index_project', compact('proposals', 'supervisors'));  // Return the view with proposals
    }

    public function show($id)
    {
        $proposal = Proposal::with('student', 'assignedTeacher')->findOrFail($id);

        return view('template.home.proposals.show', compact('proposal'));
    }

    public function create()
    {
        $user = auth()->user();
        $existingProposal = Proposal::where('student_id', $user->official_id)
            ->where('status', '!=', 'rejected')
            // ->where('role', 'student')
            ->first();

        return view('template.home.proposals.create', compact('existingProposal'));
    }

    public function store(Request $request)
    {
        // Get logged-in user (student)
        $user = auth()->user();

        $existingProposal = Proposal::where('student_id', $user->official_id)
            ->where('status', '!=', 'rejected')
            ->first();

        if ($existingProposal) {
            // If a proposal already exists, redirect back with an error message
            return redirect()->back();
        }

        // Validate the request
        $validatedData = $request->validate([
            'type' => 'required|string',
            'area' => 'required|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'background' => 'nullable|string',
            'question' => 'nullable|string',
            'objective' => 'nullable|string',
            'project_skills' => 'nullable|string',  // For project-specific skills
            'thesis_skills' => 'nullable|string',   // For thesis-specific skills
        ]);

        // Create a new proposal
        $proposal = new Proposal();
        $proposal->type = $validatedData['type'];
        $proposal->area = $validatedData['area'];
        $proposal->title = $validatedData['title'];

        // Conditionally store fields based on the selected type
        if ($request->type == 'project') {
            $proposal->description = $validatedData['description'];
            $proposal->skills = $validatedData['project_skills'];  // Store project skills
        } elseif ($request->type == 'thesis') {
            $proposal->background = $validatedData['background'];
            $proposal->question = $validatedData['question'];
            $proposal->objective = $validatedData['objective'];
            $proposal->skills = $validatedData['thesis_skills'];  // Store thesis skills
        }

        // Add foreign keys: student_id, user_id, and dept_id
        $proposal->student_id = $user->official_id;  // Assuming `official_id` is the student's ID
        $proposal->user_id = $user->id;              // `user_id` from the logged-in user
        $proposal->dept_id = $user->dept_id;          // Assuming `dept_id` is related to the department

        // Save the proposal to the database
        $proposal->save();

        // Redirect with a success message
        return redirect()->route('proposals.create')->with('success', 'Proposal submitted successfully!');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $proposal = Proposal::where('student_id', $user->official_id)->where('id', $id)->firstOrFail();

        if ($proposal->status === 'pending') {
            return view('template.home.proposals.edit', compact('proposal'));
        } else {
            return redirect()->route('template.home.proposals.show', $id)->with('alert', 'You cannot edit this proposal because it has been approved or rejected.');
        }
    }

    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        if ($proposal->status === 'pending') {
            // Handle skills based on the proposal type
            $skills = $request->type === 'project' ? $request->project_skills : $request->thesis_skills;

            // Update the proposal, including the determined 'skills'
            $proposal->update(array_merge(
                $request->only(['type', 'area', 'title', 'description', 'background', 'question', 'objective']),
                ['skills' => $skills]
            ));

            // Redirect with a success message
            return redirect()->route('proposals.create', $proposal->id)->with('alert-success', 'Proposal updated successfully.');
        }

        // Redirect with an error message
        return redirect()->route('proposals.create', $proposal->id)->with('alert-error', 'You cannot edit this proposal.');
    }

    public function updateStatus(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);  // Find the proposal by ID

        // Validate that the status is one of the allowed values
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Update the status
        $proposal->update(['status' => $request->status]);

        // Return a success response (you can return a JSON response for AJAX)
        return redirect()->back();
    }

    public function assignTeacher(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        // Update the ass_teacher_id in proposals
        $proposal->ass_teacher_id = $request->input('ass_teacher_id');
        $proposal->save();

        // Update the assigned_teacher in users
        $supervisor = User::where('official_id', $proposal->ass_teacher_id)->first();
        if ($supervisor) {
            $supervisor->assigned_teacher = $proposal->ass_teacher_id;
            $supervisor->save();
        }

        return redirect()->back()->with('success', 'Supervisor assigned successfully!');
    }
}
