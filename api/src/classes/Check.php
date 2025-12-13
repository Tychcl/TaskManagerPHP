<?php
namespace Classes;

class Check{
    public static function params($params, $request): bool{
        foreach($params as $param){
            $p = $request[$param] ?? null;
            if(!in_array($param, $request) ||
            $p === null ||
            trim($p === '')){
                return false;
            }
        }
        return true;
    }
}
?>