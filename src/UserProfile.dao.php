<?php

class UserProfile{

    public static function insertUserProfile(){
        $query = "
		INSERT INTO user_profile
		(user_id, first_name, last_name, address, contact_number, photo)
		VALUES (TRIM(:user_id),TRIM('#####'),TRIM('#####'),TRIM('#####'),TRIM('####'),TRIM('person.png'));
		";
                        $statement = $connect->prepare($query);
                        $statement->execute(
                            array(
                                ':user_id' => $connect->lastInsertId(),

                            )
                            );
    }
}
?>