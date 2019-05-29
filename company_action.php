<?php

include_once('includes/message.inc.php');
include_once('src/dbrepo.php');
include_once('src/Company.validation.php');
include_once('src/Company.dao.php');
include_once('src/message.php');


if (isset($_POST['action'])) {
 if ($_POST['action'] == 'ADD') {

  $companyname   = trim($_POST["company_name"]);
  $contactnumber =trim($_POST["contact_number"]);
  $email          = trim($_POST["company_email"]);
  $address       = trim($_POST["address"]);

  $errmsg=new Message('err');
  if(CompanyValidation::existCompanyname($companyname)){
      $errmsg->pushMsg('Company Name Already exist');
  }
  if(CompanyValidation::existEmail($email)){
      $errmsg->pushMsg('Company Email Address Already exist');
  }

  if($errmsg->getMsgCount()>0){
      $errmsg->printJsonMsg();
  }else{
    ComapanyDAO::insertCompany($companyname,$contactnumber,$email,$address);
  }

 }

 
}
