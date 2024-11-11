<div class="nk-sidebar position-fixed">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">


            @if(auth()->user()->isSuperAdmin)
            <li>
                <a href="{{ route('departments.index') }}" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text">Departments</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admins.index') }}" aria-expanded="false">
                    <i class="fa-solid fa-user-tie"></i><span class="nav-text">Admins</span>
                </a>
            </li>
            @endif
            
            @if(auth()->user()->isAdmin)
            <li>
                <a href="{{ route('supervisors.index') }}" aria-expanded="false">
                    <i class="fa-solid fa-chalkboard-teacher"></i><span class="nav-text">Supervisors</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('students.index') }}" aria-expanded="false">
                    <i class="fa-solid fa-user-graduate"></i><span class="nav-text">Students</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->role == 'student')
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Proposals</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('proposals.create') }}">Submit Proposal</a></li>
                    <li><a href="{{ route('proposals.indexSubmission') }}">My Submissions</a></li>
                </ul>
            </li>
            @endif
            
            @if(auth()->user()->isAdmin)
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Proposals</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('proposals.pending') }}">Pending Proposals</a></li>
                    <li><a href="{{ route('department.proposals.thesis') }}">Thesis Proposals</a></li>
                    <li><a href="{{ route('department.proposals.project') }}">Project Proposals</a></li>
                </ul>
            </li>
            @endif

            @if(auth()->user()->role == 'supervisor')
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Assigned Students</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('supervisor.proposals.thesis') }}">Thesis Proposals</a></li>
                    <li><a href="{{ route('supervisor.proposals.project') }}">Project Proposals</a></li>
                </ul>
            </li>
            @endif

        </ul>
    </div>
</div>