<?php
namespace Classes;

use Models\StatusesQuery;
use Models\Tasks;
use Models\TasksQuery;

class Validate{
    public static function params($params, $request): bool{
        foreach($params as $param){
            $p = $request[$param] ?? null;
            if($p === null || trim($p) === ''){
                return true;
            }
        }
        return false;
    }

    public static function Status($id, &$response = null): bool{
        $sts = StatusesQuery::create()->find()->toArray();
        if($id < 1 | $id > count($sts)){
            $response = new Response(400, "wrong status id ".json_encode($sts));
            return true;
        }
        
        return false;
    }

    public static function IdNull($id, &$response): bool{
        if($id === null || !is_numeric($id) || $id <= 0){
            $response = new Response(400, "wrong id(int)");
            return true;
        }
        return false;
    }

    public static function TaskById($id, &$response):? Tasks{
        if(self::IdNull($id, $response)){
            return null;
        }

        $task = TasksQuery::create()->findOneById($id);
        if($task === null){
            $response = new Response(400, "task with id = ".$id." not found or incorrect id");
            return null;
        }
        return $task;
    }
}
?>