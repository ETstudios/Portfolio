<?php
class Experiences {      
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function ListEducation() {
        $sql = "SELECT college, degreeType, degreeField, description, activities, startDate, endDate FROM portfolio.Education";
        $result = false;

        if ($stmt = $this->conn->prepare($sql)) {
            if ($stmt->execute()) {
                $college = $degreeType = $degreeField = $description = $activities = $startDate = $endDate = null;

                if ($stmt->bind_result($college, $degreeType, $degreeField, $description, $activities, $startDate, $endDate)) {
                    if ($stmt->store_result()) {
                        $edu = [];
                        $i = 0;
                        
                        while ($stmt->fetch()) {
                            $edu[$i]['college'] = $college;
                            $edu[$i]['degreeType'] = $degreeType;
                            $edu[$i]['degreeField'] = $degreeField;
                            $edu[$i]['description'] = $description;
                            $edu[$i]['activities'] = $activities;
                            $edu[$i]['startDate'] = $startDate;
                            $edu[$i]['endDate'] = $endDate;
                            $i++;
                        }

                        $result = $edu;
                        $stmt->close();
                    }
                }
            }
        }

        return $result;
    }
    
    public function ListJobs() {
        $sql = "SELECT company, title, description, startDate, endDate FROM portfolio.Jobs";
        $result = false;

        if ($stmt = $this->conn->prepare($sql)) {
            if ($stmt->execute()) {
                $company = $title = $description = $startDate = $endDate = null;

                if ($stmt->bind_result($company, $title, $description, $startDate, $endDate)) {
                    if ($stmt->store_result()) {
                        $jobs = [];
                        $i = 0;
                        
                        while ($stmt->fetch()) {
                            $jobs[$i]['company'] = $company;
                            $jobs[$i]['title'] = $title;
                            $jobs[$i]['description'] = $description;
                            $jobs[$i]['startDate'] = $startDate;
                            $jobs[$i]['endDate'] = $endDate;
                            $i++;
                        }

                        $result = $jobs;
                        $stmt->close();
                    }
                }
            }
        }

        return $result;
    }
}
?>