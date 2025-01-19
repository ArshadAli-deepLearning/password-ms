<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');
include_once $basepath . "/inc/header.php";

spl_autoload_register(function ($classes) use ($basepath) {
  include $basepath . "/classes/" . $classes . ".php";
});

$tutorials = new Tutorials();
Session::CheckSession();
$sId = Session::get('roleid');

if ($sId == '1') {
  $tutorial = null;
  if (isset($_GET['id'])) {
    $tutorialId = (int) $_GET['id'];
    $tutorial = $tutorials->getTutorialById($tutorialId);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateTutorial'])) {
      $tutorialUpdate = $tutorials->updateTutorialByAdmin($tutorialId, $_POST);
    } elseif (isset($_POST['addTutorial'])) {
      $tutorialAdd = $tutorials->addNewTutorialByAdmin($_POST);
    }
  }
  
  if (isset($tutorialUpdate)) {
    echo $tutorialUpdate;
  }
  if (isset($tutorialAdd)) {
    echo $tutorialAdd;
  }
?>
  <div class="card">
    <div class="card-header">
      <h3 class='text-center'><?php echo $tutorial ? 'Edit' : 'Add New'; ?> Tutorial</h3>
    </div>
    <div class="cad-body">
      <div style="width:600px; margin:0px auto">
        <form action="" method="post">
          <input type="hidden" name="tutorialId" value="<?php echo $tutorial ? $tutorial->id : '';?>" />
          <div class="form-group pt-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo $tutorial ? htmlspecialchars($tutorial->title) : ''; ?>">
          </div>
          <div class="form-group">
            <label for="link">Link</label>
            <input type="text" name="link" class="form-control" value="<?php echo $tutorial ? htmlspecialchars($tutorial->link) : ''; ?>">
          </div>
          <div class="form-group">
            <label for="detail">Detail</label>
            <textarea name="detail" class="form-control" rows="10"><?php echo $tutorial ? htmlspecialchars($tutorial->detail) : ''; ?></textarea>
          </div>
          <div class="form-group">
            <?php if ($tutorial) { ?>
              <button type="submit" name="updateTutorial" class="btn btn-primary">Update</button>
            <?php } else { ?>
              <button type="submit" name="addTutorial" class="btn btn-success">Save</button>
            <?php } ?>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
} else {
  header('Location:/password-ms/tutorials/index.php');
}
include $basepath . '/inc/footer.php';
?>
