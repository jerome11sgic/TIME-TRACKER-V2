<?php

class TaskDAO{

    public static function insertTask($projectId,$taskname,$duration,$description,$date){
        $repo=new DBrepo();
        $query = "INSERT INTO events (project_id,title, duration,description,start,end) 
            VALUES(:project_id,:title, :duration,:description,:start,:end)";
        $param=array(
            ":project_id"=>$projectId,
            ":title"=>$taskname, 
            ":duration"=> $duration,
            ":description"=>$description,
            ":start"=>$date,
            ":end"=>$date);
            return $repo->executeInsertGetLastId($query,$param);
    }

    public static function editTask($id,$column_name,$value){
        $repo=new DBrepo();
        $query = "UPDATE events SET {$column_name}=:value WHERE id=:id";  
        $param=array(":value"=>$value,
                    ":id"=>$id);
        return $repo->executeWitAffectedrows($query,$param);
    }

    public static function deleteTask($id){
        $repo=new DBrepo();
        $query = "DELETE FROM events WHERE id = :id"; 
        $param=array(":id"=>$id);
        return $repo->executeWitAffectedrows($query,$param);
    }
}
?>






