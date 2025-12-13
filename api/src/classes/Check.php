<?php
namespace Classes;

class Check{
    public static function params($params, $request): bool{
        $r = true;
        foreach($params as $param){
            if(!in_array($param, $request)){
                $r = false;
            }
        }
        return $r;
    }
}
?>