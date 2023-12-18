<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank you PM</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./scss/main.css">
</head>

<body>
    <section id="admin">
        <section id="sidebar">
            <div class="top">
                <div class="logo">
                    <a href="#">
                        <img src="./img/logo.svg" alt="">
                    </a>
                </div>
            </div>
            <ul class="list-unstyled m-0 menu accordion" id="sidebar-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="material-icons-outlined">
                            grid_view
                        </span>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <span class="material-icons-outlined">
                            dynamic_form
                        </span>
                        Batch
                    </a>
                </li>
                <!-- collapse menu -->
                <li class="nav-item accordion-item">
                    <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        <span class="material-icons-outlined">
                            people
                        </span>
                        User
                    </a>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
                        <div class="accordion-content">
                            <a href="" class="nav-link">
                                - List
                            </a>
                            <a href="" class="nav-link active">
                                - Add New
                            </a>
                            <a href="" class="nav-link">
                                - Reset
                            </a>
                            </a>

                        </div>
                    </div>
                </li>
                <!-- End collapse menu -->

            </ul>
        </section>
        <section id="right">
            <div class="backdrop overlay"></div>
            <div class="topnav" id="top-nav">
                <div class="d-flex justify-content-between align-items-center h-100">
                    <div class="left">
                        <img class="govt-logo menu-click" type="button" src="./img/govt-logo.png" alt="">
                        <!-- <div class="menu-icon menu-click">
                            <span class="material-icons-outlined text-light">
                                chevron_left
                            </span>
                        </div> -->
                    </div>
                    <div class="right">
                        <div class="userinfo" id="logout-panel">
                            <div class="dropdown">
                                <div class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="d-inline-flex align-items-center">
                                        <img class="photo d-none" src="./img/user.png" alt="">
                                        <div class="avatar">M</div>
                                        <div class="name">Md. Tariqul Islam</div>
                                        <span class="material-icons-outlined">
                                            expand_more
                                        </span>
                                    </div>

                                </div>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="identity">
                                        <div>
                                            <img class="photo  user-face d-none" src="./img/user.png" alt="">
                                            <div class="avatar user-face ">M</div>
                                        </div>
                                        <div>
                                            <div class="name">Md. Tariqul Islam</div>
                                            <div class="email">fdsfdsfsdf@example.com</div>
                                        </div>
                                    </div>
                                    <div class="links">
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">
                                                person
                                            </span>
                                            My Profile
                                        </a>
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">
                                                translate
                                            </span>
                                            Language: English(US)
                                        </a>
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">
                                                settings
                                            </span>
                                            Settings
                                        </a>
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">
                                                help_outline
                                            </span>
                                            Help
                                        </a>
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">
                                                feedback
                                            </span>
                                            Send Feedback
                                        </a>
                                    </div>
                                    <div class="logout">
                                        <form action="">
                                            <button class="btn logout-btn ">
                                                <span class="material-icons-outlined">
                                                    logout
                                                </span>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="main-content">
                <div class="page-title">
                    <div class="d-flex justify-content-between align-items-end">
                        <h1 class="title">Create User</h1>
                    </div>
                </div>

                <div class="page-content">

                </div>


            </div>
            <footer id="footer">
                <div class="left">
                    ©২০২৩ হার পাওয়ার প্রজেক্ট
                </div>
                <div class="center">
                    <img src="./img/footer-logo.png" alt="">
                </div>
                <div class="right">
                    তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ
                </div>
            </footer>
        </section>
    </section>



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/admin.js"></script>


</body>

</html>