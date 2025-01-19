<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');

include_once $basepath . "/inc/header.php";

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);

spl_autoload_register(function ($classes) use ($basepath) {
  include $basepath . "/classes/" . $classes . ".php";
});

$tutorials = new Tutorials();
?>
<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeTutorial = $tutorials->deleteTutorialById($remove);
}

if (isset($removeTutorial)) {
  echo $removeTutorial;
}

?>
<div class="card ">
  <div class="card-header">
    <h3><i class="fas fa-folder mr-2"></i>Tutorial list <span class="float-right">Welcome! <strong>
          <span class="badge badge-lg badge-secondary text-white">
            <?php
            $username = Session::get('username');
            if (isset($username)) {
              echo $username;
            }
            ?></span>

        </strong></span></h3>
  </div>
  <div class="card-body pr-2 pl-2">

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
          foreach ($allTutorials as  $value) {
            $i++;
        ?>

            <tr class="text-center"
              <?php if (Session::get("id") == $value->id) {
                echo "style='background:#d9edf7' ";
              } ?>>

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
                  <a class="btn btn-success btn-sm
                            " href="view.php?id=<?php echo $value->id; ?>">View</a>
                  <a class="btn btn-info btn-sm " href="add.php?id=<?php echo $value->id; ?>">Edit</a>
                  <a onclick="return confirm('Are you sure To Delete <?php echo $value->title; ?>?')" class="btn btn-danger
                    <?php if (Session::get("id") == $value->id) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove=<?php echo $value->id; ?>">Remove</a>
                <?php  } elseif (Session::get("id") == $value->id  && Session::get("roleid") == '2') { ?>
                  <a class="btn btn-success btn-sm " href="view.php?id=<?php echo $value->id; ?>">View</a>
                  <a class="btn btn-info btn-sm " href="add.php?id=<?php echo $value->id; ?>">Edit</a>
                <?php  } elseif (Session::get("roleid") == '2') { ?>
                  <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="view.php?id=<?php echo $value->id; ?>">View</a>
                  <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="add.php?id=<?php echo $value->id; ?>">Edit</a>
                <?php } elseif (Session::get("id") == $value->id  && Session::get("roleid") == '3') { ?>
                  <a class="btn btn-success btn-sm " href="view.php?id=<?php echo $value->id; ?>">View</a>
                  <a class="btn btn-info btn-sm " href="add.php?id=<?php echo $value->id; ?>">Edit</a>
                <?php } else { ?>
                  <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="view.php?id=<?php echo $value->id; ?>">View</a>

                <?php } ?>

              </td>
            </tr>
          <?php }
        } else { ?>
          <tr class="text-center">
            <td>No tutorial availabe now !</td>
          </tr>
        <?php } ?>

      </tbody>

    </table>
  </div>
</div>

<?php
include $basepath . '/inc/footer.php';
?>