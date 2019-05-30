<?php

include_once('includes/message.inc.php');
include_once('src/dbrepo.php');
include_once( 'src/Task.dao.php');
include_once( 'src/Time.dao.php');

if(isset($_POST["action"]))  
 {  
       
  if($_POST["action"] =="LOAD"){
    $userid=$_POST['userid'];
    $date=$_POST['date'];
    $res=TimeDAO::getTimeinAndTimeOut($userid,$date);
    echo json_encode($res);
  }
    if($_POST["action"] =="ADD")  
      { 
        $projectId=$_POST["project"];
        $taskname=$_POST["taskname"];
        $duration=$_POST["duration"];
        $description=$_POST["description"];
        $date=$_POST["date"];

        if(TaskDAO::insertTask($projectId,$taskname,$duration,$description,$date)>0){
            writeJsonMsg('Task Added Succesfully','success');
        }else{
            writeJsonMsg('Failed to Add Task','err');
        }
      }

      if($_POST["action"] =="EDIT")  
      { 
        $id = $_POST["id"];  
        $value = $_POST["text"];  
        $column_name = $_POST["column_name"]; 

        if(TaskDAO::editTask($id,$column_name,$value)>0){
            writeJsonMsg('Task Edited Succesfully','success');
        }else{
            writeJsonMsg('Failed to Edit Task','err');
        }
      }

      if($_POST["action"] =="DELETE")  
      { 
       $id= $_POST["id"];
        if(TaskDAO::deleteTask($id)>0){
            writeJsonMsg('Task Deleted Succesfully','success');
        }else{
            writeJsonMsg('Failed to Delete Task','err');
        }
      }

}
?>