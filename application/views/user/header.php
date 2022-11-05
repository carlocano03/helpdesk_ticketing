<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TOMS WORLD | HELPDESK MONITORING</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/main-icon.png') ?>" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

  <style>
    .card {
      background: #FFEFBA;
      background: -webkit-linear-gradient(to right, #FFFFFF, #FFEFBA);
      background: linear-gradient(to right, #FFFFFF, #FFEFBA);
      border-radius: 25px;
    }

    .card label {
      color: #f39c12;
      text-decoration: 2px underline #f39c12;
      text-underline-offset: 5px;
    }

    .card-title {
      background: #e65c00;
      background: -webkit-linear-gradient(to right, #F9D423, #e65c00);
      background: linear-gradient(to right, #F9D423, #e65c00);
      color: #fff;
      border-radius: 30px;
    }

    .title-system {
      color: #f39c12;
      text-decoration: 2px underline #f39c12;
      text-underline-offset: 5px;
      font-weight: 700;
    }

    .login-content {
      width: 100%;
      background: #FFEFBA;
      background: -webkit-linear-gradient(to left, #FFFFFF, #FFEFBA);
      background: linear-gradient(to left, #FFFFFF, #FFEFBA);
      border-radius: 40px;
    }

    .login-form {
      padding: 20px;
    }

    .btn-rounded {
      border-radius: 50px;
    }

    a {
      text-decoration: none;
      color: orange;
    }

    a:hover {
      color: orange;
      opacity: 0.7;
      text-decoration: underline;
    }

    #inputGroupPrepend {
      background: none;
    }

    #inputGroupPrepend i {
      font-size: 20px;
      color: #636e72;
    }

    #yourUsername,
    #yourPassword {
      border-left: none;
    }

    #yourUsername:focus,
    #yourPassword:focus {
      box-shadow: none;
    }

    #yourName,
    #yourPassword,
    #yourEmail,
    #confirmPassword {
      border-left: none;
    }

    #yourName:focus,
    #yourEmail:focus,
    #yourPassword:focus,
    #confirmPassword:focus {
      box-shadow: none;
    }

    .button-wrapper {
      position: relative;
      width: 150px;
      text-align: center;
      margin: 20% auto;
    }

    .button-wrapper span.label {
      position: relative;
      z-index: 0;
      display: inline-block;
      width: 100%;
      background: orange;
      cursor: pointer;
      color: #fff;
      padding: 10px 0;
      text-transform: uppercase;
      font-size: 12px;
      border-radius: 20px;
    }

    #inpFile {
      display: inline-block;
      position: absolute;
      z-index: 1;
      width: 100%;
      height: 50px;
      top: 0;
      left: 0;
      opacity: 0;
      cursor: pointer;
    }

    #pic {
      height: 150px;
      width: 150px;
    }
  </style>
</head>

<body class="login-module">