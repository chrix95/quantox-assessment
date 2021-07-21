<?php
namespace Src\Classes;

class Student {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        $statement = "SELECT student_id, name, board FROM students WHERE student_id = ?";

        try {
            $statement = $this->db->prepare($statement);
            $statement->bindValue(1, $id);
            $statement->execute();
            $response = $statement->fetch(\PDO::FETCH_ASSOC);

            // get the user grades
            $stm = $this->db->prepare("SELECT grade FROM grades WHERE user_id = ?");
            $stm->bindValue(1, $id);
            $stm->execute();
            $response['grades'] = $stm->fetchAll(\PDO::FETCH_ASSOC);
            $resuult = $this->checkResultStatus($response['board'], $response['grades']);
            // set the average and result status to the response
            $response['average'] = $resuult['avg'];
            $response['final_result'] = $resuult['final_result'];
            return $response;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    private function checkResultStatus ($board, $grades) {
        $result = [];
        if (strtolower($board) === "csm") {
            $result = $this->rateCsmStudent($grades);
        } else {
            $count = count($grades);
            $result['average'] = $this->calculateAvg($grades);
            if ($count > 2) {

            } else {

            }

        }
        return $result;
    }

    private function calculateAvg ($grades) {
        $total_score = array_sum(array_column($grades, 'grade'));
        $count = count($grades);
        return $total_score / $count;
    }

    private function rateCsmStudent($grades) {
        $avg = $this->calculateAvg($grades);
        if ($avg >= 7) {
            return ["avg" => $avg, "final_result" => "Pass"];
        } else {
            return ["avg" => $avg, "final_result" => "Fail"];
        }
    }

}