<?php
error_reporting(32767);
ini_set('display_errors', 1);

include 'inc/header copy.php';
Session::CheckSession();

$sId =  Session::get('roleid');

if ($sId == '1') {

  // Initialize the message variable
  $message = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
    $userAdd = $users->addNewUserByAdmin($_POST);

    // Display success or error message
    if (isset($userAdd)) {
      $message = $userAdd;
    }
  }
?>

<div class="d-flex">
  <!-- Main Content -->
  <div class="flex-grow-1 p-3">
    <div class="card">
      <div class="card-header">
        <h3 class='text-center'>Add New User</h3>
      </div>
      <div class="card-body">
        <div style="width:600px; margin:0px auto">

          <!-- Display message -->
          <?php if (!empty($message)) { ?>
            <div class="alert alert-success">
              <?php echo $message; ?>
            </div>
          <?php } ?>

          <form action="" method="post">
            <div class="form-group pt-3">
              <label for="name">Your name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="username">Your username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="mobile">Mobile Number</label>
              <input type="text" name="mobile" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="roleid">Select user Role</label>
              <select class="form-control" name="roleid" id="roleid" required>
                <option value="1">Admin</option>
                <option value="2">Editor</option>
                <option value="3">User only</option>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" name="addUser" class="btn btn-success">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
} else {
  header('Location:index.php');
}
?>

<?php
include 'inc/footer.php';
?>
