<?php
ini_set('display_errors', 1);

include 'inc/header copy.php';
Session::CheckSession();

$sId = Session::get('roleid');

if ($sId != '1') {
    // Redirect if the user doesn't have admin privileges
    header("Location: index.php");
    exit();
}

include 'classes/Quiz.php';
$quiz = new Quiz();

// Get `exid` and `nq` from POST
$exid = $_POST['exid'] ?? null;
$nq = $_POST['nq'] ?? 0;

// Check if the required data is missing
if (!$exid || $nq <= 0) {
    echo '<script>alert("Exam ID or number of questions is missing."); window.location.href="interactive_quiz.php";</script>';
    exit();
}

// Fetch existing questions for the given exam
$existingQuestions = $quiz->getQuestionsByExamId($exid);
$indexedQuestions = [];
if ($existingQuestions) {
    foreach ($existingQuestions as $question) {
        $indexedQuestions[$question->sno] = $question;
    }
}
?>
<div class="flex-grow-1 p-3">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Edit Questions for Exam ID: <?php echo htmlspecialchars($exid); ?></h3>
        </div>
        <div class="card-body">
            <form action="save_questions.php" method="post">
                <input type="hidden" name="nq" value="<?php echo htmlspecialchars($nq); ?>">
                <input type="hidden" name="exid" value="<?php echo htmlspecialchars($exid); ?>">

                <?php
                for ($i = 1; $i <= $nq; $i++) {
                    $qData = $indexedQuestions[$i] ?? null;
                    echo '
                    <label for="q' . $i . '"><b>Question Number ' . $i . '</b></label><br><br>
                    <label for="q' . $i . '">Enter the Question:</label><br>
                    <input class="form-control mb-3" type="text" id="q' . $i . '" name="q' . $i . '" 
                           value="' . ($qData ? htmlspecialchars($qData->qstn) : '') . '" 
                           placeholder="Enter the question here" maxlength="200" required />
                    <label for="o1' . $i . '">Option A:</label><br>
                    <input class="form-control mb-3" type="text" id="o1' . $i . '" name="o1' . $i . '" 
                           value="' . ($qData ? htmlspecialchars($qData->qstn_o1) : '') . '" 
                           placeholder="Enter option A" maxlength="100" required />
                    <label for="o2' . $i . '">Option B:</label><br>
                    <input class="form-control mb-3" type="text" id="o2' . $i . '" name="o2' . $i . '" 
                           value="' . ($qData ? htmlspecialchars($qData->qstn_o2) : '') . '" 
                           placeholder="Enter option B" maxlength="100" required />
                    <label for="o3' . $i . '">Option C:</label><br>
                    <input class="form-control mb-3" type="text" id="o3' . $i . '" name="o3' . $i . '" 
                           value="' . ($qData ? htmlspecialchars($qData->qstn_o3) : '') . '" 
                           placeholder="Enter option C" maxlength="100" required />
                    <label for="o4' . $i . '">Option D:</label><br>
                    <input class="form-control mb-3" type="text" id="o4' . $i . '" name="o4' . $i . '" 
                           value="' . ($qData ? htmlspecialchars($qData->qstn_o4) : '') . '" 
                           placeholder="Enter option D" maxlength="100" required />
                    <label for="a' . $i . '">Correct Option:</label><br>
                    <input class="form-control mb-3" type="text" id="a' . $i . '" name="a' . $i . '" 
                           value="' . ($qData ? htmlspecialchars($qData->qstn_ans) : '') . '" 
                           placeholder="Enter the correct answer here" maxlength="100" required />
                    <hr>';
                }
                ?>
                <button type="submit" name="save_questions" class="btn btn-success mt-3">Save Questions</button>
            </form>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
