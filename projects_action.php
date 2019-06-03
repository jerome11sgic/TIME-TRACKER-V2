<?php
include_once('includes/message.inc.php');
include_once('src/dbrepo.php');
include_once('src/Projects.validation.php');
include_once('src/Projects.dao.php');
include_once('src/message.php');

		// $project_id		= 1;
		// $project_name	= "test project 4";
		// $start_date		= "2019-04-18";
		// $description	= "hjfks";
		// $remarks		="sdsdjh jsavhk";
		
		// $errmsg=new Message('err');
		// if(ProjectsValidation::existProjectnameLock($project_name,$project_id)){
		// 	$errmsg->pushMsg('Project Name Already exist');
		// }
		// if($errmsg->getMsgCount()>0){
		// 	$errmsg->printJsonMsg();
		// }else{
		// ProjectsDAO::editProjects($project_id,$project_name,$start_date,$description,$remarks);
		// }
		// $project_id=1;
		// 	echo json_encode(ProjectsDAO::findProjectById($project_id));
		//ProjectsDAO::toggleProject("In_progress",2);
		if(isset($_POST['action']))
{
	if($_POST['action'] == 'ADD')
	{
		$user_id		= trim($_POST["user_id"]);
		$project_name	= trim($_POST["project_name"]);
		$start_date		= trim($_POST["start_date"]);
		$description	= trim($_POST["description"]);
		$remarks		= trim($_POST["remarks"]);
		
		$errmsg=new Message('err');
		if(ProjectsValidation::existProjectname($project_name)){
			$errmsg->pushMsg('Project Name Already exist');
		}
		if($errmsg->getMsgCount()>0){
			$errmsg->printJsonMsg();
		}else{
		ProjectsDAO:: insertsProjects($user_id,$project_name,$start_date,$description,$remarks);
		}
	}
	
		if ($_POST['action'] == 'FETCH_SINGLE') {
			$project_id=trim($_POST["project_id"]);
			echo json_encode(ProjectsDAO::findProjectById($project_id)); 
			}

	if($_POST['action'] == 'EDIT')
	{
		$project_id		= trim($_POST["project_id"]);
		$project_name	= trim($_POST["project_name"]);
		$start_date		= trim($_POST["start_date"]);
		$description	= trim($_POST["description"]);
		$remarks		= trim($_POST["remarks"]);
		
		$errmsg=new Message('err');
		if(ProjectsValidation::existProjectnameLock($project_name,$project_id)){
			$errmsg->pushMsg('Project Name Already exist');
		}
		if($errmsg->getMsgCount()>0){
			$errmsg->printJsonMsg();
		}else{
		ProjectsDAO::editProjects($project_id,$project_name,$start_date,$description,$remarks);
		}
	}
	if ($_POST['action'] == 'TOGGLE') {
        ProjectsDAO::toggleProject($_POST['status'],$_POST["project_id"]);
    }
}

?>