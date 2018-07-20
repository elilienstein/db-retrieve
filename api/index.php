<?php
    
    require_once __DIR__.'/includes/DbHandler.php';
    require __DIR__.'/libs/Slim/Slim.php';
    
    \Slim\Slim::registerAutoloader();
    
    $app = new \Slim\Slim();
   

    
    
    
    
    
    $app->hook('slim.before.dispatch', function () use ($app){
               
   $geo_long = $app->router()->getCurrentRoute()->getParam('geo_long');
    $geo_lat = $app->router()->getCurrentRoute()->getParam('geo_lat');
    
  });
    
    
    
    
    $app->get('/tweets/:geo_long/:geo_lat',  function($geo_long, $geo_lat)  use ($app){
              

              $app->response->headers->set('Content-Type', 'application/json');
              $response = array();
              $tmp = array();
              $db = new DbHandler();
              
              $result = $db->getTweets($geo_long, $geo_lat);
            
              $resultCount = 0;
              
              $response["results"] = array();
              
              
              
              
              while ($res = $result->fetch_assoc())
              {
                  // temp user array
                  $tmp = array();
            
                  $tmp["created_at"] = $res["created_at"];
                  $tmp["geo_lat"] = $res["geo_lat"];
                  $tmp["geo_long"] = $res["geo_long"];
                  $tmp["user_id"] = $res["user_id"];
                 
        
                  $tmp["\n"];
              // push single product into final response array
              
               array_push($response["results"], $tmp);
              

              
                }
             
              echo json_encode($response, JSON_UNESCAPED_UNICODE);
              
              
              });
    
    
    
    
    
    
    $app->run();
    
    ?>