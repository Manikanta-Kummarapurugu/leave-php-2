
<?php
class Employee {
    private $conn;
    private $table_name = "tblemployee";

    public $EMPID;
    public $EMPLOYID;
    public $EMPNAME;
    public $EMPADDRESS;
    public $EMPCONTACT;
    public $EMPPOSITION;
    public $EMPSEX;
    public $COMPANY;
    public $DEPARTMENT;
    public $USERNAME;
    public $PASSWRD;
    public $ACCSTATUS;
    public $AVELEAVE;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY EMPNAME ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE EMPID = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->EMPID);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->EMPLOYID = $row['EMPLOYID'];
            $this->EMPNAME = $row['EMPNAME'];
            $this->EMPADDRESS = $row['EMPADDRESS'];
            $this->EMPCONTACT = $row['EMPCONTACT'];
            $this->EMPPOSITION = $row['EMPPOSITION'];
            $this->EMPSEX = $row['EMPSEX'];
            $this->COMPANY = $row['COMPANY'];
            $this->DEPARTMENT = $row['DEPARTMENT'];
            $this->USERNAME = $row['USERNAME'];
            $this->PASSWRD = $row['PASSWRD'];
            $this->ACCSTATUS = $row['ACCSTATUS'];
            $this->AVELEAVE = $row['AVELEAVE'];
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET EMPLOYID=:employid, EMPNAME=:empname, EMPADDRESS=:empaddress,
                    EMPCONTACT=:empcontact, EMPPOSITION=:empposition, EMPSEX=:empsex,
                    COMPANY=:company, DEPARTMENT=:department, USERNAME=:username,
                    PASSWRD=:passwrd, ACCSTATUS=:accstatus, AVELEAVE=:aveleave";

        $stmt = $this->conn->prepare($query);

        $this->EMPLOYID = htmlspecialchars(strip_tags($this->EMPLOYID));
        $this->EMPNAME = htmlspecialchars(strip_tags($this->EMPNAME));
        $this->EMPADDRESS = htmlspecialchars(strip_tags($this->EMPADDRESS));
        $this->EMPCONTACT = htmlspecialchars(strip_tags($this->EMPCONTACT));
        $this->EMPPOSITION = htmlspecialchars(strip_tags($this->EMPPOSITION));
        $this->EMPSEX = htmlspecialchars(strip_tags($this->EMPSEX));
        $this->COMPANY = htmlspecialchars(strip_tags($this->COMPANY));
        $this->DEPARTMENT = htmlspecialchars(strip_tags($this->DEPARTMENT));
        $this->USERNAME = htmlspecialchars(strip_tags($this->USERNAME));
        $this->PASSWRD = password_hash($this->PASSWRD, PASSWORD_DEFAULT);
        $this->ACCSTATUS = 'ACTIVE';
        $this->AVELEAVE = 15;

        $stmt->bindParam(":employid", $this->EMPLOYID);
        $stmt->bindParam(":empname", $this->EMPNAME);
        $stmt->bindParam(":empaddress", $this->EMPADDRESS);
        $stmt->bindParam(":empcontact", $this->EMPCONTACT);
        $stmt->bindParam(":empposition", $this->EMPPOSITION);
        $stmt->bindParam(":empsex", $this->EMPSEX);
        $stmt->bindParam(":company", $this->COMPANY);
        $stmt->bindParam(":department", $this->DEPARTMENT);
        $stmt->bindParam(":username", $this->USERNAME);
        $stmt->bindParam(":passwrd", $this->PASSWRD);
        $stmt->bindParam(":accstatus", $this->ACCSTATUS);
        $stmt->bindParam(":aveleave", $this->AVELEAVE);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET EMPLOYID = :employid,
                    EMPNAME = :empname,
                    EMPADDRESS = :empaddress,
                    EMPCONTACT = :empcontact,
                    EMPPOSITION = :empposition,
                    EMPSEX = :empsex,
                    COMPANY = :company,
                    DEPARTMENT = :department,
                    USERNAME = :username,
                    ACCSTATUS = :accstatus,
                    AVELEAVE = :aveleave
                WHERE EMPID = :empid";

        $stmt = $this->conn->prepare($query);

        $this->EMPLOYID = htmlspecialchars(strip_tags($this->EMPLOYID));
        $this->EMPNAME = htmlspecialchars(strip_tags($this->EMPNAME));
        $this->EMPADDRESS = htmlspecialchars(strip_tags($this->EMPADDRESS));
        $this->EMPCONTACT = htmlspecialchars(strip_tags($this->EMPCONTACT));
        $this->EMPPOSITION = htmlspecialchars(strip_tags($this->EMPPOSITION));
        $this->EMPSEX = htmlspecialchars(strip_tags($this->EMPSEX));
        $this->COMPANY = htmlspecialchars(strip_tags($this->COMPANY));
        $this->DEPARTMENT = htmlspecialchars(strip_tags($this->DEPARTMENT));
        $this->USERNAME = htmlspecialchars(strip_tags($this->USERNAME));
        $this->ACCSTATUS = htmlspecialchars(strip_tags($this->ACCSTATUS));
        $this->AVELEAVE = htmlspecialchars(strip_tags($this->AVELEAVE));
        $this->EMPID = htmlspecialchars(strip_tags($this->EMPID));

        $stmt->bindParam(':employid', $this->EMPLOYID);
        $stmt->bindParam(':empname', $this->EMPNAME);
        $stmt->bindParam(':empaddress', $this->EMPADDRESS);
        $stmt->bindParam(':empcontact', $this->EMPCONTACT);
        $stmt->bindParam(':empposition', $this->EMPPOSITION);
        $stmt->bindParam(':empsex', $this->EMPSEX);
        $stmt->bindParam(':company', $this->COMPANY);
        $stmt->bindParam(':department', $this->DEPARTMENT);
        $stmt->bindParam(':username', $this->USERNAME);
        $stmt->bindParam(':accstatus', $this->ACCSTATUS);
        $stmt->bindParam(':aveleave', $this->AVELEAVE);
        $stmt->bindParam(':empid', $this->EMPID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE EMPID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->EMPID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE USERNAME = ? AND ACCSTATUS = 'ACTIVE' LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->USERNAME);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row && password_verify($this->PASSWRD, $row['PASSWRD'])) {
            $this->EMPID = $row['EMPID'];
            $this->EMPLOYID = $row['EMPLOYID'];
            $this->EMPNAME = $row['EMPNAME'];
            $this->EMPPOSITION = $row['EMPPOSITION'];
            $this->COMPANY = $row['COMPANY'];
            $this->DEPARTMENT = $row['DEPARTMENT'];
            $this->ACCSTATUS = $row['ACCSTATUS'];
            return true;
        }
        return false;
    }

    public function resetPassword() {
        $query = "UPDATE " . $this->table_name . " SET PASSWRD = :passwrd WHERE EMPID = :empid";
        $stmt = $this->conn->prepare($query);
        
        $hashedPassword = password_hash($this->PASSWRD, PASSWORD_DEFAULT);
        $this->EMPID = htmlspecialchars(strip_tags($this->EMPID));
        
        $stmt->bindParam(':passwrd', $hashedPassword);
        $stmt->bindParam(':empid', $this->EMPID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
