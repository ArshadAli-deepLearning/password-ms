<?php
error_reporting(32767);
ini_set('display_errors', 1);

include 'inc/header copy.php';
include 'classes/Quiz.php';

Session::CheckSession();

$quiz = new Quiz();

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
  $deleteId = $_POST['delete_id'];
  $msg = $quiz->deleteQuizById($deleteId); // Call the delete method from Quiz.php
}

// Fetch all quizzes
$result = $quiz->selectAllQuizzes();
?>

<div class="flex-grow-1 p-3">
  <div class="card">
    <div class="card-header">
      <h3>
        <i class="fas fa-book mr-2"></i>Exam Management
        <span class="float-right">
          Welcome!
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
    <div class="card-body">
      <!-- Display the message inside the card -->
      <?php if (!empty($msg)) { ?>
        <div class="alert alert-dismissible <?php echo (strpos($msg, 'Success') !== false) ? 'alert-success' : 'alert-danger'; ?>">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo $msg; ?>
        </div>
      <?php } ?>

      <table id="examTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th class="text-center">SL</th>
            <th class="text-center">Exam Name</th>
            <th class="text-center">Description</th>
            <th class="text-center">No. of Questions</th>
            <th class="text-center">Exam Time</th>
            <th class="text-center">Submission Time</th>
            <th class="text-center">Subject</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result) {
            $i = 0;
            foreach ($result as $row) {
              $i++;
          ?>
              <tr class="text-center">
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($row->exname); ?></td>
                <td><?php echo htmlspecialchars($row->desp); ?></td>
                <td><?php echo $row->nq; ?></td>
                <td><?php echo $quiz->formatDate($row->extime); ?></td>
                <td><?php echo $quiz->formatDate($row->subt); ?></td>
                <td><?php echo htmlspecialchars($row->subject); ?></td>
                <td>
                  <!-- Action Buttons -->
                  <form action="addquiz.php" method="post" style="display: inline-block;">
                    <input type="hidden" name="edit_id" value="<?php echo $row->exid; ?>">
                    <input type="hidden" name="exname" value="<?php echo $row->exname; ?>">
                    <input type="hidden" name="desp" value="<?php echo $row->desp; ?>">
                    <input type="hidden" name="nq" value="<?php echo $row->nq; ?>">
                    <input type="hidden" name="extime" value="<?php echo $row->extime; ?>">
                    <input type="hidden" name="subt" value="<?php echo $row->subt; ?>">
                    <input type="hidden" name="subject" value="<?php echo $row->subject; ?>">
                    <button type="submit" class="btn btn-info btn-sm">Edit</button>
                  </form>
                  <form action="" method="post" style="display: inline-block;">
                    <input type="hidden" name="delete_id" value="<?php echo $row->exid; ?>">
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');">Delete</button>
                  </form>
                  <form action="addqp.php" method="post">
                    <input type="hidden" name="exid" value="<?php echo $row->exid; ?>">
                    <input type="hidden" name="nq" value="<?php echo $row->nq; ?>">
                    <button type="submit" class="btn btn-primary btn-sm" style="margin-top:10px;">Add Question</button>
                  </form>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr class="text-center">
              <td colspan="8">No exams available now!</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>