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

    if(isset($_POST['twig']) && $_POST['twig']=='Y'){
        COption::SetOptionString('md.common','twig','Y');
    } else {
        COption::SetOptionString('md.common','twig','N');
    }

    if(isset($_POST['twig_debug']) && $_POST['twig_debug']=='Y'){
        COption::SetOptionString('md.common','twig.debug','Y');
    } else {
        COption::SetOptionString('md.common','twig.debug','N');
    }

    LocalRedirect($GLOBALS['APPLICATION']->GetCurPage());
}

?>