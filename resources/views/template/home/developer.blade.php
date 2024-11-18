<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer | Ashfia Khatun</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../template/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            background-color: #B85C3C;
            color: white;
        }

        .profile-img {
            width: 350px;
            height: 350px;
            border-radius: 50%;
            object-fit: cover;
            border: 8px solid rgba(255, 255, 255, 0.2);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: white;
        }

        .name-highlight {
            color: #B85C3C;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background-color: #4A4A4A;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 10px;
            transition: opacity 0.3s;
        }

        .social-icon:hover {
            opacity: 0.8;
        }

        .min-vh-lg-100 {
            min-height: auto;
        }
        @media (min-width: 992px) {
            .min-vh-lg-100 {
                min-height: 100vh !important;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4 sidebar min-vh-lg-100 px-4 py-5 text-center">
                <img src="../../template/images/profile/developer.jpg" alt="Profile" class="profile-img mb-4">
            </div>

            <!-- Main Content -->
            <div class="col-lg-8 px-4 py-5">
                <header class="mb-5">
                    <h1 class="display-2 fw-bold mb-2">
                        ASHFIA <span class="name-highlight">KHATUN</span>
                    </h1>
                    <div class="fs-5 text-secondary mb-4">
                        Department of Information Technology and Management <br>
                        Daffodil International University <br>
                        +88 01521 565097 <br>
                        <a href="mailto:khatun51-038@diu.edu.bd" class="text-decoration-none name-highlight">khatun51-038@diu.edu.bd</a>
                    </div>
                    <p class="lead">
                        The primary objective of this application is to create a comprehensive platform that facilitates the submission, review, and management of student project and thesis proposals.
                    </p>
                </header>

                <!-- Social Icons -->
                <div>
                    <a href="https://www.linkedin.com/in/ashfia-khatun/" target="_blank" class="social-icon">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="https://github.com/ashfiaKhatun" target="_blank" class="social-icon">
                        <i class="bi bi-github"></i>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=100008428578863" target="_blank" class="social-icon">
                        <i class="bi bi-facebook"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>