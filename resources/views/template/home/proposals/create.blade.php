<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Navbar start
        ***********************************-->
        @include('template.home.layouts.navbar')
        <!--**********************************
        Navbar end ti-comment-alt
        ***********************************-->

        <!--**********************************
        Sidebar start
        ***********************************-->
        @include('template.home.layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card w-75 mx-auto">
                            <div class="card-body">

                                @if($existingProposal)
                                <!-- Display the existing proposal -->
                                <div>
                                    <h4 class="card-title">Your Submitted {{ $existingProposal->type == 'project' ? 'Project' : 'Thesis' }} Proposal</h4>

                                    @if($existingProposal->status == 'approved')
                                    <span class="label label-pill label-success">Approved</span>
                                    @elseif($existingProposal->status == 'rejected')
                                    <span class="label label-pill label-danger">Rejected</span>
                                    @elseif($existingProposal->status == 'pending')
                                    <span class="label label-pill label-warning">Pending</span>
                                    @endif

                                    <a href="{{ route('proposals.edit', $existingProposal->id) }}">
                                        <button class="btn bg-transparent"><i class="fa-regular fa-pen-to-square" data-toggle="tooltip" title="Edit"></i></button>
                                    </a>

                                </div>

                                <div class="proposal-details mt-4">

                                    <div class="row">
                                        <b class="col-3">Area:</b>
                                        <p class="col-9 ">{{ $existingProposal->area }}</p>
                                    </div>


                                    <div class="row">
                                        <b class="col-3">Title:</b>
                                        <p class="col-9 ">{{ $existingProposal->title }}</p>
                                    </div>

                                    @if($existingProposal->type == 'project')
                                    <div class="row">
                                        <b class="col-3">Brief Discussion:</b>
                                        <p class="col-9 ">{{ $existingProposal->description }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Skills:</b>
                                        <p class="col-9 ">{{ $existingProposal->skills }}</p>
                                    </div>

                                    @elseif($existingProposal->type == 'thesis')
                                    <div class="row">
                                        <b class="col-3">Background Study:</b>
                                        <p class="col-9 ">{{ $existingProposal->background }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Research Questions:</b>
                                        <p class="col-9 ">{{ $existingProposal->question }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Research Objectives:</b>
                                        <p class="col-9 ">{{ $existingProposal->objective }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Skills:</b>
                                        <p class="col-9 ">{{ $existingProposal->skills }}</p>
                                    </div>
                                    @endif

                                    <!-- <div class="row">
                                        <b class="col-3">Assigned To:</b>
                                        <p class="col-9 ">{{ $existingProposal->area }}</p>
                                    </div> -->

                                </div>
                                @else

                                <h4 class="cart-title">Submit Your Proposal</h4>
                                <div>
                                    <form action="{{ route('proposals.store') }}" method="POST">
                                        @csrf
                                        <!-- Type Selection -->
                                        <div class="form-group">
                                            <label for="type">Select Type:</label>
                                            <select id="type" name="type" class="form-control rounded" required>
                                                <option value="" disabled selected>Select Type</option>
                                                <option value="project">Project</option>
                                                <option value="thesis">Thesis</option>
                                            </select>
                                        </div>

                                        <!-- Common Fields -->
                                        <div class="form-group">
                                            <label for="area">Area</label>
                                            <input type="text" id="area" name="area" class="form-control rounded" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" id="title" name="title" class="form-control rounded" required>
                                        </div>

                                        <!-- Project Fields (Shown only if 'project' is selected) -->
                                        <div id="projectFields" style="display: none;">
                                            <div class="form-group">
                                                <label for="description">A brief discussion of the topic</label>
                                                <textarea id="description" name="description" class="form-control rounded"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="projectSkills">Skill(s) needed by the students (if any) such as proficiency in Python or in a particular framework such as Laravel</label>
                                                <textarea id="projectSkills" name="project_skills" class="form-control rounded"></textarea>
                                            </div>
                                        </div>

                                        <!-- Thesis Fields (Shown only if 'thesis' is selected) -->
                                        <div id="thesisFields" style="display: none;">
                                            <div class="form-group">
                                                <label for="background">Background Study</label>
                                                <textarea id="background" name="background" class="form-control rounded"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="question">Research Questions</label>
                                                <textarea id="question" name="question" class="form-control rounded"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="objective">Research Objectives</label>
                                                <textarea id="objective" name="objective" class="form-control rounded"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="thesisSkills">Skill(s) needed by the students</label>
                                                <textarea id="thesisSkills" name="thesis_skills" class="form-control rounded"></textarea>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>


                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('template.home.layouts.footer')
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    @include('template.home.layouts.scripts')

    <script>
        document.getElementById('type').addEventListener('change', function() {
            var selectedType = this.value;

            // Clear fields when type changes
            clearFields();

            // Show/hide fields based on selected type
            document.getElementById('projectFields').style.display = selectedType === 'project' ? 'block' : 'none';
            document.getElementById('thesisFields').style.display = selectedType === 'thesis' ? 'block' : 'none';
        });

        // Function to clear all fields
        function clearFields() {
            // Clear common fields
            document.getElementById('area').value = '';
            document.getElementById('title').value = '';

            // Clear project-specific fields
            document.getElementById('description').value = '';
            document.getElementById('projectSkills').value = '';

            // Clear thesis-specific fields
            document.getElementById('background').value = '';
            document.getElementById('question').value = '';
            document.getElementById('objective').value = '';
            document.getElementById('thesisSkills').value = '';
        }
    </script>

</body>

</html>