<?php


require_once('nusoap.php');
$s = new soap_server;
$s->register('siteInfo');

$s->service($HTTP_RAW_POST_DATA);

function siteInfo($operation){
	// optionally catch an error and return a fault
	if($operation != 'get'){
  		return new soap_fault('Client','','Must supply a valid name.');
    }
	
//	$sitedata = array('sitename'=>'empty', 'sitedescr'=>'none');
	$data = file('sitedata.txt');
	$sitedata = array();
	while (list($index, $value) = each($data))
	{
		$firstspace = strcspn($value,' ,');
		$param = substr($value, 0, $firstspace);
		$paramval = substr($value, $firstspace+1);
		$param = trim($param);
		$paramval = trim($paramval);
		$sitedata[$param] = $paramval;
	}
	return $sitedata;
}

?>