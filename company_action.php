<?php

include_once('includes/message.inc.php');
include_once('src/dbrepo.php');
include_once('src/Company.validation.php');
include_once('src/Company.dao.php');
include_once('src/message.php');

if (isset($_POST['action'])) {
 if ($_POST['action'] == 'ADD') {

  $companyname      = trim($_POST["company_name"]);
  $contactnumber    =trim($_POST["contact_number"]);
  $email            = trim($_POST["company_email"]);
  $address          = trim($_POST["address"]);

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

 if ($_POST['action'] == 'EDIT') {
    $company_id    = trim($_POST["company_id"]);
    $companyname   = trim($_POST["company_name"]);
    $contactnumber = trim($_POST["contact_number"]);
    $email         = trim($_POST["company_email"]);
    $address       = trim($_POST["address"]);

    $errmsg=new Message('err');
    if(CompanyValidation::existCompanynameLock($companyname,$company_id)){
        $errmsg->pushMsg('Company Name Already exist');
    }
    if(CompanyValidation::existCompanyEmailLock($email,$company_id)){
        $errmsg->pushMsg('Company Email Address Already exist');
    }
  
    if($errmsg->getMsgCount()>0){
        $errmsg->printJsonMsg();
    }else{
    ComapanyDAO::editCompanyDetails($company_id,$companyname,$contactnumber,$email,$address);
    }
    }   

if ($_POST['action'] == 'FETCH_SINGLE') {
    $company_id=trim($_POST["company_id"]);
    echo json_encode(ComapanyDAO::findCompanyById($company_id)); 
    }

    if ($_POST['action'] == 'TOGGLE') {
        ComapanyDAO::toggleCompany($_POST['status'],$_POST["company_id"]);
    }
}


