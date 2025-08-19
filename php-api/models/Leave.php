
<?php
class Leave {
    private $conn;
    private $table_name = "tblleave";

    public $LEAVEID;
    public $EMPLOYID;
    public $DATESTART;
    public $DATEEND;
    public $NODAYS;
    public $SHIFTTIME;
    public $TYPEOFLEAVE;
    public $REASON;
    public $LEAVESTATUS;
    public $ADMINREMARKS;
    public $DATEPOSTED;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY DATEPOSTED DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE LEAVEID = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->LEAVEID);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->EMPLOYID = $row['EMPLOYID'];
            $this->DATESTART = $row['DATESTART'];
            $this->DATEEND = $row['DATEEND'];
            $this->NODAYS = $row['NODAYS'];
            $this->SHIFTTIME = $row['SHIFTTIME'];
            $this->TYPEOFLEAVE = $row['TYPEOFLEAVE'];
            $this->REASON = $row['REASON'];
            $this->LEAVESTATUS = $row['LEAVESTATUS'];
            $this->ADMINREMARKS = $row['ADMINREMARKS'];
            $this->DATEPOSTED = $row['DATEPOSTED'];
            return true;
        }
        return false;
    }

    public function create() {
        // Calculate NODAYS based on shift time and date range
        $this->calculateLeaveDays();
        
        $query = "INSERT INTO " . $this->table_name . "
                SET EMPLOYID=:employid, DATESTART=:datestart, DATEEND=:dateend,
                    NODAYS=:nodays, SHIFTTIME=:shifttime, TYPEOFLEAVE=:typeofleave,
                    REASON=:reason, LEAVESTATUS=:leavestatus, ADMINREMARKS=:adminremarks,
                    DATEPOSTED=:dateposted";

        $stmt = $this->conn->prepare($query);

        $this->EMPLOYID = htmlspecialchars(strip_tags($this->EMPLOYID));
        $this->DATESTART = htmlspecialchars(strip_tags($this->DATESTART));
        $this->DATEEND = htmlspecialchars(strip_tags($this->DATEEND));
        $this->SHIFTTIME = htmlspecialchars(strip_tags($this->SHIFTTIME));
        $this->TYPEOFLEAVE = htmlspecialchars(strip_tags($this->TYPEOFLEAVE));
        $this->REASON = htmlspecialchars(strip_tags($this->REASON));
        $this->LEAVESTATUS = 'PENDING';
        $this->ADMINREMARKS = 'N/A';
        $this->DATEPOSTED = date('Y-m-d');

        $stmt->bindParam(":employid", $this->EMPLOYID);
        $stmt->bindParam(":datestart", $this->DATESTART);
        $stmt->bindParam(":dateend", $this->DATEEND);
        $stmt->bindParam(":nodays", $this->NODAYS);
        $stmt->bindParam(":shifttime", $this->SHIFTTIME);
        $stmt->bindParam(":typeofleave", $this->TYPEOFLEAVE);
        $stmt->bindParam(":reason", $this->REASON);
        $stmt->bindParam(":leavestatus", $this->LEAVESTATUS);
        $stmt->bindParam(":adminremarks", $this->ADMINREMARKS);
        $stmt->bindParam(":dateposted", $this->DATEPOSTED);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET LEAVESTATUS = :leavestatus,
                    ADMINREMARKS = :adminremarks,
                    DATEPOSTED = :dateposted
                WHERE LEAVEID = :leaveid";

        $stmt = $this->conn->prepare($query);

        $this->LEAVESTATUS = htmlspecialchars(strip_tags($this->LEAVESTATUS));
        $this->ADMINREMARKS = htmlspecialchars(strip_tags($this->ADMINREMARKS));
        $this->DATEPOSTED = date('Y-m-d');
        $this->LEAVEID = htmlspecialchars(strip_tags($this->LEAVEID));

        $stmt->bindParam(':leavestatus', $this->LEAVESTATUS);
        $stmt->bindParam(':adminremarks', $this->ADMINREMARKS);
        $stmt->bindParam(':dateposted', $this->DATEPOSTED);
        $stmt->bindParam(':leaveid', $this->LEAVEID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    private function calculateLeaveDays() {
        $start = new DateTime($this->DATESTART);
        $end = new DateTime($this->DATEEND);
        $diff = $start->diff($end);
        $daysDiff = $diff->days + 1;

        if ($this->SHIFTTIME == 'AM' || $this->SHIFTTIME == 'PM') {
            $this->NODAYS = $daysDiff / 2;
        } else {
            $this->NODAYS = $daysDiff;
        }
    }

    public function readByEmployee() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE EMPLOYID = ? ORDER BY DATEPOSTED DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->EMPLOYID);
        $stmt->execute();
        return $stmt;
    }

    public function readByStatus() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE LEAVESTATUS = ? ORDER BY DATEPOSTED DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->LEAVESTATUS);
        $stmt->execute();
        return $stmt;
    }
}
?>
