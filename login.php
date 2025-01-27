<?php
include_once __DIR__ . "/lib/Session.php";
Session::init();
Session::CheckLogin();

// Include the Users class
include_once __DIR__ . "/classes/Users.php";
$users = new Users();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
    echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
    echo $logout;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">

    <title>Login Page</title>
</head>

<body>
    <!-- Navbar remains unchanged -->
    <nav class="nav" id="nav">
        <div class="nav-center">
            <div class="nav-header">
                <h5 style="color:blue;">Password Management System</h5>
                <button class="nav-btn" id="nav-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">home</a></li>
                <li><a href="blog.php">Blog</a></li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="UserDropdown" data-toggle="dropdown" aria-expanded="false">
                        User
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="UserDropdown">
                        <li><a class="dropdown-item" href="user.html">User</a></li>
                        <li><a class="dropdown-item" href="login.php">login</a></li>
                        <li><a class="dropdown-item" href="register.php">register</a></li>
                    </ul>
                </div>
            </ul>
        </div>
    </nav>

    <!-- Sidebar remains unchanged -->
    <aside class="sidebar" id="sidebar">
        <div>
            <button id="close-btn" class="close-btn">
                <i class="fas fa-times"></i>
            </button>
            <ul class="sidebar-links">
                <li><a href="index.php">home</a></li>
                <li><a href="blog.php">Blog</a></li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="UserDropdown" data-toggle="dropdown" aria-expanded="false">
                        User
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="UserDropdown">
                        <li><a class="dropdown-item" href="user.html">User</a></li>
                        <li><a class="dropdown-item" href="login.php">login</a></li>
                        <li><a class="dropdown-item" href="register.php">register</a></li>
                    </ul>
                </div>
            </ul>
        </div>
    </aside>

    <!-- Login Form -->
    <div class="pb-5">
        <div class="container d-flex justify-content-center">
            <article class="contact-form">
                <h3>User Login</h3>
                <p>If you don't have a registered account, you can register <a href="register.php">here!</a></p>
                <form method="post" action="">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email address" class="form-control mb-3" required />
                        <input type="password" name="password" placeholder="Password" class="form-control mb-3" required />
                    </div>
                    <p><a href="#">Forgot password?</a></p>
                    <button type="submit" name="login" class="contact-btn btn btn-primary">Login</button>
                </form>
            </article>
        </div>
    </div>
    <br><br><br>    <br><br><br>
    <!-- Footer -->
    <footer class="footer">
        <ul class="social-icons mt-5">
            <li class="pr-3">
                <a href="https://www.facebook.com" class="social-icon">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com" class="social-icon">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
            <li>
                <a href="https://www.squarespace.com" class="social-icon">
                    <i class="fab fa-squarespace"></i>
                </a>
            </li>
            <li>
                <a href="https://www.behance.com" class="social-icon">
                    <i class="fab fa-behance"></i>
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com" class="social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        </ul>
        <p>&copy; <span id="date"></span> FYP All rights reserved.</p>
    </footer>

    <script src="./js/popper.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>