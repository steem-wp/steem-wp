<?php

  function validateAccount($account) {

    //if exist
    if (!$account) return false;

    // check length
    if (strlen($account) < 3 || strlen($account) > 16) return false;

    $ref = explode(".", $str);
    $len = strlen($ref);
    
    for ($i = 0;  $i < $len; $i++) {
      $label = $ref[$i];

      if (!preg_match("/^[a-z]", $label)) return false;
      if (!preg_match("^[a-z0-9-]*\$", $label)) return false;
      if (preg_match("/--/", $label)) return false;
      if (!preg_match("[a-z0-9]\$", $label)) return false;
      if (!strlen($label) >= 3) return false;

    }

    return $account;

  };

?>