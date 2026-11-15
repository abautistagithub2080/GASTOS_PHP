<?php
$past = time() - 3600;
foreach ($_COOKIE as $key => $value ) setcookie( $key, $value, $past, '/' );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>
<body>
    <script language="javascript" type="text/javascript">
		location = "../Acc/Acc.php";
	</script>
</body>
</html>
