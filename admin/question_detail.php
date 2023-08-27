<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/question_class.php";

$question = new question();
if (isset($_GET['question_id'])) {
    $question_id = $_GET['question_id'];
    $question_detail = $question->get_question_by_id($question_id);
}
$questions = $question->show_question();
?>

<style>
    .container {
        width: 80%;
        margin: auto;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: blue;
    }

    .question-detail {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    }

    .question-detail th, .question-detail td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .question-detail th {
        background-color: #f4f4f4;
        font-weight: bold;
    }
    h3{
        color: #666666;
    }
</style>

<div class="container">
    <h1>Question Detail</h1><br>
    <table class="question-detail">
        <tr>
            <th>STT</th>
            <th>Username</th>
            <th>Email</th>
            <th>Selected Answer</th>
        </tr>
        <?php if ($question_detail && $questions) : ?>
            <?php $stt = 1; foreach ($questions as $question) : ?>
                <?php if ($question['question_id'] == $question_id) : ?>
                    <h3>Question: <?php echo $question['question']; ?></h3>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo $question_detail['username']; ?></td>
                        <td><?php echo $question_detail['email']; ?></td>
                        <td><?php echo $question_detail['selected_answer']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">No question found.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<?php
include "footer.php";
?>
