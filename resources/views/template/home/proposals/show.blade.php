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

                                <div>
                                    <h4 class="card-title">Submitted Proposal</h4>

                                    @if($proposal->status == 'approved')
                                    <span class="label label-pill label-success">Approved</span>
                                    @elseif($proposal->status == 'rejected')
                                    <span class="label label-pill label-danger">Rejected</span>
                                    @elseif($proposal->status == 'pending')
                                    <span class="label label-pill label-warning">Pending</span>
                                    @endif

                                </div>

                                <div class="proposal-details mt-4">

                                    <div class="row">
                                        <b class="col-3">Area:</b>
                                        <p class="col-9 ">{{ $proposal->area }}</p>
                                    </div>


                                    <div class="row">
                                        <b class="col-3">Title:</b>
                                        <p class="col-9 ">{{ $proposal->title }}</p>
                                    </div>

                                    @if($proposal->type == 'project')
                                    <div class="row">
                                        <b class="col-3">Brief Discussion:</b>
                                        <p class="col-9 ">{{ $proposal->description }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Skills:</b>
                                        <p class="col-9 ">{{ $proposal->skills }}</p>
                                    </div>

                                    @elseif($proposal->type == 'thesis')
                                    <div class="row">
                                        <b class="col-3">Background Study:</b>
                                        <p class="col-9 ">{{ $proposal->background }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Research Questions:</b>
                                        <p class="col-9 ">{{ $proposal->question }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Research Objectives:</b>
                                        <p class="col-9 ">{{ $proposal->objective }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Skills:</b>
                                        <p class="col-9 ">{{ $proposal->skills }}</p>
                                    </div>
                                    @endif

                                    <!-- <div class="row">
                                        <b class="col-3">Assigned To:</b>
                                        <p class="col-9 ">{{ $proposal->area }}</p>
                                    </div> -->

                                </div>
                                

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