<?php

if(isset($_POST['submit'])){
    if(isset($_POST['phpconsole']) && $_POST['phpconsole']=='Y'){
        COption::SetOptionString('ez.common','phpconsole','Y');
    } else {
        COption::SetOptionString('ez.common','phpconsole','N');
    }

    if(isset($_POST['phpconsolepass']) && $_POST['phpconsolepass']!=''){
        COption::SetOptionString('ez.common','phpconsolepass',$_POST['phpconsolepass']);
    }

    if(isset($_POST['twig']) && $_POST['twig']=='Y'){
        COption::SetOptionString('ez.common','twig','Y');
    } else {
        COption::SetOptionString('ez.common','twig','N');
    }

    if(isset($_POST['twig_debug']) && $_POST['twig_debug']=='Y'){
        COption::SetOptionString('ez.common','twig.debug','Y');
    } else {
        COption::SetOptionString('ez.common','twig.debug','N');
    }

    if(isset($_POST['mailcatch']) && $_POST['mailcatch']=='Y'){
        COption::SetOptionString('ez.common','mailcatch','Y');
    } else {
        COption::SetOptionString('ez.common','mailcatch','N');
    }

    LocalRedirect($GLOBALS['APPLICATION']->GetCurPage());
}

?>