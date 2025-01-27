<?php
include 'inc/header copy.php';
Session::CheckSession();

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  // Update the user and set the result in the session message
  $updateUser = $users->updateUserByIdInfo($userid, $_POST);
  Session::set('msg', $updateUser); // Store the result (success or error message) in the session
}

// Retrieve the message from the session
$msg = Session::get('msg');
Session::set('msg', null); // Clear the message after retrieval
?>

<div class="d-flex">
  <!-- Main Content -->
  <div class="flex-grow-1 p-3">
    <div class="card">
      <div class="card-header">
        <h3>User Profile 
          <span class="float-right">
            <a href="index.php" class="btn btn-primary">Back</a>
          </span>
        </h3>
      </div>
      <div class="card-body">

        <?php
        $getUinfo = $users->getUserInfoById($userid);
        if ($getUinfo) {
        ?>
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
                <label for="name">Your name</label>
                <input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="username">Your username</label>
                <input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo $getUinfo->mobile; ?>" class="form-control">
              </div>

              <?php if (Session::get("roleid") == '1') { ?>
                <div class="form-group <?php if (Session::get("roleid") == '1' && Session::get("id") == $getUinfo->id) echo "d-none"; ?>">
                  <label for="roleid">Select user Role</label>
                  <select class="form-control" name="roleid" id="roleid">
                    <option value="1" <?php echo ($getUinfo->roleid == '1') ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?php echo ($getUinfo->roleid == '2') ? 'selected' : ''; ?>>Editor</option>
                    <option value="3" <?php echo ($getUinfo->roleid == '3') ? 'selected' : ''; ?>>User only</option>
                  </select>
                </div>
              <?php } else { ?>
                <input type="hidden" name="roleid" value="<?php echo $getUinfo->roleid; ?>">
              <?php } ?>

              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Update</button>
                <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id; ?>">Password change</a>
              </div>

            </form>
          </div>

        <?php } else {
          header('Location:index.php');
        } ?>

      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>
