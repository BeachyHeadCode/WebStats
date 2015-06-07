<?php
$filename = 'config.php';
$cache_limiter = session_cache_limiter('public');
if (file_exists($filename)) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/php');
	header('Content-Disposition: attachment; filename='.basename($filename));
	header('Content-Transfer-Encoding: binary');
	header("Expires: $cache_limiter");
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($filename));
	ob_clean();
	flush();
	readfile($filename);
}
unlink($filename)
?>