
<?php
class Department {
    private $conn;
    private $table_name = "tbldepartment";

    public $DEPTID;
    public $DEPARTMENT;
    public $DESCRIPTION;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY DEPARTMENT";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                SET DEPARTMENT=:department, DESCRIPTION=:description";

        $stmt = $this->conn->prepare($query);

        $this->DEPARTMENT = htmlspecialchars(strip_tags($this->DEPARTMENT));
        $this->DESCRIPTION = htmlspecialchars(strip_tags($this->DESCRIPTION));

        $stmt->bindParam(":department", $this->DEPARTMENT);
        $stmt->bindParam(":description", $this->DESCRIPTION);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . " 
                SET DEPARTMENT=:department, DESCRIPTION=:description
                WHERE DEPTID=:deptid";

        $stmt = $this->conn->prepare($query);

        $this->DEPARTMENT = htmlspecialchars(strip_tags($this->DEPARTMENT));
        $this->DESCRIPTION = htmlspecialchars(strip_tags($this->DESCRIPTION));
        $this->DEPTID = htmlspecialchars(strip_tags($this->DEPTID));

        $stmt->bindParam(":department", $this->DEPARTMENT);
        $stmt->bindParam(":description", $this->DESCRIPTION);
        $stmt->bindParam(":deptid", $this->DEPTID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE DEPTID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->DEPTID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
