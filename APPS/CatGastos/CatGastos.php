<?php 
include("../../Tls/Tls.php");
if($_POST)
{
    $nIDGas=$_POST["cbxGas"]; 
    if($nIDGas=="-1")
    {  
    }
	else
	{ 
		$SQL="SELECT * FROM CatGastos WHERE IDGastos=" . $nIDGas; 	
		$RSA=FNRS($SQL,$nTotal); 	
		if($nTotal>0)
		{		   
			foreach($RSA as $rs) { 
				$WGas=$rs->Gastos;  						
			}				
        }
        unset($RSA); $RSA=null;
    } 
	if($_POST["ESSVE"]=="1")
	{
        $WGas=$_POST["txtGas"]; 
	    if($nIDGas=="-1") 
		{
            $SQL="INSERT INTO CatGastos(Gastos) VALUES('" . $WGas . "');";
            SPCMD($SQL,0);		
            $WGas=""; $nIDGas=="-1";
		}
		else
		{
            $SQL="UPDATE CatGastos SET Gastos='" . $WGas . "' WHERE IDGastos=" . $nIDGas;
            SPCMD($SQL,0);		
            $WGas=""; $nIDGas=="-1";
        }
	} 
	if($_POST["ESDEL"]=="1")
	{
        $SQL="DELETE FROM CatGastos WHERE IDGastos=" . $nIDGas; SPCMD($SQL,0); $WGas=""; $nIDGas=="-1";
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
			gEBI("HD1").value=gEBI("cbxGas").value;
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
                <label for="sel1">Selecciona un Gasto:</label>
                <select id="cbxGas" name="cbxGas" class="form-control" onChange="SPSendCBX();">
				    <option value="-1">--Selecciona una opcion--</option>
					<?php
						$SQL="SELECT IDGastos, Gastos FROM CatGastos";  
			            $rsData=FNRS($SQL,$nTotal); 
					    foreach($rsData as $rs)
					    {
					?>     
                        <option value="<?php echo($rs->IDGastos);?>"><?php echo($rs->Gastos);?></option>
					<?php   
						}
                        unset($rsData);	$rs=null;							
					?>					
                </select>
				<script language="javascript" type="text/javascript">
                    FNCombo("cbxGas","<?php echo($nIDGas); ?>");				
				</script>
			</div>
			<div class="form-group">
				<label for="Gasto">Nombre Gasto:</label>
				<input type="text" class="form-control" id="txtGas" name="txtGas" placeholder="Gasto" value="<?php echo($WGas);?>">
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