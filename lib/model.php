<?php


class Model {
    private $conn;  // Property to hold the database connection

    // Constructor to assign the database connection
    public function __construct($db) {
        $this->conn = $db;  // Assign the passed connection to $this->conn\\
        // print_r($db);
    }
    function insert($table,$value)
    {
        $field="";
        $val="";
        $i=0;

        // print_r($value);

        
        foreach ($value as $k => $v)
        {
            $v = $this->conn->real_escape_string($v);
            print_r($v);
            if($i == 0)
            {
                $field.=$k;
                $val.="'".$v."'";
            }
            else 
            {
                $field.=",".$k;
                $val.=",'".$v."'";
                
            }
            $i++;
            
        }

        // echo "$field";

        mysqli_set_charset($this->conn,"utf8mb4");
        // print_r("INSERT INTO $table($field) VALUES($value)");exit;
        return mysqli_query($this->conn,"INSERT INTO $table($field) VALUES($val)") or die(mysqli_error($this->conn));
    }


    function update($table ,$value, $id)
    {
        if($id != '')
        {
            $where= 'where ' .$id;
        }

        $val="";
        $i=0;
        foreach ($value as $k => $v)
        {
            // print_r($this->conn);exit;
            $v = $this->conn->real_escape_string($v);
            if($i == 0)
            {
              $val.=$k."='".$v."'";    
            }
            
            else 
            {
              $val.=",".$k."='".$v."'";
            }
            $i++;
            
        }
        mysqli_set_charset($this->conn,"utf8mb4");
        return mysqli_query($this->conn,"update $table SET $val where id=$id");
    }

    public function getProductById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_product WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();  // Return the product as an associative array
        
    }


    function select($table, $where='', $other='')
    {
        if($where != '')
        {
            $where= 'where ' .$where;
        }
        mysqli_set_charset($this->conn,"utf8mb4");
        $select = mysqli_query($this->conn,"SELECT * FROM $table $where $other") or die(mysqli_error($this->conn));
        return $select;
    }

    function selectRow($colum,$table, $where='', $other='')
    {
        if($where != '')
        {
            $where= 'where ' .$where;
        }
        mysqli_set_charset($this->conn,"utf8mb4");
        //  print_r("SELECT $colum FROM $table $where $other");
        $select = mysqli_query($this->conn,"SELECT $colum FROM $table $where $other") or die(mysqli_error($this->conn));
        return $select;
    }

    public function deleteProduct($id) {
        // Prepare the SQL DELETE query
        $sql = "DELETE FROM tbl_product WHERE id = ?";

        // Use prepared statements to prevent SQL injection
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id); // Bind the integer value to the query

            // Execute the query and return true if successful, false if not
            if ($stmt->execute()) {
                return true; // Deletion successful
            } else {
                return false; // Error in deletion
            }
        } else {
            return false; // Error preparing the statement
        }
    }

}