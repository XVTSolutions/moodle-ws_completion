<?php

/// SETUP - NEED TO BE CHANGED
$token = 'todo';
$domainname = 'todo';

/// FUNCTION NAME
$functionname = 'local_ws_completion_get_for_course';

/// PARAMETERS
$courseid = 2;

///// XML-RPC CALL
header('Content-Type: text/plain');
$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
require_once('./curl.php');
$curl = new curl;
$resp = $curl->post($serverurl, array('courseid' => $courseid));
print_r($resp);
