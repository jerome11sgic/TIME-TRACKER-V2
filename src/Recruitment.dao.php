<?php

class RecruitmentDAO{

    public static function insertRecruitment(){

        $query="INSERT INTO user_company
                (user_id, company_id,recruited_date,working_status,work_role,Contract_Period) 
                VALUES
                 (:user_id, :company_name,:recruited_date,:working_status,:work_role,:contract_Period) ";

$param=array(
    ':user_id_company'  => $username,
    ':company_name'  => $usertype,
    ':recruited_date'    => $userid,
    ':working_status'    => $userid,
    ':work_role'    => $userid,
    ':contract_Period'    => $userid,
);
    'Working'
    }
}
?>