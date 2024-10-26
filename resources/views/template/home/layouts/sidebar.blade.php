<div class="nk-sidebar position-fixed">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">


            <li>
                <a href="{{ route('departments.index') }}" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text">Departments</span>
                </a>
            </li>

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

            <li>
                <a href="{{ route('proposals.create') }}" aria-expanded="false">
                    <i class="icon-note menu-icon"></i><span class="nav-text">Proposal</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-note menu-icon"></i><span class="nav-text">Proposals</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('proposals.indexThesis') }}">Thesis Proposals</a></li>
                    <li><a href="{{ route('proposals.indexProject') }}">Project Proposals</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-note menu-icon"></i><span class="nav-text">Assigned Students</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('supervisor.proposals.thesis') }}">Thesis Proposals</a></li>
                    <li><a href="{{ route('supervisor.proposals.project') }}">Project Proposals</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>