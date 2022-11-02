<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TOMS WORLD | HELPDESK MONITORING</title>

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/main-icon.png') ?>" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        table th,
        table td {
            /* padding: 12px 15px; */
            padding: 3px 5px !important;
            font-size: 13px;
            vertical-align: middle;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo-main d-flex align-items-center">
                <img src="<?= base_url('assets/img/logoTW.png') ?>" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-warning badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Sample data 1</h4>
                                <p>Sample description 1</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Sample data 2</h4>
                                <p>Sample description 2</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sample data 3</h4>
                                <p>Sample description 3</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Sample data 4</h4>
                                <p>Sample description 4</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <?php if ($_SESSION['loggedIn']['photo'] != '') : ?>
                            <img src="<?= base_url() ?>uploaded_file/profile/<?= $_SESSION['loggedIn']['photo']; ?>" class="rounded-circle" alt="Pofile-Picture"><br>
                        <?php else : ?>
                            <img src="<?= base_url() ?>assets/img/avatar.jpg" alt="Profile" class="rounded-circle"><br>
                        <?php endif ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['loggedIn']['name']; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $_SESSION['loggedIn']['department']; ?></h6>
                            <span><small><i><?= $_SESSION['loggedIn']['email']; ?></i></small></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('main/myProfile') ?>">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li> -->
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('main/logout') ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?= ($this->uri->segment(2) == '' ? 'active' : 'collapsed') ?>" href="<?= base_url('main') ?>">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">

                <?php if ($this->uri->segment(2) == 'solution') : ?>
                    <a class="nav-link <?= ($this->uri->segment(2) == 'solution' ? 'active' : 'collapsed') ?>" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-person-workspace"></i><span>AI Management</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="icons-nav" class="nav-content collapse <?= ($this->uri->segment(2) == 'solution' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('solutionmanagement/solution') ?>" class="<?= ($this->uri->segment(2) == 'solution' ? 'active' : '') ?>">
                                <i class="bi bi-circle"></i><span>Solutions Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('solutionmanagement/AIsupport') ?>">
                                <i class="bi bi-circle"></i><span>AI Support</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('solutionmanagement/ticketing') ?>">
                                <i class="bi bi-circle"></i><span>Ticket Automation</span>
                            </a>
                        </li>
                    </ul>
                <?php elseif ($this->uri->segment(2) == 'AIsupport') : ?>
                    <a class="nav-link <?= ($this->uri->segment(2) == 'AIsupport' ? 'active' : 'collapsed') ?>" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-person-workspace"></i><span>AI Management</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="icons-nav" class="nav-content collapse <?= ($this->uri->segment(2) == 'AIsupport' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('solutionmanagement/solution') ?>">
                                <i class="bi bi-circle"></i><span>Solutions Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('solutionmanagement/AIsupport') ?>" class="<?= ($this->uri->segment(2) == 'AIsupport' ? 'active' : '') ?>">
                                <i class="bi bi-circle"></i><span>AI Support</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('solutionmanagement/ticketing') ?>">
                                <i class="bi bi-circle"></i><span>Ticket Automation</span>
                            </a>
                        </li>
                    </ul>

                <?php elseif ($this->uri->segment(2) == 'ticketing') : ?>
                    <a class="nav-link <?= ($this->uri->segment(2) == 'ticketing' ? 'active' : 'collapsed') ?>" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-person-workspace"></i><span>AI Management</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="icons-nav" class="nav-content collapse <?= ($this->uri->segment(2) == 'ticketing' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('solutionmanagement/solution') ?>">
                                <i class="bi bi-circle"></i><span>Solutions Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('solutionmanagement/AIsupport') ?>">
                                <i class="bi bi-circle"></i><span>AI Support</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('solutionmanagement/ticketing') ?>" class="<?= ($this->uri->segment(2) == 'ticketing' ? 'active' : '') ?>">
                                <i class="bi bi-circle"></i><span>Ticket Automation</span>
                            </a>
                        </li>
                    </ul>

                <?php else : ?>
                    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-person-workspace"></i><span>AI Management</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('solutionmanagement/solution') ?>">
                                <i class="bi bi-circle"></i><span>Solutions Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('solutionmanagement/AIsupport') ?>">
                                <i class="bi bi-circle"></i><span>AI Support</span>
                            </a>
                        </li>
                        <li>
                            <a href="t<?= base_url('solutionmanagement/ticketing') ?>">
                                <i class="bi bi-circle"></i><span>Ticket Automation</span>
                            </a>
                        </li>
                    </ul>

                <?php endif ?>




            </li><!-- End Heldesk Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#analytics-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-graph-up-arrow"></i><span>Analytics</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="analytics-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="analytics.html">
                            <i class="bi bi-circle"></i><span>Generate Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Departmental</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Analytics Nav -->

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="ticket_monitoring.html">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Ticket Monitoring</span>
                </a>
            </li><!-- End Ticketing Page Nav -->

            <li class="nav-item">
                <a class="nav-link <?= ($this->uri->segment(2) == 'accountManagement' ? 'active' : 'collapsed') ?>" href="<?= base_url('main/accountManagement') ?>">
                    <i class="bi bi-person"></i>
                    <span>Account Management</span>
                </a>
            </li><!-- End account Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>General Settings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="settings-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="department.html">
                            <i class="bi bi-circle"></i><span>Manage Department</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_permission.html">
                            <i class="bi bi-circle"></i><span>Manage User Permissions </span>
                        </a>
                    </li>
                </ul>
            </li><!-- End settings Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-download"></i>
                    <span>Export Files</span>
                </a>
            </li><!-- End export file Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-hdd-rack-fill"></i>
                    <span>Backup Database</span>
                </a>
            </li><!-- End backup db Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="forum_channel.html">
                    <i class="bi bi-chat-right-text-fill"></i>
                    <span>Forum Channel</span>
                </a>
            </li><!-- End forum Nav -->

        </ul>

    </aside><!-- End Sidebar-->