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

$tutorials = new Tutorials();

// Remove tutorial logic
if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeTutorial = $tutorials->deleteTutorialById($remove);

  if (isset($removeTutorial)) {
    Session::set('msg', $removeTutorial); // Store message in session
    echo "<script>location.href='index.php';</script>"; // Redirect to refresh and show message
  }
}
?>

<div class="flex-grow-1 p-3">
  <div class="card">
    <div class="card-header">
      <h3>
        <i class="fas fa-folder mr-2"></i>Tutorial list 
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
            <th class="text-center">Title</th>
            <th class="text-center">Detail</th>
            <th class="text-center">Link</th>
            <th class="text-center">Created</th>
            <th width='25%' class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allTutorials = $tutorials->selectAllTutorialsData();
          if ($allTutorials) {
            $i = 0;
            foreach ($allTutorials as $value) {
              $i++;
          ?>
              <tr class="text-center" <?php if (Session::get("id") == $value->id) echo "style='background:#d9edf7'"; ?>>
                <td><?php echo $i; ?></td>
                <td><?php echo $value->title; ?></td>
                <td><?php echo substr($value->detail, 0, 300); ?> ...</td>
                <td><?php echo $value->link; ?></td>
                <td>
                  <span class="badge badge-lg badge-secondary text-white">
                    <?php echo $tutorials->formatDate($value->created_at); ?>
                  </span>
                </td>
                <td>
                  <?php if (Session::get("roleid") == '1') { ?>
                    <a class="btn btn-success btn-sm" href="view.php?id=<?php echo $value->id; ?>">View</a>
                    <a class="btn btn-info btn-sm" href="add.php?id=<?php echo $value->id; ?>">Edit</a>
                    <a onclick="return confirm('Are you sure To Delete <?php echo $value->title; ?>?')" class="btn btn-danger btn-sm" href="?remove=<?php echo $value->id; ?>">Remove</a>
                  <?php } else { ?>
                    <a class="btn btn-success btn-sm" href="view.php?id=<?php echo $value->id; ?>">View</a>
                  <?php } ?>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr class="text-center">
              <td colspan="6">No tutorial available now!</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
include $basepath . '/inc/footer.php';
?>
