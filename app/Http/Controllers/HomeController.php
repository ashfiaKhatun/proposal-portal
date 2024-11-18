<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin) {
            // Get the logged-in teacher's dept_id
            $department = auth()->user()->dept_id;

            $proposalCount = Proposal::where('dept_id', $department)
                ->with('student', 'assignedTeacher')
                ->count();

            $thesisProposalCount = Proposal::where('status', 'approved')
                ->where('type', 'thesis')
                ->where('dept_id', $department)
                ->with('student', 'assignedTeacher')
                ->count();

            $projectProposalCount = Proposal::where('status', 'approved')
                ->where('type', 'project')
                ->where('dept_id', $department)
                ->with('student', 'assignedTeacher')
                ->count();

            $pendingProposalCount = Proposal::where('status', 'pending')
                ->where('dept_id', $department)
                ->with('student', 'assignedTeacher')
                ->count();

            $proposals = Proposal::where('status', 'pending')
                ->where('dept_id', $department)
                ->with('student', 'assignedTeacher')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            return view('template.home.index', compact('proposalCount', 'thesisProposalCount', 'projectProposalCount', 'pendingProposalCount', 'proposals'));

        } elseif (auth()->user()->role == 'supervisor') {
            // Get the logged-in teacher's official_id
            $supervisorId = auth()->user()->official_id;
            $department = auth()->user()->dept_id;

            $proposalCount = Proposal::where('dept_id', $department)
                ->where('ass_teacher_id', $supervisorId)
                ->with('student', 'assignedTeacher')
                ->count();

            $thesisProposalCount = Proposal::where('status', 'approved')
                ->where('type', 'thesis')
                ->where('dept_id', $department)
                ->where('ass_teacher_id', $supervisorId)
                ->with('student', 'assignedTeacher')
                ->count();

            $projectProposalCount = Proposal::where('status', 'approved')
                ->where('type', 'project')
                ->where('dept_id', $department)
                ->where('ass_teacher_id', $supervisorId)
                ->with('student', 'assignedTeacher')
                ->count();

            // Fetch all thesis proposals assigned to the logged-in supervisor
            $proposals = Proposal::where('ass_teacher_id', $supervisorId)
                ->with('student', 'assignedTeacher')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            return view('template.home.index', compact('proposalCount', 'thesisProposalCount', 'projectProposalCount', 'proposals'));
        }
        return view('template.home.index');
    }
}
