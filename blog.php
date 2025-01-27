<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the Tutorials class
include_once __DIR__ . "/classes/Tutorials.php";

// Instantiate the Tutorials class
$tutorials = new Tutorials();

// Fetch all tutorials
$allBlogs = $tutorials->_selectAllTutorialsData();
$latestPosts = $tutorials->getLatestPosts(4)
?>
<!doctype html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./fontawesome/css/all.min.css" />

  <title>Blog - Darisset</title>
</head>

<body>
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
  <div class="">
    <div class="container">
      <div class="row">
        <div class="section-title mt-5">
          <h2>All Post</h2>
          <div class="underline"></div>
        </div>
        <div class="col-lg-8 mb-5">
          <!-- featured blogs -->
          <section class="section" id="featured">
            <!-- featured-center -->
            <div class="section-center featured-center">
              <div class="row justify-content-start">
                <?php
                if ($allBlogs) {
                  foreach ($allBlogs as $blog) {
                ?>
                    <div class="col-lg-6">
                      <!-- single blog -->
                      <article class="blog-card">
                        <div class="blog-img-container">
                          <a href="detail.php?id=<?php echo $blog->id; ?>">
                            <img src="<?php echo htmlspecialchars($blog->link ?? './img/default.jpg'); ?>" class="blog-img" alt="" />
                          </a>
                          <p class="blog-date"><?php echo htmlspecialchars(date('F jS, Y', strtotime($blog->created_at))); ?></p>
                        </div>
                        <!-- blog info -->
                        <div class="blog-info">
                          <div class="blog-title">
                            <a href="detail.php?id=<?php echo $blog->id; ?>">
                              <h4><?php echo htmlspecialchars($blog->title ?? 'Untitled Post'); ?></h4>
                            </a>
                            <a href="#">
                              <p><?php echo htmlspecialchars($blog->category ?? 'General'); ?></p>
                            </a>
                          </div>
                          <p>
                            <?php echo htmlspecialchars(substr($blog->detail, 0, 100)); ?>...
                          </p>
                          <!-- blog footer -->
                          <div class="blog-footer">
                            <a href="#">
                              <p>
                                <span><i class="fas fa-user"></i></span>
                                <?php echo htmlspecialchars($blog->author_name ?? 'Unknown Author'); ?>
                              </p>
                            </a>
                            <a href="detail.php?id=<?php echo $blog->id; ?>">
                              <p>Read More...</p>
                            </a>
                          </div>
                        </div>
                      </article>
                      <!-- end of single blog -->
                    </div>
                <?php
                  }
                } else {
                  echo '<p>No blogs available at the moment.</p>';
                }
                ?>
              </div>
            </div>
            <!-- end of blogs center -->
            <div class="blog-btn mt-5">
              <a href="all-blogs.php" class="btn">All Blogs</a>
            </div>
          </section>
          <!-- end of featured blogs -->
        </div>

        <div class="col-lg-4">
          <div class="sidebar-left">
            <form class="d-flex">
              <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" />
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
                    <div class="row mb-4">
                      <div class="col-4">
                        <img src="<?php echo htmlspecialchars($post->link ?? './img/default.jpg'); ?>" class="thumbnail" alt="..." />
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
                echo '<p>No recent posts available.</p>';
              }
              ?>
            </div>
          </article>

        </div>
      </div>
    </div>
  </div>
  <!-- end blog -->
  </section>
  <!-- end of newsletter -->

  <footer class="footer">
    <ul class="social-icons mt-5">
      <!-- single item -->
      <li class="pr-3">
        <a href="https://www.twitter.com" class="social-icon"><i class="fab fa-facebook"></i></a>
      </li>
      <!-- end of single item -->
      <!-- single item -->
      <li>
        <a href="https://www.twitter.com" class="social-icon"><i class="fab fa-linkedin"></i></a>
      </li>
      <!-- end of single item -->
      <!-- single item -->
      <li>
        <a href="https://www.twitter.com" class="social-icon"><i class="fab fa-squarespace"></i></a>
      </li>
      <!-- end of single item -->
      <!-- single item -->
      <li>
        <a href="https://www.twitter.com" class="social-icon"><i class="fab fa-behance"></i></a>
      </li>
      <!-- end of single item -->
      <!-- single item -->
      <li>
        <a href="https://www.twitter.com" class="social-icon"><i class="fab fa-instagram"></i></a>
      </li>
      <!-- end of single item -->
    </ul>

    <p>
      &copy; <span id="date"></span> FYP. All rights reserved.
    </p>
  </footer>

  <!-- Optional JavaScript -->
  <!-- Popper.js first, then Bootstrap JS -->
  <script src="./js/popper.min.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>