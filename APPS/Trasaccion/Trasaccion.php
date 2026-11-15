<?php 
include("../../Tls/Tls.php");
$nIDGas=$_GET['nIDGas']; 
if($nIDGas=="")	$nIDGas=-1;
if(!$_POST)
{
	$SQL="SELECT * FROM TTransaccion WHERE IDGas=" . $nIDGas; 
	$rsData=FNRS($SQL,$nTotal); 
	if($nTotal>0)
	{
	 
		foreach($rsData as $rs)
		{  	  
		    $WGas = $rs->Gasto; 
		    $nIDGastos=$rs->IDGastos;
		    $dFecha=$rs->Fecha;
		    $aFecha = explode("-", $dFecha);
		    $nYear=$aFecha[0]; 
		    $nMes=$aFecha[1]; 
		    $nDia= substr($aFecha[2],0,2); $EsGasEsp=$rs->GastoEsp; 					
		}
	}
	else
	{
        $dFecha = FNDate(); 
		$aFecha = explode("/", $dFecha);
        $nYear = $aFecha[2]; $nMes = $aFecha[1]; $nDia = $aFecha[0]; 
		unset($aFecha); $aFecha=null;
	}
    unset($rsData); $rsData=null;
}
if($_POST)
{
    if($nIDGas=="-1")
    {  
    }
	else
	{ 
        $SQL="SELECT * FROM TTransaccion WHERE IDGas=" . $nIDGas; 
        $rsData=FNRS($SQL,$nTotal); 
        if($nTotal>0)
		{  
            foreach($rsData as $rs) $WGas = $rs->Gasto;
        }
        unset($rsData); $rsData=null;
    } 
	if($_POST["ESSVE"]=="1")
	{
        $nDia=$_POST["cbxDia"];
	    $nMes=$_POST["cbxMes"];
	    $nYear=$_POST["cbxYear"];	
		
		$nHora=$_POST["HDHora"];
		$nMin=$_POST["HDMin"];
		$nSec=$_POST["HDSec"];        
        $EsGasEsp=$_POST["cbxGasEsp"]; 
							
        $nIDGasto = $_POST["cbxGas"];
        $WGas=$_POST["txtGas"]; 
        $dFecha = $nYear . "-" . $nMes . "-" . $nDia . " " . $nHora . ":" . $nMin . ":" .  $nSec;		
	    if($nIDGas=="-1") 
		{	
            $SProc="CALL spInsertGasto('$dFecha','$nIDGasto','$WGas','$EsGasEsp')"; SPCMD($SProc,0);		
            $WGas=""; $nIDGas=="-1";
            header('Location: ../VerGastos/VerGastos.php');
            exit;			
		}
		else
		{
            $SQL="UPDATE TTransaccion SET Gasto='" . $WGas . "', Fecha='" . $dFecha . "', IDGastos=" . $nIDGasto . ", GastoEsp=" . $EsGasEsp . " WHERE IDGas=" . $nIDGas;		
            SPCMD($SQL,0);		
            $WGas=""; $nIDGas=="-1";
            header('Location: ../VerGastos/VerGastos.php');
            exit;			
        }
	} 
	if($_POST["ESDEL"]=="1")
	{
        $SQL="DELETE FROM CatGastos WHERE IDGas=" . $nIDGas; SPCMD($SQL,0); $WGas=""; $nIDGas=="-1";
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
			gEBI("HD1").value=gEBI("cbxTrans").value;
			gEBI("Frm1").submit();
		}
		function FNSave()
		{
            var d = new Date();
            gEBI("HDHora").value=d.getHours();
            gEBI("HDMin").value=d.getMinutes();
            gEBI("HDSec").value=d.getSeconds();			
            gEBI("ESSVE").value="1";
			
            if (!FNFrcWrt("cbxGas", "Favor de seleccionar un concepto de Gasto", "cbxGas")) return false;
            if (!FNFrcWrt("txtGas", "Favor de escribir una cantidad para tu gasto", "txtGas")) return false;
            if (!FNFrcWrtONLYBlanc("cbxGas", "Favor de seleccionar el tipo gasto", "cbxGas")) return false;
            if (!FNFrcWrt("cbxDia", "Favor de seleccionar un Día", "cbxDia")) return false;
            if (!FNFrcWrt("cbxMes", "Favor de seleccionar un Mes", "cbxMes")) return false;
            if (!FNFrcWrt("cbxYear", "Favor de seleccionar un Mes", "cbxYear")) return false;			
			
			
            return true;
		}
	</script>
</head>
<body>
    <form id="Frm1" name="Frm1" method="post" action="">
		<div class="container">
            <h2></h2>						
            <div class="form-group">
                <label for="sel1">Selecciona un Concepto:</label>
                <select id="cbxGas" name="cbxGas" class="form-control">
				    <option value="-1">--Selecciona una opcion--</option>
					<?php
						$SQL="SELECT IDGastos, Gastos FROM CatGastos"; $rsData=FNRS($SQL,$nTotal); 
					    foreach($rsData as $rs)
					    {
					?>     
                        <option value="<?php echo($rs->IDGastos);?>"><?php echo($rs->Gastos);?></option>
					<?php   
						}
						unset($rsData); $rs=null;								
					?>					
                </select>
				<script language="javascript" type="text/javascript">
                    FNCombo("cbxGas","<?php echo($nIDGastos); ?>");				
				</script>
			</div>
			
            <div class="form-group">
				<label for="Fecha">Fecha:</label>
                <select id="cbxDia" name="cbxDia" class="form-control">
				    <option value="-1">--Selecciona el Día--</option>
					<?php
					for($K=1;$K<=31;$K++)
					{
					?>
						<option value="<?php echo(substr("00".$K,-2)); ?>"><?php echo(substr("00".$K,-2)); ?></option>
					<?php
					}
					?>													
				</select>
				<script language="javascript" type="text/javascript">
                    FNCombo("cbxDia",'<?php echo($nDia); ?>');				
				</script>				
				<br>
                <select id="cbxMes" name="cbxMes" class="form-control">
				    <option value="-1">--Selecciona el Mes--</option>
					<?php
					for($K=1;$K<=12;$K++)
					{
					?>
						<option value="<?php echo(substr("00".$K,-2)); ?>"><?php echo(FNDVMes($K)); ?></option>
					<?php
					}
					?>		
				</select>
				<script language="javascript" type="text/javascript">
                    FNCombo("cbxMes",'<?php echo($nMes); ?>');				
				</script>				
				<br>
                <select id="cbxYear" name="cbxYear" class="form-control">
				    <option value="-1">--Selecciona el Año--</option>
					<?php
					for($K=2018;$K<=2025;$K++)
					{
					?>
						<option value="<?php echo($K); ?>"><?php echo($K); ?></option>
					<?php
					}
					?>
				</select>
				<script language="javascript" type="text/javascript">
                    FNCombo("cbxYear",'<?php echo($nYear); ?>');				
				</script>							
			</div>			
			

            <div class="form-group">
				<label for="GastoEsp">Gasto Especial</label>
                <select id="cbxGasEsp" name="cbxGasEsp" class="form-control">
				    <option value="0">Normal</option>
				    <option value="1">Especial</option>						
                </select>
				<script language="javascript" type="text/javascript">
                    FNCombo("cbxGasEsp",'<?php echo($EsGasEsp); ?>');				
				</script>				
				
			</div>			
			
            <div class="form-group">
				<label for="Gasto">Gasto $</label>
				<input type="text" class="form-control" id="txtGas" name="txtGas" placeholder="Gasto" value="<?php echo($WGas);?>">
			</div>
			<button type="submit" id="btnSve" name="btnSve" class="btn btn-default" onClick="return FNSave();">Guardar</button>
		</div> 
		<input type="hidden" id="HD1" name="HD1" value="<?php echo($nIDGas); ?>>">    
        <input type="hidden" id="ESSVE" name="ESSVE" value="0">  
        <input type="hidden" id="ESDEL" name="ESDEL" value="0">
        <input type="hidden" id="HDHora" name="HDHora" value="0">		
        <input type="hidden" id="HDMin" name="HDMin" value="0">		
        <input type="hidden" id="HDSec" name="HDSec" value="0">				
    </form>
</body>
</html>