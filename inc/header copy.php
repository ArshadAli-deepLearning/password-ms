<?php
$domain = '/password-ms';
$basepath = realpath(__DIR__ . '/..');

include_once $basepath . "/lib/Session.php";
Session::init();

spl_autoload_register(function ($classes) use ($basepath) {
  include $basepath . "/classes/" . $classes . ".php";
});

$users = new Users();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PHP CRUD User Management</title>
  <link rel="stylesheet" href="<?php echo $domain; ?>/assets/bootstrap.min.css">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $domain; ?>/assets/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $domain; ?>/assets/style.css">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


</head>

<body>
  <?php
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
  }
  ?>

  <div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3" style="min-width: 250px; height: 100vh;">
      <h4 style="color:white;">Password Management System</h4>
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="<?php echo $domain; ?>/index.php"><i class="fas fa-home mr-2"></i>Home</a>
        </li>
        <?php if (Session::get('id') == TRUE) { ?>
          <?php if (Session::get('roleid') == '1') { ?>
            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="<?php echo $domain; ?>/dashboard.php"><i class="fas fa-users mr-2"></i>User lists</a>
            </li>
            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="<?php echo $domain; ?>/addUser.php"><i class="fas fa-user-plus mr-2"></i>Add user</a>
            </li>
            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="<?php echo $domain; ?>/tutorials/index.php"><i class="fas fa-folder mr-2"></i>List Tutorial</a>
            </li>
            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="<?php echo $domain; ?>/tutorials/add.php"><i class="fas fa-folder-plus mr-2"></i>Add Tutorial</a>
            </li>
            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="<?php echo $domain; ?>/interactive_quiz.php"><i class="fas fa-folder mr-2"></i>List Quiz</a>
            </li>
            <li class="nav-item mb-2">
              <a class="nav-link text-white" href="<?php echo $domain; ?>/addquiz.php"><i class="fas fa-folder-plus mr-2"></i>Add Quiz</a>
            </li>
          <?php } ?>
          <li class="nav-item mb-2">
            <a class="nav-link text-white" href="<?php echo $domain; ?>/profile.php?id=<?php echo Session::get('id'); ?>"><i class="fab fa-500px mr-2"></i>Profile</a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link text-white" href="<?php echo $domain; ?>/passwords/add.php"><i class="fas fa-plus mr-2"></i>Add Password</a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link text-white" href="<?php echo $domain; ?>/passwords/index.php"><i class="fas fa-lock mr-2"></i>List Passwords</a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link text-white" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-item mb-2">
            <a class="nav-link text-white" href="<?php echo $domain; ?>/register.php"><i class="fas fa-user-plus mr-2"></i>Register</a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link text-white" href="<?php echo $domain; ?>/login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
          </li>
        <?php } ?>
      </ul>
    </nav>