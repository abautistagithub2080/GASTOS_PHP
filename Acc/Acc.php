<?php 
include("../Tls/Tls.php");
if($_POST)
{
    $WUsr=FNCdHx($_POST['email']); $WPas=FNCdHx($_POST['txtPass']);
	$RSA=FNRS("CALL spGetUsuario('$WUsr','$WPas')",$nTotal); 
    if($nTotal>0)
    {  
        foreach($RSA as $rs) $IDUsr = $rs->IDUsr;
        setcookie("IDUsr", $IDUsr, time() + (86400 * 30), "/");
    ?>
		<script language="javascript" type="text/javascript">
			location = "../ROT/Rot.php?IDUsr=<?php echo($IDUsr);?>";
		</script>
    <?php  
    }    
	else
	{
       echo("Lo siento, no tienes Acceso...");
	}
    unset($RSA); $RSA=null; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../jquery/jquery-3.1.1.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Bienvenidos</h2>
  <form id="FrmAcc" name="FrmAcc" method="post">
    <div class="form-group">
      <label for="email">Usuario:</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Usuario">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="txtPass" name="txtPass" placeholder="Password">
    </div>
	<button type="submit" id="btn1" name="btn1" class="btn btn-default">Accesar</button>
  </form>
</div>
</body>
</html>