
<?php
class Company {
    private $conn;
    private $table_name = "tblcompany";

    public $COMPANYID;
    public $COMPANYNAME;
    public $COMPANYADDRESS;
    public $COMPANYCONTACTNO;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY COMPANYNAME";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                SET COMPANYNAME=:companyname, COMPANYADDRESS=:companyaddress, COMPANYCONTACTNO=:companycontactno";

        $stmt = $this->conn->prepare($query);

        $this->COMPANYNAME = htmlspecialchars(strip_tags($this->COMPANYNAME));
        $this->COMPANYADDRESS = htmlspecialchars(strip_tags($this->COMPANYADDRESS));
        $this->COMPANYCONTACTNO = htmlspecialchars(strip_tags($this->COMPANYCONTACTNO));

        $stmt->bindParam(":companyname", $this->COMPANYNAME);
        $stmt->bindParam(":companyaddress", $this->COMPANYADDRESS);
        $stmt->bindParam(":companycontactno", $this->COMPANYCONTACTNO);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . " 
                SET COMPANYNAME=:companyname, COMPANYADDRESS=:companyaddress, COMPANYCONTACTNO=:companycontactno
                WHERE COMPANYID=:companyid";

        $stmt = $this->conn->prepare($query);

        $this->COMPANYNAME = htmlspecialchars(strip_tags($this->COMPANYNAME));
        $this->COMPANYADDRESS = htmlspecialchars(strip_tags($this->COMPANYADDRESS));
        $this->COMPANYCONTACTNO = htmlspecialchars(strip_tags($this->COMPANYCONTACTNO));
        $this->COMPANYID = htmlspecialchars(strip_tags($this->COMPANYID));

        $stmt->bindParam(":companyname", $this->COMPANYNAME);
        $stmt->bindParam(":companyaddress", $this->COMPANYADDRESS);
        $stmt->bindParam(":companycontactno", $this->COMPANYCONTACTNO);
        $stmt->bindParam(":companyid", $this->COMPANYID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE COMPANYID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->COMPANYID);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
