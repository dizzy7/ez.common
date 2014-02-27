<?php

if(isset($_POST['submit'])){
    if(isset($_POST['phpconsole']) && $_POST['phpconsole']=='Y'){
        COption::SetOptionString('md.common','phpconsole','Y');
    } else {
        COption::SetOptionString('md.common','phpconsole','N');
    }

    if(isset($_POST['phpconsolepass']) && $_POST['phpconsolepass']!=''){
        COption::SetOptionString('md.common','phpconsolepass',$_POST['phpconsolepass']);
    }

    LocalRedirect($GLOBALS['APPLICATION']->GetCurPage());
}

?>