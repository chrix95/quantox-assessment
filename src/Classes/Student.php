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
            $result = $this->checkResultStatus($response['board'], $response['grades']);
            // set the average and result status to the response
            $response['average'] = $result['average'];
            $response['final_result'] = $result['final_result'];
            if ($result['grades']) {
                $response['grades'] = $result['grades'];
            }
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
            $result = $this->rateCsmbStudent($grades);
            $result['average'] = $this->calculateAvg($grades);
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
            return ["average" => $avg, "final_result" => "Pass"];
        } else {
            return ["average" => $avg, "final_result" => "Fail"];
        }
    }

    private function rateCsmbStudent($grades) {
        $result = [];
        $count = count($grades);
        if ($count <= 2) {
            // discard the smalllest grade
            array_reduce($grades, function ($a, $b){
                return $a['grade'] < $b['grade'] ? $a : $b;
            }, array_shift($grades));
            // reassign the grades
            $result['grades'] = $grades;
        }
        if (max(array_column($grades, 'grade')) > 8) {
            $result["final_result"] = "Pass";
        } else {
            $result["final_result"] = "Fail";
        }
        return $result;
    }

}