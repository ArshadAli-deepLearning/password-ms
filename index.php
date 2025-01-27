<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the Tutorials class
include_once __DIR__ . "/classes/Tutorials.php";

// Instantiate the Tutorials class
$tutorials = new Tutorials();

// Fetch all tutorials
$allTutorials = $tutorials->_selectAllTutorialsData();
$latestPosts = $tutorials->getLatestPosts(4)
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

    <title>Home - Darisset</title>
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

    <!-- Banner -->
    <div class="banner">
        <div class="container">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <section>
                            <div class="section-center clearfix">
                                <!-- banner-img -->
                                <article class="banner-img">
                                    <div class="banner-picture-container">
                                        <img src="./img/slide1.jpg" alt="tea kettle" class="banner-picture" />
                                    </div>
                                </article>
                                <!-- banner-info -->
                                <article class="banner-info">
                                    <!-- section title -->
                                    <div class="">
                                        <h3>Banner our ?</h3>
                                        <h2>My Journal</h2>
                                    </div>
                                    <!-- end of section title -->
                                    <p class="banner-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi
                                        repellendus reprehenderit iure, vero nobis dolore!
                                    </p>
                                    <p class="banner-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi
                                        repellendus reprehenderit iure, vero nobis dolore!
                                    </p>
                                    <a href="detail.html" class="btn">learn more</a>
                                </article>
                            </div>
                        </section>
                    </div>
                    <div class="carousel-item">
                        <section>
                            <div class="section-center clearfix">
                                <!-- banner-img -->
                                <article class="banner-img">
                                    <div class="banner-picture-container">
                                        <img src="./img/slide2.jpg" alt="tea kettle" class="banner-picture" />
                                    </div>
                                </article>
                                <!-- banner-info -->
                                <article class="banner-info">
                                    <!-- section title -->
                                    <div class="">
                                        <h3>Haw learn python?</h3>
                                        <h2>Pyhton Beginners</h2>
                                    </div>
                                    <!-- end of section title -->
                                    <p class="banner-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi
                                        repellendus reprehenderit iure, vero nobis dolore!
                                    </p>
                                    <p class="banner-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi
                                        repellendus reprehenderit iure, vero nobis dolore!
                                    </p>
                                    <a href="detail.html" class="btn">learn more</a>
                                </article>
                            </div>
                        </section>
                    </div>
                    <div class="carousel-item">
                        <section>
                            <div class="section-center clearfix">
                                <!-- banner-img -->
                                <article class="banner-img">
                                    <div class="banner-picture-container">
                                        <img src="./img/slide3.jpg" alt="tea kettle" class="banner-picture" />
                                    </div>
                                </article>
                                <!-- banner-info -->
                                <article class="banner-info">
                                    <!-- section title -->
                                    <div class="">
                                        <h3>What happened..?</h3>
                                        <h2>Django </h2>
                                    </div>
                                    <!-- end of section title -->
                                    <p class="banner-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi
                                        repellendus reprehenderit iure, vero nobis dolore!
                                    </p>
                                    <p class="banner-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi
                                        repellendus reprehenderit iure, vero nobis dolore!
                                    </p>
                                    <a href="detail.html" class="btn">learn more</a>
                                </article>
                            </div>
                        </section>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <!-- end banner -->

    <!-- popular post -->
    <div class="popular-post">
        <div class="container">
            <!-- popular post -->
            <section class="section projects">
                <!-- section title -->
                <div class="section-title">
                    <h2>Latest Tutorials Posts</h2>
                    <div class="underline"></div>
                </div>
                <!-- end of section title -->
                <div class="section-center projects-center">
                    <?php
                    if ($latestPosts) {
                        foreach ($latestPosts as $index => $post) {
                    ?>
                            <!-- single post -->
                            <a href="detail.php?id=<?php echo $post->id; ?>" class="project-<?php echo $index + 1; ?>">
                                <article class="project">
                                    <img src="<?php echo htmlspecialchars($post->link ?? './img/default.jpg'); ?>" alt="" class="project-img" />
                                    <div class="project-info">
                                        <h4><?php echo htmlspecialchars($post->title ?? 'Untitled Post'); ?></h4>
                                        <p><?php echo htmlspecialchars($post->category ?? 'General'); ?></p>
                                    </div>
                                </article>
                            </a>
                            <!-- end of single post -->
                    <?php
                        }
                    } else {
                        echo '<p>No posts available.</p>';
                    }
                    ?>
                </div>
            </section>
            <!-- endo of projects -->
        </div>
    </div>
    <!-- popular post -->
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="section-title mt-5">
                    <h2>All Tutorials Post</h2>
                    <div class="underline"></div>
                </div>
                <div class="mb-5">
                    <!-- featured blogs -->
                    <section class="section" id="featured">
                        <div class="section-center featured-center">
                            <div class="row justify-content-start">
                                <?php
                                if ($allTutorials) {
                                    foreach ($allTutorials as $value) {
                                ?>
                                        <div class="col-lg-6">
                                            <!-- single blog -->
                                            <article class="blog-card">
                                                <div class="blog-img-container">
                                                    <a href="detail.php?id=<?php echo $value->id; ?>">
                                                        <img src="<?php echo htmlspecialchars($value->link ?? 'default-image.jpg'); ?>" class="blog-img" alt="Blog Image">
                                                    </a>
                                                    <p class="blog-date"><?php echo $tutorials->formatDate($value->created_at); ?></p>
                                                </div>
                                                <div class="blog-info">
                                                    <div class="blog-title">
                                                        <a href="detail.php?id=<?php echo $value->id; ?>">
                                                            <h4><?php echo htmlspecialchars($value->title ?? 'Untitled Post'); ?></h4>
                                                        </a>
                                                    </div>
                                                    <p>
                                                        <?php echo htmlspecialchars(substr($value->detail ?? 'No details available.', 0, 150)); ?>...
                                                    </p>
                                                    <div class="blog-footer">
                                                        <p>
                                                            <span><i class="fas fa-user"></i></span>
                                                            <?php echo htmlspecialchars($value->author_name ?? 'Unknown Author'); ?>
                                                        </p>
                                                        <a href="detail.php?id=<?php echo $value->id; ?>">
                                                            <p>Read More...</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo '<p>No blog posts available at the moment.</p>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="blog-btn mt-5">
                            <a href="blog.php" class="btn">All Posts</a>
                        </div>
                    </section>
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

        <p>&copy; <span id="date"></span> FYP. All rights reserved.</p>
    </footer>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="./js/popper.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>