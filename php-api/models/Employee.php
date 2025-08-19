
<?php
class Employee {
    private $conn;
    private $table_name = "employee";

    public $EMPLOYID;
    public $EMPNAME;
    public $EMPUSERNAME;
    public $EMPPASS;
    public $EMPADDRESS;
    public $EMPCONTACTNO;
    public $EMPPOSITION;
    public $EMPSTATUS;
    public $COMPANYID;
    public $DEPARTMENTID;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT e.*, c.COMPANYNAME, d.DEPARTMENT 
                  FROM " . $this->table_name . " e
                  LEFT JOIN company c ON e.COMPANYID = c.COMPANYID
                  LEFT JOIN department d ON e.DEPARTMENTID = d.DEPARTMENTID
                  ORDER BY e.EMPNAME";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE EMPLOYID = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->EMPLOYID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->EMPNAME = $row['EMPNAME'];
            $this->EMPUSERNAME = $row['EMPUSERNAME'];
            $this->EMPPASS = $row['EMPPASS'];
            $this->EMPADDRESS = $row['EMPADDRESS'];
            $this->EMPCONTACTNO = $row['EMPCONTACTNO'];
            $this->EMPPOSITION = $row['EMPPOSITION'];
            $this->EMPSTATUS = $row['EMPSTATUS'];
            $this->COMPANYID = $row['COMPANYID'];
            $this->DEPARTMENTID = $row['DEPARTMENTID'];
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET EMPLOYID=:employid, EMPNAME=:empname, EMPUSERNAME=:empusername, 
                      EMPPASS=:emppass, EMPADDRESS=:empaddress, EMPCONTACTNO=:empcontactno,
                      EMPPOSITION=:empposition, EMPSTATUS=:empstatus, COMPANYID=:companyid,
                      DEPARTMENTID=:departmentid";

        $stmt = $this->conn->prepare($query);

        $this->EMPLOYID = htmlspecialchars(strip_tags($this->EMPLOYID));
        $this->EMPNAME = htmlspecialchars(strip_tags($this->EMPNAME));
        $this->EMPUSERNAME = htmlspecialchars(strip_tags($this->EMPUSERNAME));
        $this->EMPPASS = sha1($this->EMPPASS);
        $this->EMPADDRESS = htmlspecialchars(strip_tags($this->EMPADDRESS));
        $this->EMPCONTACTNO = htmlspecialchars(strip_tags($this->EMPCONTACTNO));
        $this->EMPPOSITION = htmlspecialchars(strip_tags($this->EMPPOSITION));
        $this->EMPSTATUS = htmlspecialchars(strip_tags($this->EMPSTATUS));
        $this->COMPANYID = htmlspecialchars(strip_tags($this->COMPANYID));
        $this->DEPARTMENTID = htmlspecialchars(strip_tags($this->DEPARTMENTID));

        $stmt->bindParam(":employid", $this->EMPLOYID);
        $stmt->bindParam(":empname", $this->EMPNAME);
        $stmt->bindParam(":empusername", $this->EMPUSERNAME);
        $stmt->bindParam(":emppass", $this->EMPPASS);
        $stmt->bindParam(":empaddress", $this->EMPADDRESS);
        $stmt->bindParam(":empcontactno", $this->EMPCONTACTNO);
        $stmt->bindParam(":empposition", $this->EMPPOSITION);
        $stmt->bindParam(":empstatus", $this->EMPSTATUS);
        $stmt->bindParam(":companyid", $this->COMPANYID);
        $stmt->bindParam(":departmentid", $this->DEPARTMENTID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET EMPNAME = :empname, 
                      EMPUSERNAME = :empusername,
                      EMPADDRESS = :empaddress,
                      EMPCONTACTNO = :empcontactno,
                      EMPPOSITION = :empposition,
                      EMPSTATUS = :empstatus,
                      COMPANYID = :companyid,
                      DEPARTMENTID = :departmentid";

        if (!empty($this->EMPPASS)) {
            $query .= ", EMPPASS = :emppass";
        }

        $query .= " WHERE EMPLOYID = :employid";

        $stmt = $this->conn->prepare($query);

        $this->EMPNAME = htmlspecialchars(strip_tags($this->EMPNAME));
        $this->EMPUSERNAME = htmlspecialchars(strip_tags($this->EMPUSERNAME));
        $this->EMPADDRESS = htmlspecialchars(strip_tags($this->EMPADDRESS));
        $this->EMPCONTACTNO = htmlspecialchars(strip_tags($this->EMPCONTACTNO));
        $this->EMPPOSITION = htmlspecialchars(strip_tags($this->EMPPOSITION));
        $this->EMPSTATUS = htmlspecialchars(strip_tags($this->EMPSTATUS));
        $this->COMPANYID = htmlspecialchars(strip_tags($this->COMPANYID));
        $this->DEPARTMENTID = htmlspecialchars(strip_tags($this->DEPARTMENTID));
        $this->EMPLOYID = htmlspecialchars(strip_tags($this->EMPLOYID));

        $stmt->bindParam(':empname', $this->EMPNAME);
        $stmt->bindParam(':empusername', $this->EMPUSERNAME);
        $stmt->bindParam(':empaddress', $this->EMPADDRESS);
        $stmt->bindParam(':empcontactno', $this->EMPCONTACTNO);
        $stmt->bindParam(':empposition', $this->EMPPOSITION);
        $stmt->bindParam(':empstatus', $this->EMPSTATUS);
        $stmt->bindParam(':companyid', $this->COMPANYID);
        $stmt->bindParam(':departmentid', $this->DEPARTMENTID);
        $stmt->bindParam(':employid', $this->EMPLOYID);

        if (!empty($this->EMPPASS)) {
            $this->EMPPASS = sha1($this->EMPPASS);
            $stmt->bindParam(':emppass', $this->EMPPASS);
        }

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE EMPLOYID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->EMPLOYID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE EMPUSERNAME = ? AND EMPPASS = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, sha1($password));
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->EMPLOYID = $row['EMPLOYID'];
            $this->EMPNAME = $row['EMPNAME'];
            $this->EMPUSERNAME = $row['EMPUSERNAME'];
            $this->EMPPOSITION = $row['EMPPOSITION'];
            $this->EMPSTATUS = $row['EMPSTATUS'];
            return true;
        }
        return false;
    }

    public function resetPassword($currentPassword, $newPassword) {
        $query = "SELECT EMPPASS FROM " . $this->table_name . " WHERE EMPLOYID = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->EMPLOYID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row && $row['EMPPASS'] === sha1($currentPassword)) {
            $updateQuery = "UPDATE " . $this->table_name . " SET EMPPASS = ? WHERE EMPLOYID = ?";
            $updateStmt = $this->conn->prepare($updateQuery);
            $hashedNewPassword = sha1($newPassword);
            $updateStmt->bindParam(1, $hashedNewPassword);
            $updateStmt->bindParam(2, $this->EMPLOYID);

            if($updateStmt->execute()) {
                return true;
            }
        }
        return false;
    }
}
?>
