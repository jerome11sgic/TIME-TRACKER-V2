<?php

include_once('dbrepo.php');
class RecruitmentDAO{

    public static function insertRecruitment($userid,$company_name,$recruited_date,$work_role,$contract_Period){

        $repo=new DBrepo();
        $query="INSERT INTO user_company
                (user_id, company_id,recruited_date,working_status,work_role,Contract_Period) 
                VALUES
                 (:user_id, :company_name,:recruited_date,:working_status,:work_role,:contract_Period) ";

        $param=array(
            ':user_id'  => $userid,
            ':company_name'  => $company_name,
            ':recruited_date'    => $recruited_date,
            ':working_status'    => 'Working',
            ':work_role'    => $work_role,
            ':contract_Period'    => $contract_Period
        );

        return $repo->executeInsertGetLastId($query,$param);

    }

    public static function updateRecruitment($id,$company_id,$recruited_date,$work_role,$contract_Period){
        $repo=new DBrepo();
        $query="UPDATE user_company SET 
                company_id = :company_id, 
                recruited_date = :recruited_date,
                work_role = :work_role,
                Contract_Period = :contract_Period
        WHERE id = :id";

        $param=array(
            ':id'  => $id,
            ':company_id'  => $company_id,
            ':recruited_date'    => $recruited_date,
            ':work_role'    => $work_role,
            ':contract_Period'    => $contract_Period
        );

        return $repo->executeWitAffectedrows($query,$param);
    }

    public static function deleteRecruitment($recruitId){
        $repo=new DBrepo();
        $query="DELETE FROM user_company WHERE id = :recruitId";  
        $param=array(
            ':recruitId'  => $recruitId,
            
        );
        return $repo->executeWitAffectedrows($query,$param);
    }

    public static function makeTermination(){
        $repo=new DBrepo();
        // "INSERT INTO `termination` (`user_company_id`, `date_of_termination`) VALUES ('{$recruitId}', '{$dot}')"
        // "UPDATE `user_company` SET `working_status` = 'Not_working' WHERE `user_company`.`user_company_id` = {$recruitId} "

        // $queries=array(
        // "UPDATE `user_company` SET `working_status` = 'Not_working' WHERE `user_company`.`id` = 1 ",
        // "INSERT INTO `termination` (`user_company_id`, `date_of_termination`) VALUES ('1', '2019-10-11')");
        
        $repo->executeWithTransaction();

    }
}

//RecruitmentDAO::insertRecruitment("1","1","2019-12-9","se","6");
//echo RecruitmentDAO::updateRecruitment("1","3","2019-6-19","qa","9");
//echo RecruitmentDAO::deleteRecruitment(1);
echo RecruitmentDAO::makeTermination();
?>