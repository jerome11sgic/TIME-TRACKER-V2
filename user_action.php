<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//$userEmail="'.$_POST["user_email"].'";
//$urlglobal = "http://localhost/SGIC-Time-Tracker-v1/login.php";
//user_action.php

include_once('includes/message.inc.php');
include_once('src/dbrepo.php');
include_once('src/User.dao.php');
include_once('src/User.service.php');
include_once('src/User.validation.php');
include_once('src/message.php');


        // $username  = "jerobert";
        // $useremail = "jerome11sgic@gmail.com";
        // $hiduseremail = "jerome11sgic@gmai.com";
        // $usertype  = 2;
        // $userid    = 1;
      

        // if($useremail==$hiduseremail){
        //     echo "matched";
        //     UserDAO::editUser($userid,$username,$usertype);
        // }else{
        //     $userpassrnd=UserService::randomPassword();
        //     if(UserDAO::editUserEmail($userid,$useremail,$userpassrnd)){
        //         $successmsg=new Message('success');
        //         $successmsg->pushMsg("Email is Updated :".$lastid);
        //         if(UserService::sendMailNotification($username,$useremail,$userpassrnd,"somurl.html")){
        //             $successmsg->pushMsg("Email send please check");
        //         }else{
        //             $successmsg->pushMsg("Unable to send email");
        //         }
        //         $successmsg->printJsonMsg();
        //     }
        // }

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'ADD') {

        $user_name = trim($_POST["user_name"]);
        $user_email=trim($_POST["user_email"]);
        $user_type=trim($_POST['user_type']);
        $userpassrnd=UserService::randomPassword();
        
        //validation goes here
        $errmsg=new Message('err');
        if(Uservalidation::existUsername($user_name)){
            $errmsg->pushMsg('User Name Already exist');
        }
        if(Uservalidation::existEmail($user_email)){
            $errmsg->pushMsg('User Email Address Already exist');
        }

        if($errmsg->getMsgCount()>0){
            $errmsg->printJsonMsg();
        }else{
       
        $lastid=UserDAO::insertUser($user_email,$user_name,$userpassrnd,$user_type) ;
            if($lastid>0){
                $successmsg=new Message('success');
                $successmsg->pushMsg("New user created with id :".$lastid);
                if(UserService::sendMailNotification($user_name,$user_email,$userpassrnd,"somurl.html")){
                    $successmsg->pushMsg("Email send please check");
                }else{
                    $successmsg->pushMsg("Unable to send email");
                }
                $successmsg->printJsonMsg();
            }else{
                $errmsg->pushMsg('Some thing went wrong :Unable to Add user');
                $errmsg->printJsonMsg();
            }
                
            }
        
    }

    if ($_POST['action'] == 'EDIT') {
        $username  = trim($_POST["user_name"]);
        $useremail = trim($_POST["user_email"]);
        $hiduseremail = trim($_POST["hidden_user_email"]);
        $usertype  = trim($_POST["user_type"]);
        $userid    = trim($_POST["user_id"]);
      
        $successmsg=new Message('success');
        if($useremail!=$hiduseremail){
           
            $userpassrnd=UserService::randomPassword();
            if(UserDAO::editUserEmail($userid,$useremail,$userpassrnd)>0){
                
                $successmsg->pushMsg("Email is Updated :");
                if(UserService::sendMailNotification($username,$useremail,$userpassrnd,"somurl.html")){
                    $successmsg->pushMsg("Email send please check");
                }else{
                    $successmsg->pushMsg("Unable to send email");
                }
                
            }
        }

        if(UserDAO::editUser($userid,$username,$usertype)>0){
            $successmsg->pushMsg("Changes done");
        }

        $successmsg->printJsonMsg();
    }

    if ($_POST['action'] == 'FETCH_SINGLE') {
        $userid=trim($_POST["user_id"]);
        echo json_encode(UserDAO::findUserById($userid)); 
    }
    
    if ($_POST['action'] == 'TOGGLE') {
        UserDAO::toggleUser($_POST['status'],$_POST["user_id"]);
    }
    
}




