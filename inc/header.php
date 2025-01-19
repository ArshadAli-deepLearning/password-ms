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
  <link rel="stylesheet" href="<?php echo $domain;?>/assets/bootstrap.min.css">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $domain;?>/assets/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $domain;?>/assets/style.css">
</head>

<body>
  <?php
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
  }
  ?>

  <div class="container">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">
      <a class="navbar-brand" href="<?php echo $domain;?>/index.php"><i class="fas fa-home mr-2"></i>Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '1') { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $domain;?>/index.php"><i class="fas fa-users mr-2"></i>User lists</a>
              </li>
              <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'addUser.php') ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo $domain;?>/addUser.php"><i class="fas fa-user-plus mr-2"></i>Add user</a>
              </li>
              <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'index.php' && strpos($_SERVER['SCRIPT_FILENAME'], 'tutorials') !== false) ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo $domain;?>/tutorials/index.php"><i class="fas fa-folder mr-2"></i>List Tutorial</a>
              </li>
              <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'add.php' && strpos($_SERVER['SCRIPT_FILENAME'], 'tutorials') !== false) ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo $domain;?>/tutorials/add.php"><i class="fas fa-folder mr-2"></i>Add Tutorial</a>
              </li>
            <?php } ?>
            <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'profile.php') ? ' active' : ''; ?>">
              <a class="nav-link" href="<?php echo $domain;?>/profile.php?id=<?php echo Session::get('id'); ?>"><i class="fab fa-500px mr-2"></i>Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
            </li>
          <?php } else { ?>
            <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'register.php') ? ' active' : ''; ?>">
              <a class="nav-link" href="<?php echo $domain;?>/register.php"><i class="fas fa-user-plus mr-2"></i>Register</a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'login.php') ? ' active' : ''; ?>">
              <a class="nav-link" href="<?php echo $domain;?>/login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </div>