<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>wkhtmltopdf-i386</title>
</head>

<body>
<?php
$htmloutput = "uploads/report_test.html";
$pdfoutput = "uploads/report_test_".time().".pdf";	

function get_int_path($fdir, $fname=''){
	$int_path = "";
	$fdir = trim($fdir);
	$fname = trim($fname);

	#base_dir
	$base_dir = dirname($_SERVER['DOCUMENT_ROOT'] . $_SERVER['SCRIPT_NAME']);
	$base_dir = str_replace('//', '/', $base_dir);

	// Windows compatibility, remove drive letter (C:, D:, etc)
	$base_dir = preg_replace('/^([A-Z]):/', '', $base_dir);

	#path
	if( $fname!="" ){
		$int_path = "$base_dir/$fdir/$fname";
	}else{
		$int_path = "$base_dir/$fdir";
	}
	$int_path = str_replace('//', '/', $int_path);
	//$int_path = preg_replace('/\/$/', '', $int_path);

	#return
	return $int_path;
}


#1. Cannot work
$lib_path = 'wkhtmltopdf-i386';
exec($lib_path.' '.$htmloutput.' '.$pdfoutput);

#2. Can work
$lib_path = get_int_path('wkhtmltopdf-i386');
@exec($lib_path.' '.$htmloutput.' '.$pdfoutput);

#3. Can work
$lib_path = '/usr/local/bin/wkhtmltopdf';
exec($lib_path." ".$htmloutput.' '.$pdfoutput);

if( is_file($htmloutput) ){
	echo 'File exist : '.$htmloutput.'<br>';
}else{
	echo 'File not exist : '.$htmloutput.'<br>';
}
if( is_file($pdfoutput) ){
	echo 'File exist : '.$pdfoutput.'<br>';
}else{
	echo 'File not exist : '.$pdfoutput.'<br>';
}
?>
</body>
</html>