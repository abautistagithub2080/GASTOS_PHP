<?php 
include("../../Tls/Tls.php");
if($_POST)
{
    $nIDUsr=$_POST["cbxUsr"]; 
    if($nIDUsr=="-1")
    {  
    }
	else
	{ 
        $SQL="SELECT * FROM CatUsuario WHERE IDUsr=" . $nIDUsr; 	
        $rsData=FNRS($SQL,$nTotal); 
        if($nTotal>0)
		{
			foreach($rsData as $rs) {
                $WNom=$rs->Nombre; 
                $WPat=$rs->Paterno;
                $WMat=$rs->Materno;
                $WUsr=FNDcHx($rs->Usuario);
                $WPass=FNDcHx($rs->Password);	   				
			}				  
        }
		unset($rsData);	$rs=null;	
    } 
	if($_POST["ESSVE"]=="1")
	{
        $WNom=$_POST["txtNom"]; $WPat=$_POST["txtPat"]; $WMat=$_POST["txtMat"]; $WUsr=FNCdHx($_POST["txtUsr"]); $WPass=FNCdHx($_POST["txtPass"]);
	    if($nIDUsr=="-1") 
		{
            $SQL="INSERT INTO CatUsuario(Nombre,Paterno, Materno, Usuario, Password) VALUES('" . $WNom . "','" . $WPat . "', '" . $WMat . "', '" . $WUsr . "', '" . $WPass . "');";
            SPCMD($SQL,0);
		    $nIDUsr=-1;		
			$WNom=""; 
			$WPat="";
			$WMat="";
			$WUsr="";
			$WPass="";
		}
		else
		{
            $SQL="UPDATE CatUsuario SET Nombre='" . $WNom . "',Paterno='" . $WPat . "', Materno='" . $WMat . "', Usuario='" . $WUsr . "', Password='" . $WPass . "' WHERE IDUsr=" . $nIDUsr;
            SPCMD($SQL,0);		
		    $nIDUsr=-1;			
			$WNom=""; 
			$WPat="";
			$WMat="";
			$WUsr="";
			$WPass="";	    

		}
	} 
	if($_POST["ESDEL"]=="1")
	{
        $SQL="DELETE FROM CatUsuario WHERE IDUsr=" . $nIDUsr; SPCMD($SQL,0);
		$nIDUsr=-1;		
		$WNom=""; 
		$WPat="";
		$WMat="";
		$WUsr="";
		$WPass="";
	} 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <script src="../../jquery/jquery-3.1.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script language="javascript" src="../../Tls/Tls.js"></script>
	<script language="javascript" type="text/javascript">
        function SPSendCBX(){
			gEBI("HD1").value=gEBI("cbxUsr").value;
			gEBI("Frm1").submit();
		}
		function FNSave()
		{
            gEBI("ESSVE").value="1";
            return true;
		}
		function FNDel()
		{
            gEBI("ESDEL").value="1";
            return true;
		}
	</script>
</head>
<body>
    <form id="Frm1" name="Frm1" method="post" action="">
		<div class="container">
            <h2></h2>
            <div class="form-group">
                <label for="sel1">Selecciona un usuario:</label>
                <select id="cbxUsr" name="cbxUsr" class="form-control" onChange="SPSendCBX();">
				    <option value="-1">--Selecciona una opción--</option>
					<?php
						$SQL="SELECT IDUsr, CONCAT(Nombre, ' ', Paterno, ' ', Materno) AS NOM FROM CatUsuario"; 
			            $rsData=FNRS($SQL,$nTotal); 
					    foreach($rsData as $rs)						
						{
					?>     
                        <option value="<?php echo($rs->IDUsr);?>"><?php echo($rs->NOM);?></option>
					<?php   
						}
						unset($rsData);	$rs=null;  								
					?>					
                </select>
				<script language="javascript" type="text/javascript">
                    FNCombo("cbxUsr","<?php echo($nIDUsr); ?>");				
				</script>
			</div>
			<div class="form-group">
				<label for="email">Nombre:</label>
				<input type="text" class="form-control" id="txtNom" name="txtNom" placeholder="Nombre" value="<?php echo($WNom);?>">
			</div>
			<div class="form-group">
				<label for="email">Paterno:</label>
				<input type="text" class="form-control" id="txtPat" name="txtPat" placeholder="Paterno" value="<?php echo($WPat);?>">
			</div>
			<div class="form-group">
				<label for="email">Materno:</label>
                <input type="text" class="form-control" id="txtMat" name="txtMat" placeholder="Materno" value="<?php echo($WMat);?>"> 
            </div>
			<div class="form-group">
				<label for="email">Usuario:</label>
				<input type="text" class="form-control" id="txtUsr" name="txtUsr" placeholder="Usuario" value="<?php echo($WUsr);?>">
			</div>
            <div class="form-group">
				<label for="email">Contraseña:</label>
                <input type="text" class="form-control" id="txtPass" name="txtPass" placeholder="Contraseña" value="<?php echo($WPass);?>">
			</div>
			<button type="submit" id="btnSve" name="btnSve" class="btn btn-default" onClick="return FNSave();">Guardar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button type="submit" id="btnDel" name="btnDel" class="btn btn-default" onClick="return FNDel();">Borrar</button>	   
		</div> 
		<input type="hidden" id="HD1" name="HD1" value="0">    
        <input type="hidden" id="ESSVE" name="ESSVE" value="0">  
        <input type="hidden" id="ESDEL" name="ESDEL" value="0">
    </form>
</body>
</html>
