<?php
//Cleans data
function cleanData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


//Used for updating query url while still keeping older getValues. You chose which get value to unset.
function updateUrl($name, $value)
{
    $params = $_GET;
    unset($params[$name]);
    $params[$name] = $value;
   // return basename($_SERVER['PHP_SELF']).'?'.http_build_query($params);
    return http_build_query($params);
}

?>