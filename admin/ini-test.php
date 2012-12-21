<?php 
@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', true );
@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'define_syslog_variables', true );
@ini_set ( 'variables_order', 'EGPCS' );

phpinfo(); ?>