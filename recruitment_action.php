<?php  
include_once('includes/message.inc.php');
include_once('src/dbrepo.php');
include_once('src/Recruitment.dao.php');

include_once('src/message.php');

 if(isset($_POST["action"]))  
 {  
       
    
      if($_POST["action"] =="ADD")  
      {  
          $user_id= trim($_POST["user_id"]);  
          $company_name = trim($_POST["company_name"]);
          $recruited_date = trim($_POST["recruited_date"]);
          $work_role = trim($_POST["work_role"]);
          $contract_Period = trim($_POST["Contract_Period"]); 
           
          RecruitmentDAO::insertRecruitment($userid,$company_name,$recruited_date,$work_role,$contract_Period);
            
           
      }  
      if($_POST["action"] == "EDIT")  
      {  
          $company_name = trim($_POST["company_name"]);
          $recruited_date =trim($_POST["recruited_date"]);
          $work_role =trim($_POST["work_role"]);
          $Contract_Period =trim($_POST["Contract_Period"]);
           
               
           
      }  
      
      if($_POST["action"] == "DELETE")  
      {  
     
      }  

     if($_POST["action"] == "TERMINATE")  {
      
     }
 }  
 ?>  