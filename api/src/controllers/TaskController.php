<?php 
namespace Controllers;

use Classes\Response;
use Classes\Route;
use Classes\Check;
use Models\Tasks;
use TasksQuery;

#[Route("/tasks")]
class TaskController{

    #[Route("","get")]
    public function TaskAdd($params){
        $response = new Response(200,TasksQuery::create()->getTablesColumns()); 
        return $response;
        //Check::params()
        //if()
    }
}
?>