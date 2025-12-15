<?php 
namespace Controllers;

use Classes\Validate;
use Classes\Response;
use Classes\Route;
use Exception;
use Models\Base\StatusesQuery;
use Models\Tasks;
use Models\TasksQuery;

#[Route("/api/tasks")]
class TaskController{

    protected function Ex(Exception $ex){
        return new Response(500,$ex->getMessage());
    }

    #[Route("","POST")]
    public function TaskAdd($params){
        try{
            $fields = ["title", "description", "status"];

            if(Validate::params($fields,$params)){
                return new Response(400, "required ".json_encode($params));
            }

            if(Validate::Status($params["status"], $r)){
                return $r;
            }

            if(TasksQuery::create()->filterByTitle($params["title"])
            ->filterByDescription($params["description"])
            ->filterByStatus($params["status"])->exists()){
                return new Response(400, "Task with that parameters already exists");
            }

            $task = new Tasks();
            $task->setTitle($params["title"])
            ->setDescription($params["description"])
            ->setStatus($params["status"])->save();
            return new Response(200,"Task added with id = ".$task->getId());
        }
        catch(Exception $ex){
            return $this->Ex($ex);
        }
    }

    #[Route("","GET")]
    public function GetTasks(){
        try{
            return new Response(200, TasksQuery::create()->find()->toArray());
        }
        catch(Exception $ex){
            return $this->Ex($ex);
        }
    }

    #[Route("/{id}","GET")]
    public function GetTaskById($params){
        try{
            $id = $params["id"] ?? null;

            if(Validate::IdNull($id, $r)){
                return $r;
            }

            $task = Validate::TaskById($id, $r);
            if($task === null){
                return $r;
            }

            return new Response(200, json_encode($task->toArray()));
        }
        catch(Exception $ex){
            return $this->Ex($ex);
        }
    }

    #[Route("/{id}","PUT")]
    public function EditTaskById($params){
        try{
            $id = $params["id"] ?? null;

            if(Validate::IdNull($id, $r)){
                return $r;
            }

            if(Validate::Status($params["status"], $r)){
                return $r;
            }

            $task = Validate::TaskById($id, $r);
            if($task === null){
                return $r;
            }

            foreach ($params as $key => $value) {
                if ($value === null) continue;

                match ($key) {
                    'title' => $task->setTitle($value),
                    'description' => $task->setDescription($value),
                    'status' => $value != 0 ? $task->setStatus($value) : null,
                    default => null
                };
            }

            $task->save();
            return new Response(200, "task successful updated");
        }
        catch(Exception $ex){
            return $this->Ex($ex);
        }
    }

    #[Route("/{id}","DELETE")]
    public function DeleteTaskById($params){
        try{
            $id = $params["id"] ?? null;

            if(Validate::IdNull($id, $r)){
                return $r;
            }

            $task = Validate::TaskById($id, $r);
            if($task === null){
                return $r;
            }

            $task->delete();
            return new Response(200, "Task deleted");
        }
        catch(Exception $ex){
            return $this->Ex($ex);
        }
    }
}
?>