<?php
//include_once('dbrepo.php');
//include_once('../includes/message.inc.php');
class UserProfileDAO{

    public static function insertUserProfile($user_id,$first_name,$last_name,$address,$contact_number){
        $repo=new DBrepo();
        $query = "
		INSERT INTO user_profile
		(user_id, first_name, last_name, address, contact_number, photo)
		VALUES (TRIM(:user_id),TRIM(:first_name),TRIM(:last_name),TRIM(:address),TRIM(:contact_number),TRIM(:photo));
		";
        $repo->executeWithMsg("Profile details inserted", "unable to insert Profile details",$query, array(
            ':user_id'          => $user_id,
            ':first_name'       => $first_name,
            ':last_name'        => $last_name,
            ':address'          => $address,
            ':contact_number'   => $contact_number,
            ':photo'            =>'person.png',
           ));
    }

    public static function findProfilleById($user_id){
        $repo=new DBrepo();
        $query = "SELECT 
        user_profile.first_name,user_profile.last_name,user_profile.address,user_profile.address,user_profile.contact_number,user_profile.photo,user.user_name,user.user_email,user.user_password FROM user_profile RIGHT JOIN user ON user_profile.user_id=user.user_id
        WHERE user.user_id =:user_id
        ";
        $row=$repo->getSingleResult($query,array(':user_id'	=>	$user_id));
        return $row;
    }

    public static function editProfile($user_id,$first_name,$last_name,$address,$contact_number){
        $repo =new DBRepo();
        $query = "
		UPDATE 
		user_profile SET 
		first_name = TRIM(:first_name),
        last_name = TRIM(:last_name),
        address = TRIM(:address),
        contact_number = TRIM(:contact_number)
		WHERE user_id =:user_id
        ";
        $repo->executeWithMsg("Profile details Edited","Unable To Edit Profile Details",$query,array(
            ':user_id'          => $user_id,
             ':first_name'      =>  $first_name,
             ':last_name'       =>  $last_name,
             ':address'         =>  $address,
             ':contact_number'  =>  $contact_number,
            ));
    }
}
//UserProfileDAO::insertUserProfile(2,'thirupp','chan','jaffna','0778368806');
//print_r(UserProfileDAO::findProfilleById(1));
//UserProfileDAO::editProfile(1,'thiru','paran','jaffna','0778368806');

?>