
<?php
class LeaveType {
    private $conn;
    private $table_name = "tblleavetype";

    public $LEAVTID;
    public $LEAVETYPE;
    public $DESCRIPTION;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY LEAVETYPE";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                SET LEAVETYPE=:leavetype, DESCRIPTION=:description";

        $stmt = $this->conn->prepare($query);

        $this->LEAVETYPE = htmlspecialchars(strip_tags($this->LEAVETYPE));
        $this->DESCRIPTION = htmlspecialchars(strip_tags($this->DESCRIPTION));

        $stmt->bindParam(":leavetype", $this->LEAVETYPE);
        $stmt->bindParam(":description", $this->DESCRIPTION);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . " 
                SET LEAVETYPE=:leavetype, DESCRIPTION=:description
                WHERE LEAVTID=:leavtid";

        $stmt = $this->conn->prepare($query);

        $this->LEAVETYPE = htmlspecialchars(strip_tags($this->LEAVETYPE));
        $this->DESCRIPTION = htmlspecialchars(strip_tags($this->DESCRIPTION));
        $this->LEAVTID = htmlspecialchars(strip_tags($this->LEAVTID));

        $stmt->bindParam(":leavetype", $this->LEAVETYPE);
        $stmt->bindParam(":description", $this->DESCRIPTION);
        $stmt->bindParam(":leavtid", $this->LEAVTID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE LEAVTID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->LEAVTID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
