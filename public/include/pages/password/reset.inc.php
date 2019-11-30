<?php

// Make sure we are called from index.php
if (!defined('SECURITY')) die('Hacking attempt');

// Process password reset request
if (!$config['csrf']['enabled'] || $config['csrf']['enabled'] && $csrftoken->valid) {
  if ($user->initResetPassword($_POST['username'], $smarty)) {
    $_SESSION['POPUP'][] = array('CONTENT' => 'Please check your mail account to finish your password reset', 'TYPE' => 'success');
  } else {
    $_SESSION['POPUP'][] = array('CONTENT' => htmlentities($user->getError(), ENT_QUOTES), 'TYPE' => 'errormsg');
  }
} else {
  $_SESSION['POPUP'][] = array('CONTENT' => $csrftoken->getErrorWithDescriptionHTML(), 'TYPE' => 'info');
}

// Tempalte specifics, user default template by parent page
$smarty->assign("CONTENT", "../default.tpl");
?>
