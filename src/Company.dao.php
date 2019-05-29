<?php

class ComapanyDAO{
    public static function insertCompany($companyname,$contactnumber,$email,$address){

    $repo=new DBrepo();
   
    $query = "
		INSERT INTO out_source_company (company_name,contact_number,email,address,company_status)
		VALUES (TRIM(:company_name),TRIM(:contact_number),TRIM(:email),TRIM(:address),:company_status)
		";
    $repo->executeWithMsg("Company details inserted", "unable to insert Company details",$query, array(
     ':company_name'   => $companyname,
     ':contact_number' => $contactnumber,
     ':email'          => $email,
     ':address'        => $address,
     ':company_status' => 'Active',
    ));
    
}

public static function editUserRole($role_id,$role_name){
    $repo=new DBrepo();
    $query = "
    UPDATE user_role set role_name = :role_name
    WHERE role_id = :role_id";

    $repo->executeWithMsg("User Role Edited","Unable to edit user role",$query,array(
        ':role_name'	=>	$role_name,
        ':role_id'		=>	$role_id
    ));
}


public static function findUserRoleById($role_id){
    $repo=new DBrepo();
    $query = "SELECT * FROM user_role WHERE role_id = :role_id";
    $row=$repo->getSingleResult($query,array(':role_id'	=>	$role_id));
    return $row['role_name'];
}



public static function toggleUserRole($prmstatus,$roleId){
    $repo=new DBrepo();
    $status = 'Active';
    if( $prmstatus== 'Active')
    {
        $query="SELECT count(user.user_id) as usercount FROM user 
                INNER JOIN user_role ON user_role.role_id=user.user_type 
                WHERE user_role.role_id=:role_id AND user.user_status='Active'";
        $row=$repo->getSingleResult($query,array(':role_id'	=>	$roleId));
        
        if($row["usercount"]<=0){
            $status = 'Inactive';	
        }
    }
    
    $query = "
    UPDATE user_role 
    SET role_status = :role_status 
    WHERE role_id = :role_id
    ";

    $repo->executeWithMsg("User Role Changed","Unable to Change user role",$query,array(
        ':role_status'	=>	$status,
        ':role_id'		=>	$roleId
    ));	
}
}
?>