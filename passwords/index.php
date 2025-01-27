<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');

include_once $basepath . "/inc/header copy.php";

Session::CheckSession();

$msg = Session::get('msg');
Session::set("msg", null); // Clear the message after retrieval

spl_autoload_register(function ($classes) use ($basepath) {
  include $basepath . "/classes/" . $classes . ".php";
});

$passwords = new Passwords();

// Remove tutorial logic
if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removePassword = $passwords->deletePasswordById($remove);

  if (isset($removePassword)) {
    Session::set('msg', $removePassword);
    echo "<script>location.href='index.php';</script>";
  }
}
?>

<div class="flex-grow-1 p-3">
  <div class="card">
    <div class="card-header">
      <h3>
        <i class="fas fa-folder mr-2"></i>Passwords list
        <span class="float-right">Welcome!
          <strong>
            <span class="badge badge-lg badge-secondary text-white">
              <?php
              $username = Session::get('username');
              if (isset($username)) {
                echo $username;
              }
              ?>
            </span>
          </strong>
        </span>
      </h3>
    </div>
    <div class="card-body pr-2 pl-2">

      <!-- Display message inside the card -->
      <?php if (!empty($msg)) { ?>
        <div class="alert alert-dismissible <?php echo (strpos($msg, 'Success') !== false) ? 'alert-success' : 'alert-danger'; ?>">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo $msg; ?>
        </div>
      <?php } ?>

      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th class="text-center">SL</th>
            <th class="text-center">Strength</th>
            <th class="text-center">Password For</th>
            <th class="text-center">Username</th>
            <th class="text-center">Password</th>
            <th class="text-center">Expires In</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allPasswords = $passwords->selectAllPasswords();
          if ($allPasswords) {
            $i = 0;
            foreach ($allPasswords as $value) {
              $i++;

              // Calculate Remaining Time Until Expiration
              $expirationTime = strtotime($value->expires_at); // Convert to timestamp
              $currentTime = time();
              $remainingSeconds = $expirationTime - $currentTime;

              if ($remainingSeconds > 0) {
                $days = floor($remainingSeconds / 86400);
                $hours = floor(($remainingSeconds % 86400) / 3600);
                $expiresIn = "{$days}d {$hours}h";
                $status = "<span class='badge badge-success'>Active</span>";
              } else {
                $expiresIn = "<span class='badge badge-danger'>Expired</span>";
                $status = "<span class='badge badge-danger'>Expired</span>";
              }

              // Masked Password Display
              $maskedPassword = substr($value->password, 0, 3) . "****" . substr($value->password, -3);
          ?>
              <tr class="text-center">
                <td><?php echo $i; ?></td>
                <td>
                  <div class="progress" style="height: 20px;">
                    <?php
                    $strength = intval($value->strength);
                    if ($strength < 40) {
                      $colorClass = "bg-danger"; // Weak (Red)
                    } elseif ($strength < 70) {
                      $colorClass = "bg-warning"; // Medium (Yellow)
                    } else {
                      $colorClass = "bg-success"; // Strong (Green)
                    }
                    ?>
                    <div class="progress-bar <?php echo $colorClass; ?>" role="progressbar"
                      style="width: <?php echo $strength; ?>%;"
                      aria-valuenow="<?php echo $strength; ?>"
                      aria-valuemin="0"
                      aria-valuemax="100">
                      <?php echo $strength; ?>%
                    </div>
                  </div>
                </td>
                <td>
                  <a href="<?php echo htmlspecialchars($value->login_url); ?>" target="_blank">
                    <?php echo htmlspecialchars($value->password_for); ?>
                    <i class="fas fa-external-link-alt ml-2"></i>
                  </a>
                </td>
                <td><?php echo htmlspecialchars($value->username); ?></td>
                <td>
                  <span id="masked-password-<?php echo $i; ?>">
                    <?php echo htmlspecialchars($maskedPassword); ?>
                  </span>
                </td>
                <td><?php echo $expiresIn; ?></td>
                <td><?php echo $status; ?></td>
                <td>
                  <button class="btn btn-success btn-sm view-password" data-id="<?php echo $value->id; ?>" data-index="<?php echo $i; ?>">
                    View
                  </button>
                  <a onclick="return confirm('Are you sure you want to delete <?php echo $value->password_for; ?>?')" class="btn btn-danger btn-sm" href="?remove=<?php echo $value->id; ?>">Remove</a>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr class="text-center">
              <td colspan="8">No passwords available now!</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<!-- Modal for Secure Password Viewing -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Verify Password</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="password-form">
          <input type="hidden" id="password-id" value="">
          <input type="hidden" id="password-index" value="">
          <label>Enter your password to continue:</label>
          <input type="password" class="form-control" id="user-password" required>
          <button type="submit" class="btn btn-primary mt-3">Verify</button>
        </form>
        <div id="password-result" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>

<?php
include $basepath . '/inc/footer.php';
?>

<!-- Your custom scripts -->
<script>
  $(document).ready(function() {
    $("#yourModalId").modal("show"); // Test if modal works
  });
</script>

<script>
  $(document).ready(function() {
    $(".view-password").click(function() {
      var id = $(this).data("id");
      var index = $(this).data("index");
      $("#password-id").val(id);
      $("#password-index").val(index);
      $("#passwordModal").modal("show");
    });

    $("#password-form").submit(function(event) {
      event.preventDefault();
      var password = $("#user-password").val();
      var id = $("#password-id").val();
      var index = $("#password-index").val();

      $.post("verify_password.php", {
        password_id: id,
        password: password
      }, function(response) {
        if (response.success) {
          $("#masked-password-" + index).text(response.password);
          $("#passwordModal").modal("hide");
        } else {
          $("#password-result").html("<span class='text-danger'>Invalid password!</span>");
        }
      }, "json");
    });
  });
</script>