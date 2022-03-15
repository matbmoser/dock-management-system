<?php
/*
 * Usuario Class
 * This class is used for database related (connect fetch, insert, and update) operations
 * @author    wejyc.com
 * @url       http://www.wejyc.com
 * @license   http://www.wejyc.com/license
 */
class Usuario{
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "NdVd4XxwoBfJ4Qx1";
    private $dbName     = "ufveats";
    private $table      = "user";
    
    
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: ".$this->table. $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    /*
     * Returns rows from the database based on the conditions
     * @param array select, where, order_by, limit and return_type conditions
     */
    public function getRows($conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$this->table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("where_not",$conditions)){
            $sql .= (strpos($sql, 'WHERE') === false)?' WHERE ':' AND ';
            $i = 0;
            foreach($conditions['where_not'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." != '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }

        $result = $this->db->query($sql);
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = ($result->num_rows > 0)?$result->fetch_assoc():false;
                    break;
                default:
                    $data = '';
            }
        }else{
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Insert data into the database
     * @param array the data for inserting into the table
     */
    public function insert($data){
        date_default_timezone_set("Europe/Madrid");
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
            if(!array_key_exists('created',$data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $columns .= $pre.$key;
                $values  .= $pre."'".$this->db->real_escape_string($val)."'";
                $i++;
            }
            $query = "INSERT INTO ".$this->table." (".$columns.") VALUES (".$values.")";
            $insert = $this->db->query($query);
            return $insert?$this->db->insert_id:false;
        }else{
            return false;
        }
    }
    
    /*
     * Update data into the database
     * @param array the data to update into the table
     * @param array where condition on updating data
     */
    public function update($data, $conditions){
        date_default_timezone_set("Europe/Madrid");
        if(!empty($data) && is_array($data) && !empty($conditions)){
            //prepare columns and values sql
            $cols_vals = '';
            $i = 0;
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $cols_vals .= $pre.$key." = '".$this->db->real_escape_string($val)."'";
                $i++;
            }
            
            //prepare where conditions
            $whereSql = '';
            $ci = 0;
            foreach($conditions as $key => $value){
                $pre = ($ci > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $ci++;
            }
            
            //prepare sql query
            $query = "UPDATE ".$this->table." SET ".$cols_vals." WHERE ".$whereSql;

            //update data
            $update = $this->db->query($query);
            return $update?true:false;
        }else{
            return false;
        }
    }

    /*
     * Delete data from the database
     * @param array where condition on deleting data
     */
    public function delete($conditions){
        if(!empty($conditions)){
            
            //prepare where conditions
            $whereSql = '';
            $ci = 0;
            foreach($conditions as $key => $value){
                $pre = ($ci > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $ci++;
            }
            
            //prepare sql query
            $query = "DELETE FROM ".$this->table." WHERE ".$whereSql;

            //update data
            $delete = $this->db->query($query);
            return $delete?true:false;
        }else{
            return false;
        }
    }

    /*
     * Insert / Update social user data into the database
     * @param array the data to insert or update into the table
     */
    function checkUser($userData = array()){
        if(!empty($userData)){
            // Check whether user data already exists in database with same oauth info
            $prevQuery = "SELECT * FROM ".$this->table." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
            $prevResult = $this->db->query($prevQuery);
            
            // Check whether user data already exists in database with same email
            $prevQuery2 = "SELECT * FROM ".$this->table." WHERE email != '' AND email = '".$userData['email']."'";
            $prevResult2 = $this->db->query($prevQuery2);
            
            if($prevResult->num_rows > 0){
                $cols_vals = '';
                $i = 0;
                // Update user data if already exists
                if(!array_key_exists('modified',$userData)){
                    $userData['modified'] = date("Y-m-d H:i:s");
                }
                foreach($userData as $key=>$val){
                    $pre = ($i > 0)?', ':'';
                    $cols_vals .= $pre.$key." = '".$this->db->real_escape_string($val)."'";
                    $i++;
                }
                //prepare sql query
                $query = "UPDATE ".$this->table." SET ".$cols_vals." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
    
                //update data
                $update = $this->db->query($query);
            }elseif($prevResult2->num_rows > 0){
                // Update user data if already exists
                if(!array_key_exists('modified',$userData)){
                    $userData['modified'] = date("Y-m-d H:i:s");
                }

                //prepare sql query
                $query = "UPDATE ".$this->table." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', modified = '".$userData['modified']."' WHERE email = '".$userData['email']."'";
    
                //update data
                $update = $this->db->query($query);
            }else{
                $columns = '';
                $values  = '';
                $i = 0;
                // Insert user data
                $userData['activated'] = '1';
                $userData['status'] = '1';
                if(!array_key_exists('created',$userData)){
                    $userData['created'] = date("Y-m-d H:i:s");
                }
                if(!array_key_exists('modified',$userData)){
                    $userData['modified'] = date("Y-m-d H:i:s");
                }
                foreach($userData as $key=>$val){
                    $pre = ($i > 0)?', ':'';
                    $columns .= $pre.$key;
                    $values  .= $pre."'".$this->db->real_escape_string($val)."'";
                    $i++;
                }
                $query = "INSERT INTO ".$this->table." (".$columns.") VALUES (".$values.")";
                $insert = $this->db->query($query);
            }
            
            // Get user data from the database
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }
        
        // Return user data
        return $userData;
    }
	

}