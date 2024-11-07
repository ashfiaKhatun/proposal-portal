<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;

class ProposalController extends Controller
{

    public function indexSupervisorThesisProposals()
    {
        if (auth()->user()->role == 'supervisor') {

            // Get the logged-in teacher's official_id
            $supervisorId = auth()->user()->official_id;

            // Fetch all thesis proposals assigned to the logged-in supervisor
            $proposals = Proposal::where('type', 'thesis')
                ->where('ass_teacher_id', $supervisorId)
                ->with('student', 'assignedTeacher')
                ->get();

            $supervisors = User::where('role', 'supervisor')->get();

            $type = 'thesis';
            $showExtraColumns = false;

            return view('template.home.proposals.index', compact('proposals', 'supervisors', 'type', 'showExtraColumns'));  // Return the view with proposals
        } else {
            return redirect('/');
        }
    }

    public function indexSupervisorProjectProposals()
    {
        if (auth()->user()->role == 'supervisor') {

            // Get the logged-in teacher's official_id
            $supervisorId = auth()->user()->official_id;

            // Fetch all project proposals assigned to the logged-in supervisor
            $proposals = Proposal::where('type', 'project')
                ->where('ass_teacher_id', $supervisorId)
                ->with('student', 'assignedTeacher')
                ->get();

            $supervisors = User::where('role', 'supervisor')->get();

            $type = 'project';
            $showExtraColumns = false;

            return view('template.home.proposals.index', compact('proposals', 'supervisors', 'type', 'showExtraColumns'));  // Return the view with proposals
        } else {
            return redirect('/');
        }
    }

    public function indexDepartmentThesisProposals()
    {
        if (auth()->user()->isAdmin) {

            // Get the logged-in teacher's dept_id
            $department = auth()->user()->dept_id;

            // Fetch all thesis proposals assigned to the logged-in supervisor
            $proposals = Proposal::where('type', 'thesis')
                ->where('dept_id', $department)
                ->with('student', 'assignedTeacher')
                ->get();

            $supervisors = User::where('role', 'supervisor')
                ->where('dept_id', $department)
                ->get();

            $type = 'thesis';
            $showExtraColumns = true;

            return view('template.home.proposals.index', compact('proposals', 'supervisors', 'type', 'showExtraColumns'));  // Return the view with proposals
        } else {
            return redirect('/');
        }
    }

    public function indexDepartmentProjectProposals()
    {
        if (auth()->user()->isAdmin) {

            // Get the logged-in teacher's official_id
            $department = auth()->user()->dept_id;

            // Fetch all thesis proposals assigned to the logged-in supervisor
            $proposals = Proposal::where('type', 'project')
                ->where('dept_id', $department)
                ->with('student', 'assignedTeacher')
                ->get();

            $supervisors = User::where('role', 'supervisor')
                ->where('dept_id', $department)
                ->get();

            $type = 'project';
            $showExtraColumns = true;

            return view('template.home.proposals.index', compact('proposals', 'supervisors', 'type', 'showExtraColumns'));  // Return the view with proposals
        } else {
            return redirect('/');
        }
    }

    public function indexSubmission()
    {
        if (auth()->user()->role == 'student') {

            // Get the logged-in teacher's official_id
            $studentId = auth()->user()->official_id;

            // Fetch all project proposals assigned to the logged-in supervisor
            $proposals = Proposal::where('student_id', $studentId)
                ->with('student', 'assignedTeacher')
                ->get();

            $supervisors = User::where('role', 'supervisor')->get();

            $type = '';
            $showExtraColumns = false;

            return view('template.home.proposals.index', compact('proposals', 'supervisors', 'type', 'showExtraColumns'));  // Return the view with proposals
        } else {
            return redirect('/');
        }
    }

    public function show($id)
    {
        $proposal = Proposal::with('student', 'assignedTeacher')->findOrFail($id);

        $user = auth()->user();

        // Check if the user is the student who submitted the proposal
        if ($user->official_id === $proposal->student_id) {
            $hasAccess = true;
        }
        // Check if the user is the admin of the department that matches the proposal's dept_id
        elseif ($user->isAdmin && $user->dept_id === $proposal->dept_id) {
            $hasAccess = true;
        }
        // Check if the user is the assigned supervisor for this proposal
        elseif ($user->role === 'supervisor' && $user->official_id === $proposal->ass_teacher_id && $user->dept_id === $proposal->dept_id) {
            $hasAccess = true;
        }
        // Check if the user is a super admin
        elseif ($user->isSuperAdmin) {
            $hasAccess = true;
        } else {
            $hasAccess = false;
        }

        // If the user has no access, redirect or return a 403 error
        if (!$hasAccess) {
            return redirect('/');
        }

        $department = auth()->user()->dept_id;
        $supervisors = User::where('role', 'supervisor')
            ->where('dept_id', $department)
            ->get();

        $feedbacks = Feedback::where('prop_id', $id)->get();

        return view('template.home.proposals.show', compact('proposal', 'supervisors', 'feedbacks'));
    }

    public function create()
    {
        if (auth()->user()->role == 'student') {
            $user = auth()->user();
            $existingProposal = Proposal::with('assignedTeacher')
                ->where('student_id', $user->official_id)
                ->where('status', '!=', 'rejected')
                ->first();

            $feedbacks = Feedback::where('prop_id', $existingProposal->id)->get();

            return view('template.home.proposals.create', compact('existingProposal', 'feedbacks'));
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 'student') {
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
        } else {
            return redirect('/');
        }
    }

    public function edit($id)
    {
        if (auth()->user()->role == 'student') {
            $user = auth()->user();
            $proposal = Proposal::where('student_id', $user->official_id)->where('id', $id)->firstOrFail();

            if ($proposal->status === 'pending') {
                return view('template.home.proposals.edit', compact('proposal'));
            } else {
                return redirect()->route('proposals.create');
            }
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role == 'student') {
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
                return redirect()->route('proposals.create', $proposal->id);
            }

            // Redirect with an error message
            return redirect()->route('proposals.create', $proposal->id);
        } else {
            return redirect('/');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);  // Find the proposal by ID

        if (auth()->user()->isAdmin && auth()->user()->dept_id === $proposal->dept_id) {
            // Validate that the status is one of the allowed values
            $request->validate([
                'status' => 'required|in:pending,approved,rejected',
            ]);

            // Update the status
            $proposal->update(['status' => $request->status]);

            // Return a success response (you can return a JSON response for AJAX)
            return redirect()->back();
        } else {
            return redirect('/');
        }
    }

    public function assignTeacher(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        if (auth()->user()->isAdmin && auth()->user()->dept_id === $proposal->dept_id) {
            // Update the ass_teacher_id in proposals
            $proposal->ass_teacher_id = $request->input('ass_teacher_id');
            $proposal->save();

            // Update the assigned_teacher in users
            $student = User::where('official_id', $proposal->student_id)->first();
            if ($student) {
                $student->assigned_teacher = $proposal->ass_teacher_id;
                $student->save();
            }

            return redirect()->back()->with('success', 'Supervisor assigned successfully!');
        } else {
            return redirect('/');
        }
    }

    public function giveFeedback(Request $request, $id)
    {
        // Validate the feedback input
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        // Find the proposal by ID
        $proposal = Proposal::findOrFail($id);

        if (auth()->user()->role == 'supervisor' && auth()->user()->dept_id === $proposal->dept_id) {

            Feedback::create([
                'feedback' => $request->feedback,
                'prop_id' => $proposal->id,
            ]);

            // Redirect back with success message
            return back()->with('success', 'Feedback submitted successfully.');
        } else {
            return redirect('/');
        }
    }
}
