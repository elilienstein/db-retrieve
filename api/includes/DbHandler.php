<?php


class DbHandler {

    private $conn;

    function __construct() {
        require_once __DIR__.'/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
        // Set every possible option to utf-8
        mysqli_query($this->conn, 'SET NAMES "utf8"');
        mysqli_query($this->conn, 'SET CHARACTER SET "utf8"');
        mysqli_query($this->conn, 'SET character_set_results = "utf8",' .
                     'character_set_client = "utf8", character_set_connection = "utf8",' .
                    'character_set_database = "utf8", character_set_server = "utf8"');
        
    }
    
    
   
        
    
    
    public function getTweets($geo_long, $geo_lat) {
        
        
        $query = "SELECT created_at, geo_lat, geo_long, user_id FROM tweets WHERE geo_long LIKE '$geo_long%' AND geo_lat LIKE '$geo_lat%'";
        
        $stmt = $this->conn->prepare($query) or trigger_error($mysqli->error."[$query]");
        
        $stmt->execute();
            
        $result = $stmt->get_result();
            
            if($result->num_rows > 0)
            {
            
                     return $result;
                } 

    }
    
}


    


?>