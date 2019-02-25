<?php
//functions.php
function js_back($msg){
	echo('<script language="javascript">
	alert("'.$msg.'");
	history.back();
	</script>');
	exit();
}
function js_go($msg,$url){
	echo('<script language="javascript">
alert("'.$msg.'");
location.href="'.$url.'";
</script>');
}
function checkPost($data)
{ 
      if(!get_magic_quotes_gpc()) {
		return addslashes($data);
	} 
     else {
		return $data;
	}
}

?>