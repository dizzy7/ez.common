<?php

if(isset($_POST['submit'])){
    if(isset($_POST['phpconsole']) && $_POST['phpconsole']=='Y'){
        COption::SetOptionString('md.common','phpconsole','Y');
    } else {
        COption::SetOptionString('md.common','phpconsole','N');
    }
    LocalRedirect($GLOBALS['APPLICATION']->GetCurPage());
}

?>