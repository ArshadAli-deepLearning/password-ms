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
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $msg = $passwords->addNewPassword($_POST);
}
?>

<div class="container mt-4">
  <div class="card">
    <div class="card-header">
      <h3>Add New Password</h3>
    </div>
    <div class="card-body">
      <?php if (!empty($msg)) { ?>
        <div class="alert alert-dismissible <?php echo (strpos($msg, 'Success') !== false) ? 'alert-success' : 'alert-danger'; ?>">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          <?php echo $msg; ?>
        </div>
      <?php } ?>
      <form method="post">
        <div class="form-group">
          <label for="password_for">Password For</label>
          <input type="text" class="form-control" name="password_for" required>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Generated Password</label>
          <div class="input-group">
            <input type="text" class="form-control" name="password" id="password" required>
            <div class="input-group-append">
              <button type="button" class="btn btn-secondary" id="generate">Generate</button>
              <button type="button" class="btn btn-primary" id="copy">Copy</button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="strength">Password Strength</label>
          <input type="range" class="custom-range" id="strength" name="strength" min="0" max="100" readonly>
          <small id="strengthText"></small>
        </div>
        <div class="form-group">
          <label for="expires_at">Expiration Date (30 days)</label>
        </div>
        <div class="form-group">
          <label for="login_url">Login URL</label>
          <input type="text" class="form-control" name="login_url" required>
        </div>
        <button type="submit" class="btn btn-success">Save Password</button>
      </form>
    </div>
  </div>
</div>

<script>
  document.getElementById("generate").addEventListener("click", function() {
    const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()";
    let password = "";
    for (let i = 0; i < 16; i++) {
      password += charset.charAt(Math.floor(Math.random() * charset.length));
    }
    document.getElementById("password").value = password;
    checkStrength(password);
  });

  document.getElementById("copy").addEventListener("click", function() {
    const passwordField = document.getElementById("password");
    passwordField.select();
    document.execCommand("copy");
    alert("Password copied to clipboard!");
  });

  document.getElementById("password").addEventListener("input", function() {
    checkStrength(this.value);
  });

  function checkStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength += 20;
    if (/[A-Z]/.test(password)) strength += 20;
    if (/[a-z]/.test(password)) strength += 20;
    if (/[0-9]/.test(password)) strength += 20;
    if (/[^a-zA-Z0-9]/.test(password)) strength += 20;

    document.getElementById("strength").value = strength;
    document.getElementById("strengthText").innerText = `Strength: ${strength}%`;
  }
</script>

<?php include $basepath . '/inc/footer.php'; ?>