<?php
class Projects {      
    private $conn;
    private $thumbnailUrl = "https://phasma-technologies.s3.us-east-2.amazonaws.com/portfolio/thumbnails/";
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function GetTagId($tag) {
        $sql = "SELECT id FROM portfolio.Tags WHERE tag = ?";
        $result = false;

        if ($stmt = $this->conn->prepare($sql)) {
            if ($stmt->bind_param("s", $tag)) {
                if ($stmt->execute()) {
                    $id = null;

                    if($stmt->bind_result($id)) {
                        if($stmt->store_result()) {
                            if($stmt->num_rows == 1) {
                                while ($stmt->fetch()) {
                                    $result = $id;
                                }

                                $stmt->close();
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }

    public function ListProjects() {
        $sql = "SELECT title, description, urlDemo, urlRepo, thumbnailName, thumbnailAlt FROM portfolio.Projects ORDER BY ID DESC";
        $result = false;

        if ($stmt = $this->conn->prepare($sql)) {
            if ($stmt->execute()) {
                $title = $description = $urlDemo = $urlRepo = $thumbnailName = $thumbnailAlt = null;

                if ($stmt->bind_result($title, $description, $urlDemo, $urlRepo, $thumbnailName, $thumbnailAlt)) {
                    if ($stmt->store_result()) {
                        $projects = [];
                        $i = 0;

                        while ($stmt->fetch()) {
                            $projects[$i]['title'] = $title;
                            $projects[$i]['description'] = $description;
                            $projects[$i]['urlDemo'] = $urlDemo;
                            $projects[$i]['urlRepo'] = $urlRepo;
                            $projects[$i]['thumbnailUrl'] = $this->thumbnailUrl . $thumbnailName;
                            $projects[$i]['thumbnailAlt'] = $thumbnailAlt;
                            $i++;
                        }

                        $result = $projects;
                        $stmt->close();
                    }
                }
            }
        }

        return $result;
    }

    public function ListTags() {
        $sql = "Select tag FROM portfolio.Tags";
        $result = false;

        if ($stmt = $this->conn->prepare($sql)) {
            if ($stmt->execute()) {
                $tag = null;

                if ($stmt->bind_result($tag)) {
                    if($stmt->store_result()) {
                        $tags = [];
                        $i = 0;

                        while($stmt->fetch()) {
                            $tags[$i] = $tag;
                            $i++;
                        }

                        $result = $tags;
                        $stmt->close();
                    }
                }
            }
        }

        return $result;
    }

    public function ListProjectTags($id) {
        $sql = "SELECT title FROM portfolio.Projects
        INNER JOIN portfolio.ProjectTags ON portfolio.Projects.id = portfolio.ProjectTags.projectId
        WHERE ProjectTags.tagId = ?";

        $result = false;

        if ($stmt = $this->conn->prepare($sql)) {
            if ($stmt->bind_param("i", $id)) {
                if ($stmt->execute()) {
                    $title = null;

                    if ($stmt->bind_result($title)) {
                        if ($stmt->store_result()) {
                            $projects = [];
                            $i = 0;

                            while ($stmt->fetch()) {
                                $projects[$i] = $title;
                                $i++;
                            }

                            $result = $projects;
                            $stmt->close();
                        }
                    }
                }
            }
        }

        return $result;
    }

/*
    public function Create() {
        $string = "ABCDEFGHJKLMNPQRTUVWXYZ";
        $numbers = "2346789";            

        $string = substr(str_shuffle($string), 0, 1);
        $numbers = substr(str_shuffle($numbers), 0, 1);

        for($i = 0; $i <= 4; $i++) {
            $string .= substr(str_shuffle($string), 0, 1);
            $numbers .= substr(str_shuffle($numbers), 0, 1);
        }

        $generatedPass = $string . $numbers;
        $key = str_shuffle($generatedPass);
        $key = substr($key, 0, 4);

        $banned = $this->Blacklist();

        if($this->Check($key) || in_array($key, $banned)) {
            $key = $this->Create();
        }

        return $key;
    }
    
    public function Delete($id) {
        $sql = "DELETE FROM Codes WHERE id = ?;";
        $result = false;
        
        if($stmt = $this->conn->prepare($sql)) {
            if($stmt->bind_param("i", $id)) {
                if($stmt->execute()) {
                    $result = true;
                    $stmt->close();
                }
            }
        }
        
        return $result;
    }
    
    public function Info($id) {
        $sql = "SELECT code, volume, usersCount FROM Codes WHERE id = ? OR code = ?;";
        $result = false;

        if($stmt = $this->conn->prepare($sql)) {
            if($stmt->bind_param("is", $id, $id)) {
                if($stmt->execute()) {
                    $code = null;
                    $volume = null;
                    $usersCount = null;

                    if($stmt->bind_result($code, $volume, $usersCount)) {
                        if($stmt->store_result()) {
                            if($stmt->num_rows == 1) {
                                $info = array();

                                while($stmt->fetch()) {
                                    $info['code'] = $code;
                                    $info['volume'] = $volume;
                                    $info['usersCount'] = $usersCount;
                                }

                                $result = $info;
                                $stmt->close();
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }
    
    public function List() {
        $sql = "SELECT id, code, volume, usersCount FROM Codes;";
        $result = false;

        if($stmt = $this->conn->prepare($sql)) {
            if($stmt->execute()) {
                $id = null;
                $code = null;
                $volume = null;
                $usersCount = null;

                if($stmt->bind_result($id, $code, $volume, $usersCount)) {
                    if($stmt->store_result()) {
                        $codes = array();
                        $i = 0;

                        while($stmt->fetch()) {
                            $codes[$i]['id'] = $id;
                            $codes[$i]['code'] = $code;
                            $codes[$i]['volume'] = $volume;
                            $codes[$i]['usersCount'] = $usersCount;
                            $i++;
                        }

                        $result = $codes;
                        $stmt->close();
                    }
                }
            }
        }

        return $result;
    }
    
    public function Update($id, $code, $volume, $usersCount) {
        $sql = "UPDATE Codes SET code = ?, volume = ?, usersCount = ? WHERE id = ? OR code = ?;";
        $result = false;
        
        if($stmt = $this->conn->prepare($sql)) {
            if($stmt->bind_param("siiis", $code, $volume, $usersCount, $id, $id)) {
                if($stmt->execute()) {
                    $result = true;
                    $stmt->close();
                }
            }
        }
        
        return $result;
    }
*/
}
?>