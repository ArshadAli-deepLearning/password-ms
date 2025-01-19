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
$sId =  Session::get('roleid');

if ($sId == '1') {

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addTutorial'])) {
    $tutorialAdd = $tutorials->addNewTutorialByAdmin($_POST);
  }

  if (isset($tutorialAdd)) {
    echo $tutorialAdd;
  }
?>

  <div class="card ">
    <div class="card-header">
      <h3 class='text-center'>Add New Tutorial</h3>
    </div>
    <div class="cad-body">
      <div style="width:600px; margin:0px auto">
        <form class="" action="" method="post">
          <div class="form-group pt-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control">
          </div>
          <div class="form-group">
            <label for="link">Link</label>
            <input type="text" name="link" class="form-control">
          </div>
          <div class="form-group">
            <label for="detail">Detail</label>
            <textarea type="text" name="detail" class="form-control" rows="10"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" name="addTutorial" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
} else {
  header('Location:/password-ms/tutorials/index.php');
}
?>

<?php
include $basepath . '/inc/footer.php';
?>