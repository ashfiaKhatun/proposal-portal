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

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mx-auto">
                            <div class="card-body">

                                <h4 class="cart-title">Edit Your Proposal</h4>
                                <div>
                                    <form action="{{ route('proposals.update', $proposal->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Type Selection -->
                                        <div class="form-group">
                                            <label for="type">Select Type:</label>
                                            <select id="type" name="type" class="form-control rounded" required>
                                                <option value="project" {{ $proposal->type == 'project' ? 'selected' : '' }}>Project</option>
                                                <option value="thesis" {{ $proposal->type == 'thesis' ? 'selected' : '' }}>Thesis</option>
                                            </select>
                                        </div>

                                        <!-- Common Fields -->
                                        <div class="form-group">
                                            <label for="area">Area</label>
                                            <input type="text" id="area" name="area" value="{{ $proposal->area }}" class="form-control rounded" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" id="title" name="title" value="{{ $proposal->title }}" class="form-control rounded" required>
                                        </div>

                                        <!-- Project Fields (Shown only if 'project' is selected) -->
                                        <div id="projectFields" style="display: none;">
                                            <div class="form-group">
                                                <label for="description">A brief discussion of the topic</label>
                                                <textarea id="description" name="description" class="form-control rounded">{{ $proposal->description }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="projectSkills">Skill(s) needed by the students (if any) such as proficiency in Python or in a particular framework such as Laravel</label>
                                                <textarea id="projectSkills" name="project_skills" class="form-control rounded">{{ $proposal->skills }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Thesis Fields (Shown only if 'thesis' is selected) -->
                                        <div id="thesisFields" style="display: none;">
                                            <div class="form-group">
                                                <label for="background">Background Study</label>
                                                <textarea id="background" name="background" class="form-control rounded">{{ $proposal->background }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="question">Research Questions</label>
                                                <textarea id="question" name="question" class="form-control rounded">{{ $proposal->question }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="objective">Research Objectives</label>
                                                <textarea id="objective" name="objective" class="form-control rounded">{{ $proposal->objective }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="thesisSkills">Skill(s) needed by the students</label>
                                                <textarea id="thesisSkills" name="thesis_skills" class="form-control rounded">{{ $proposal->skills }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>

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
    @include('template.home.layouts.custom_scripts.sweet_alert_script')


    <script>
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

        // Function to show/hide fields based on selected type
        function toggleFields() {
            var selectedType = document.getElementById('type').value;
            document.getElementById('projectFields').style.display = selectedType === 'project' ? 'block' : 'none';
            document.getElementById('thesisFields').style.display = selectedType === 'thesis' ? 'block' : 'none';
        }

        // Event listener for changing type
        document.getElementById('type').addEventListener('change', function() {
            clearFields();
            toggleFields();
        });

        // On page load, show the correct fields based on the current type
        window.onload = function() {
            toggleFields();
        };
    </script>

</body>

</html>