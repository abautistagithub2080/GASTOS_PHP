<?php
include("../Tls/Tls.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Tls/Tls.js" type="text/javascript"></script>
    <script>
        window.onload = SPLdTblX;
    </script>
</head>
<body bgcolor="#870101">
	<form id="FrmMAIN" name="FrmMAIN" method="post" action="">
        <table id="TblMn" width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
                <td width="5%" valign="top" align="center">
					<a href="../APPS/VerGastos/VerGastos.php" target="iFRM"><img src="../img/Home-I.png" width="35px" height="35px"></a><br>
					<a href="../APPS/Trasaccion/Trasaccion.php" target="iFRM"><img src="../img/Build.png" width="35px" height="35px"></a><br>
					<a href="../APPS/CatGastos/CatGastos.php" target="iFRM"><img src="../img/Docs.png" width="35px" height="35px"></a><br>
					<a href="../APPS/Admon/Admon.php" target="iFRM"><img src="../img/Direc-I.png" width="35px" height="35px"></a><br>
					<a href="../APPS/Out.php"><img src="../img/Foco.png" width="35px" height="35px"></a>
				</td>
				<td width="95%" id="TD1" height="92%" valign="top">
				    <iframe id="iFRM" name="iFRM" src="../APPS/VerGastos/VerGastos.php" frameborder="0" scrolling="auto"></iframe>
				</td>			
			</tr>
        </table>
	</form> 
</body>
</html>
