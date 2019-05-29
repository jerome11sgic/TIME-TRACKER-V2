<?php

class CompanyValidation{

    public static function existCompanyname($companyname){
        $repo=new DBrepo();
        return $repo->ifexists("out_source_company","company_name",$companyname);
    }

    public static function existEmail($email){
        $repo=new DBrepo();
        return $repo->ifexists("out_source_company","email",$email);
    }
}

?>