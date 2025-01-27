<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required classes
include_once __DIR__ . "/classes/Tutorials.php";

// Instantiate the Tutorials class
$tutorials = new Tutorials();

// Get the blog ID from the query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $blogId = (int)$_GET['id'];

    // Fetch the blog details by ID
    $blogDetails = $tutorials->_getTutorialById($blogId);
    $latestPosts = $tutorials->getLatestPosts(4); // Fetches the latest 4 tutorials

    if (!$blogDetails) {
        // If no blog is found, redirect or show an error
        die('Blog post not found.');
    }
} else {
    die('Invalid blog ID.');
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">

    <title>Detail - Darisset</title>
</head>

<body>
    <!-- navbar -->
    <nav class="nav" id="nav">
        <div class="nav-center">
            <!-- nav header -->
            <div class="nav-header">
                <h5 style="color:blue;">Password Management System</h5>
                <button class="nav-btn" id="nav-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <!-- nav links -->
            <ul class="nav-links">
                <li><a href="index.php">home</a></li>
                <li><a href="blog.php">Blog</a></li>
                <div class="dropdown">
                    <a class=" dropdown-toggle" href="#" role="button" id="UserDropdown" data-toggle="dropdown"
                        aria-expanded="false">
                        User
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="UserDropdown">
                        <li><a class="dropdown-item" href="user.html">User</a></li>
                        <li><a class="dropdown-item" href="login.php">login</a></li>
                        <li><a class="dropdown-item" href="register.php">regster</a></li>
                    </ul>
                </div>
            </ul>
        </div>
    </nav>
    <!-- sidebar -->
    <aside class="sidebar" id="sidebar">
        <div>
            <button id="close-btn" class="close-btn">
                <i class="fas fa-times"></i>
            </button>
            <ul class="sidebar-links">
                <li><a href="index.php">home</a></li>
                <li><a href="blog.php">Blog</a></li>
                <div class="dropdown">
                    <a class=" dropdown-toggle" href="#" role="button" id="UserDropdown" data-toggle="dropdown"
                        aria-expanded="false">
                        User
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="UserDropdown">
                        <li><a class="dropdown-item" href="user.html">User</a></li>
                        <li><a class="dropdown-item" href="login.php">login</a></li>
                        <li><a class="dropdown-item" href="register.php">regster</a></li>
                    </ul>
                </div>
            </ul>
        </div>
    </aside>
    <!-- end of sidebar -->
    <!-- Blog -->
    <div class="mt-5">
        <div class="container ">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <!-- featured Details -->
                    <section class="section" id="featured">
                        <div class="detail">
                            <!-- Image Section -->
                            <img src="<?php echo htmlspecialchars($blogDetails->link ?? './img/slide2.jpg'); ?>" class="img-fluid" alt="...">

                            <!-- Category Section -->
                            <div class="post-cat mt-5">
                                <div class="meta mt-3">
                                    <a class="profile" href="#"><i class="fas fa-user ml-2"></i>
                                        <span><?php echo htmlspecialchars($blogDetails->author_name ?? 'Darisset'); ?></span>
                                    </a> -
                                    <span><?php echo htmlspecialchars($blogDetails->created_at ?? 'San, 12 Mei 2020'); ?></span>
                                </div>
                            </div>

                            <!-- Article Content -->
                            <div class="article mt-3">
                                <h1><?php echo htmlspecialchars($blogDetails->title ?? 'No Title Available?'); ?></h1>
                                <p class="mt-3"><?php echo nl2br(htmlspecialchars($blogDetails->detail ?? 'No Details Available')); ?></p>
                                <!-- Tags Section -->
                                <figcaption class="blockquote-footer mt-5">
                                    <span>#Tags: </span>
                                    <cite title="Source Title"><?php echo htmlspecialchars($blogDetails->tags ?? 'Python, Django, Web Development'); ?></cite>
                                </figcaption>
                            </div>
                        </div>
                    </section>
                    <!-- end of featured Detail -->
                </div>

                <div class="col-lg-4">

                    <div class="sidebar-left">
                        <form class="d-flex">
                            <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                    <article class="sidebar-left">
                        <h4 class="text-center">Latest Posts</h4>
                        <div class="underline"></div>
                        <div class="pl-3 pr-3">
                            <?php
                            if ($latestPosts) {
                                foreach ($latestPosts as $post) {
                            ?>
                                    <a href="detail.php?id=<?php echo $post->id; ?>" aria-current="true">
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <img src="<?php echo htmlspecialchars($post->link ?? './img/default.jpg'); ?>" class="thumbnail" alt="...">
                                            </div>
                                            <div class="col-8 recent-post">
                                                <h5><?php echo htmlspecialchars($post->title ?? 'Untitled Post'); ?></h5>
                                                <span><?php echo htmlspecialchars(date('M d, Y', strtotime($post->created_at ?? 'now'))); ?></span>
                                            </div>
                                        </div>
                                    </a>
                            <?php
                                }
                            } else {
                                echo '<p>No posts available.</p>';
                            }
                            ?>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </div>
    <!-- end blog -->
    <footer class="footer">
        <ul class="social-icons mt-5">
            <!-- single item -->
            <li class="pr-3">
                <a href="https://www.twitter.com" class="social-icon">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <!-- end of single item -->
            <!-- single item -->
            <li>
                <a href="https://www.twitter.com" class="social-icon">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
            <!-- end of single item -->
            <!-- single item -->
            <li>
                <a href="https://www.twitter.com" class="social-icon">
                    <i class="fab fa-squarespace"></i>
                </a>
            </li>
            <!-- end of single item -->
            <!-- single item -->
            <li>
                <a href="https://www.twitter.com" class="social-icon">
                    <i class="fab fa-behance"></i>
                </a>
            </li>
            <!-- end of single item -->
            <!-- single item -->
            <li>
                <a href="https://www.twitter.com" class="social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            <!-- end of single item -->
        </ul>

        <p>&copy; <span id="date"></span> FYP All rights reserved.</p>
    </footer>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="./js/popper.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>