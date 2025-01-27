<?php
error_reporting(32767);
ini_set('display_errors', 1);

include 'inc/header copy.php';
Session::CheckSession();

$sId = Session::get('roleid');

if ($sId == '1') {

    // Initialize variables
    $message = '';
    $editId = '';
    $exname = '';
    $desp = '';
    $nq = '';
    $extime = '';
    $subt = '';
    $subject = '';

    include 'classes/Quiz.php';
    $quiz = new Quiz();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addExam'])) {
        $quizData = [
            'exname' => trim($_POST['exname']),
            'desp' => trim($_POST['desp']),
            'nq' => trim($_POST['nq']),
            'extime' => trim($_POST['extime']),
            'subt' => trim($_POST['subt']),
            'subject' => trim($_POST['subject']),
        ];

        if (!empty($_POST['edit_id'])) {
            // Update quiz
            $quizData['exid'] = $_POST['edit_id'];
            $message = $quiz->updateQuiz($quizData['exid'], $quizData);
        } else {
            // Add new quiz
            $message = $quiz->addNewQuiz($quizData);
        }
    }

    // Prefill data for edit
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
        $editId = $_POST['edit_id'];
        $exname = $_POST['exname'];
        $desp = $_POST['desp'];
        $nq = $_POST['nq'];
        $extime = $_POST['extime'];
        $subt = $_POST['subt'];
        $subject = $_POST['subject'];
    }
?>
    <div class="flex-grow-1 p-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo !empty($editId) ? 'Edit Quiz' : 'Add New Quiz'; ?></h3>
            </div>
            <div class="card-body">
                <div style="width:600px; margin:0px auto">

                    <!-- Display success or error message -->
                    <?php if (!empty($message)) { ?>
                        <div class="alert <?php echo (strpos($message, 'successfully') !== false) ? 'alert-success' : 'alert-danger'; ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>

                    <form action="" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($editId); ?>">
                        <div class="form-group pt-3">
                            <label for="exname">Exam Name</label>
                            <input type="text" name="exname" class="form-control" value="<?php echo htmlspecialchars($exname); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="desp">Description</label>
                            <input type="text" name="desp" class="form-control" value="<?php echo htmlspecialchars($desp); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nq">Number of Questions</label>
                            <input type="number" name="nq" class="form-control" value="<?php echo htmlspecialchars($nq); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="extime">Exam Time</label>
                            <input type="datetime-local" name="extime" class="form-control" value="<?php echo htmlspecialchars($extime); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="subt">Submission Time</label>
                            <input type="datetime-local" name="subt" class="form-control" value="<?php echo htmlspecialchars($subt); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" class="form-control" value="<?php echo htmlspecialchars($subject); ?>" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="addExam" class="btn btn-success">
                                <?php echo empty($editId) ? 'Add Exam' : 'Update Exam'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    header('Location:index.php');
}
?>

<?php include 'inc/footer.php'; ?>
