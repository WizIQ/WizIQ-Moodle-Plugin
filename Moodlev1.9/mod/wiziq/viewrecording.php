<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css" media="screen">

html, body {
position: absolute;
height: 100%;
max-height: 100%;
width: 100%;
margin: 0;
padding: 0;
}
iframe {
position: absolute;
height: 100%;
width: 100%;
border: none;
}
container {
position: absolute;
top: 50px; /* Change with Height of #header */
bottom: 0;
width: 100%;
overflow: hidden ;
}
header {
position: absolute;
top: 0px;
height: 50px; /* Change with top of #container */
color: #eee;
background-color: #ccc;
width: 100%;
}
</style>

</head>

<body>

<?php
require_once("../../config.php");
 require_once("lib.php");
 include("paging.php");
 require_once($CFG->dirroot .'/course/lib.php');
 require_once($CFG->dirroot .'/lib/blocklib.php');
require_once($CFG->dirroot.'/calendar/lib.php');
require_once ($CFG->dirroot.'/lib/moodlelib.php');
require_once("wiziqconf.php");
function decrypt($string, $key) {
$result = '';
$string = base64_decode($string);

for($i=0; $i<strlen($string); $i++) {
$char = substr($string, $i, 1);
$keychar = substr($key, ($i % strlen($key))-1, 1);
$char = chr(ord($char)-ord($keychar));
$result.=$char;
}

return $result;
}
$code=$_REQUEST['s'];
$sessioncode=decrypt($code,"Auth@Moo(*)");

$SessionCodeArray=$_SESSION['SessionCode'];
//print_r($SessionCodeArray);
foreach($SessionCodeArray as $code1)
		  {
			 
			  if($code1==$sessioncode)
			  {
$query="select * from ".$CFG->prefix."wiziq where insescod=".$sessioncode;
			  break;
			  }
		  }
		  
		  
$result=mysql_query($query);
$r=mysql_fetch_array($result);
$recordingurl=$r['recordingurl'];

?>
<!---->


<div id="container">
<iframe id="ifrmDownload" width="100%" height="100%" frameborder="1" scrolling="no" style="font-family:Arial; font-size:12px; color:444"  src="<?php echo $recordingurl; ?>" ></iframe> 
</div>
</body>
</html>