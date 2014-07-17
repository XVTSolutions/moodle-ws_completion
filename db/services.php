<?php

// We defined the web service functions to install.
$functions = array(
        'local_ws_completion_get_for_course' => array(
                'classname'   => 'local_ws_completion_external',
                'methodname'  => 'get_for_course',
                'classpath'   => 'local/ws_completion/externallib.php',
                'description' => 'Returns the completion status for all users enrolled in a course',
                'type'        => 'read',
        )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'Web service completion' => array(
                'functions' => array ('local_ws_completion_get_for_course'),
                'restrictedusers' => 0,
                'enabled'=>1,
        )
);
