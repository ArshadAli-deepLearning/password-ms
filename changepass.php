<?php
include 'inc/header copy.php';
Session::CheckSession();
?>
<?php

if (isset($_GET['id'])) {
  $userid = (int)$_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
  $changePass = $users->changePasswordBysingelUserId($userid, $_POST);
  // Store the result in a session for feedback
  Session::set('msg', $changePass);
}

// Retrieve the message from the session
$msg = Session::get('msg');
Session::set('msg', null); // Clear the message after retrieval
?>

<div class="d-flex">
  <!-- Main Content -->
  <div class="flex-grow-1 p-3">
    <div class="card ">
      <div class="card-header">
        <h3>Change your password
          <span class="float-right">
            <a href="profile.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary">Back</a>
          </span>
        </h3>
      </div>
      <div class="card-body">
        <div style="width:600px; margin:0px auto">
          <form class="" action="" method="POST">
            <!-- Display message inside the form -->
            <?php if (!empty($msg)) { ?>
              <div class="alert alert-dismissible <?php echo (strpos($msg, 'Success') !== false) ? 'alert-success' : 'alert-danger'; ?>">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $msg; ?>
              </div>
            <?php } ?>

            <div class="form-group">
              <label for="old_password">Old Password</label>
              <input type="password" name="old_password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input type="password" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
              <button type="submit" name="changepass" class="btn btn-success">Change password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>
