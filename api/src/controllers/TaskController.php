<?php 
namespace Controllers;

use Classes\Check;
use Classes\Response;
use Classes\Route;
use Models\Map\TasksTableMap;
use Models\Tasks;
use Models\TasksQuery;

#[Route("/api/tasks")]
class TaskController{

    #[Route("","get")]
    public function TaskAdd($params){
        $fields = ["title", "description", "status"];
        $response = new Response();
        if(!Check::params($fields,$params)){
            $response->status = 400;
            $response->body = "required ".json_encode($fields);
            return $response;
        }
         
        
        //Check::params()
        //if()
    }
}
?>