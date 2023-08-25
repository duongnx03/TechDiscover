<?php
    include 'database.php';

class question {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }

    public function insert_question($id, $question, $answer1, $answer2, $answer3) {
        $query = "INSERT INTO questions(id, question, answer1, answer2, answer3) 
                  VALUES ('$id', '$question', '$answer1', '$answer2', '$answer3')";

        $result = $this->db->insert($query);
        return $result;
    }
    public function show_question(){
        $query = "SELECT * FROM questions ORDER BY id ASC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_question($id) {
        $query = "DELETE FROM questions WHERE id = '$id'";
        $result = $this->db->delete($query);
        header('Location: question.php');
        return $result;
    }
    public function save_survey_response($question_id, $selected_answer) {
        $query = "INSERT INTO survey_responses (question_id, selected_answer) VALUES ('$question_id', '$selected_answer')";
        $result = $this->db->insert($query);
    
        if ($result) {
            $updateColumn = "quantity_" . $selected_answer;
            $updateQuery = "UPDATE questions SET $updateColumn = $updateColumn + 1 WHERE id = $question_id";
            $this->db->update($query);
        }
    
        return $result;
    }
    
}
?>