<?php

require_once("../../config.php");
function paging_1($sql,$vary="record",$width="575")
{

	global $limit,$offset,$currenttotal,$showed,$last,$align;
	

$showed=$_REQUEST['offset']+$limit;
$last=$_REQUEST['offset']-$limit;

if(empty($_REQUEST['offset']))
	$_REQUEST['offset']=0;


$recordset1=mysql_query($sql) or die("Couldn't count total");
$currenttotal=mysql_num_rows($recordset1);

	$pages=$currenttotal%$limit;
	if($pages==0)
		$pages=$currenttotal/$limit;
	else
	{
		$pages=$currenttotal/$limit;
		$pages=(int)$pages+1;
	}		
	for($i=1;$i<=$pages;$i++)
	{
		$pageoff=($i-1)*$limit;
		if($showed==($i*$limit))
			break;
	}
			
if($currenttotal>1)$vary.="s";
//echo $width;
//$display="<table width='$width' align='center' border=0><tr><td align='left'><!--Total <b>$currenttotal</b> $vary.</td><td align='center' width='50%'>Displaying Page <b>$i</b> of <b>$pages</b>. ($limit results per page)--></td></tr></table>";	

if($currenttotal>0)
	echo @$display;

 $sql.="  Limit ".$_REQUEST['offset'].",$limit  ";

return $sql;

}


function paging_2($str,$width,$strcreate)
{
	global $currenttotal,$limit,$offset,$showed,$last,$PHP_SELF,$align;

if($currenttotal>0)
{
#### PAGING STARTS
print "<table  width='$width' cellpadding='2' cellspacing='0' align='right'>";
	print "<tr>";
		#---------------------------------------

		print "<td width='30%' valign='top' align='right'>";

		if($_REQUEST['offset']>=$limit)
		print "<a href='$PHP_SELF?offset=$last&currenttotal=$currenttotal&q=".$strcreate."' class='pagingtextlink'>Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;";
		//print "</td>";
		#---------------------------------------
//		echo "jaijai".$align;
		if(isset($align))
		{
			//print "<td align='center' class='bodytext'>
			print "<span class='astro'>Pic:</span>&nbsp;&nbsp; ";
		}
		else
		{
			//print "<td align='center' class='text'>
			print "<span class='gottopage' style='font-size:12px'>Page:</span>&nbsp;&nbsp; ";
		}

			$pages=$currenttotal%$limit;
			if($pages==0)
				$pages=$currenttotal/$limit;
			else
			{
				$pages=$currenttotal/$limit;
				$pages=(int)$pages+1;
			}		

			$m="0";
			for($i=1;$i<=$pages;$i++)
			{
				$pageoff=($i-1)*$limit;
				if($showed==($i*$limit))
				{
					print "<span class'pagingtext' style='font-size:12px'>$i </span>&nbsp;";
				}
				else
				{
					print "<a href='$PHP_SELF?offset=$pageoff&currenttotal=$currenttotal&q=".$strcreate."' style='font-size:12px' class='pagingtextlink'>$i</a>&nbsp;";
				}
				if($m=="29")
				{
					$m="0";
					print "<br>";
					
					//echo "m=".$m;
				}
				$m++;
			}
			//print "</td>";
				#---------------------------------------
		print "&nbsp;&nbsp;&nbsp;&nbsp;<a href='$PHP_SELF?offset=$showed&currenttotal=$currenttotal&q=".$strcreate."' class='pagingtextlink' style='font-size:12px'>";
				if($showed<$currenttotal)
				print "Next</a>";

		print "</td>";
				#---------------------------------------

	print "</tr>";


	print "</table><br>";
#### PAGING ENDS
}

}




?>
