<?php
include("../../Tls/Tls.php");
function DevTotal($EsAct, $dFechaX1, $dFechaX2, $EsGasEspX)
{
	$dFecha = FNDate(); 
	$aFecha = explode("/", $dFecha);
	$nYear = $aFecha[2]; $nMes = $aFecha[1]; $nDia = $aFecha[0]; 
	$dFecha1 = $nYear . "-" . $nMes . "-" . $nDia; $dFecha2 = $nYear . "-" . $nMes . "-" . $nDia;
	
	$EsGasEsp = $EsGasEspX;
    if($EsAct==1){
        $dFecha1 = $dFechaX1; $dFecha2 = $dFechaX2;	
	}
    $WCond = ($EsGasEsp==-1) ? "" : " AND GastoEsp=" . $EsGasEsp;
    $SQL="SELECT SUM(A.Gasto) AS Total FROM TTransaccion A INNER JOIN CatGastos B ON A.IDGastos=B.IDGastos WHERE Fecha BETWEEN '{$dFecha1} 00:00:00' AND '{$dFecha2} 23:59:59' {$WCond};"; 		
    $rsData=FNRS($SQL,$nTotal); 	
	if($nTotal>0)
	{  
        foreach($rsData as $rs) $nTotal = $rs->Total;	
	}
    unset($rsData); $rsData=null;
	return $nTotal;
}
function FNSem()
{
    $dFecha = FNDate(); $aFecha = explode("/", $dFecha); $nYear = $aFecha[2]; $nMes = $aFecha[1]; $nDia = $aFecha[0]; 	 
	$semana = date('W',  mktime(0,0,0,$nMes,$nDia,$nYear));
	return $semana;
}
$EsAct=0;
if($_POST)
{
    $nIDGas = $_GET['IDGas']; 
    if($nIDGas=="")
	{
	    $EsAct=1;  
	}	
	$IDDelGas = $_GET['IDDelGas'];
    if($IDDelGas!="")
	{
        $SQL="DELETE FROM TTransaccion WHERE IDGas=" . $IDDelGas; SPCMD($SQL,0); 
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <script src="../../jquery/jquery-3.1.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="../../Tls/TableResp.css">
    <link rel="stylesheet" type="text/css" href="../../Tls/Tls.css">	
    <script language="javascript" src="../../Tls/Tls.js"></script>	
	<script language="javascript" type="text/javascript">
		function fnDel(nIDel)
		{
			if (confirm("¿Desea eliminar este regstro?"))
			{
				FNSnd('VerGastos.php?IDDelGas='+nIDel);
			}
			else
			{
				return;
			}
		}
		function fnMod(nID)
		{
			SPShowPag("../Trasaccion/Trasaccion.php?nIDGas="+nID);
		}
	</script>
</head>
<body style="background-color:#870101">
    <form id="form1" method="post" action="">		
        <table id="tbSem" border="1" width="100%">
		    <tr>
			    <td width="20%"><div id="Sem" class="Fuente2">Semana:</div></td>
				<td width="80%"><div id="Sem2" class="Fuente2">&nbsp;<?php echo(FNSem()); ?></div></td>
			</tr>
		</table>
		
        <table id="tblCbxTipoGasto" border="1" width="100%">
		    <tr>
			    <td width="20%"><div id="Sem" class="Fuente2">Tipo Gasto:</div></td>
				<td width="80%">
					<select id="cbxGasEsp" name="cbxGasEsp" class="form-control">
                        <option value="0">Normal</option>
                        <option value="1">Especiales</option>
                        <option value="-1">Todos</option>						
					</select>				
				</td>
			</tr>
		</table>		
           <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="sm">Día</label>
                <div class="col-sm-3">
					<select id="cbxDia1" name="cbxDia1" class="form-control">
						<option value="-1">--Selecciona el Día--</option>
						<?php
						for($K=1;$K<=31;$K++)
						{
						?>
						<option value="<?php echo(substr($K,-2)); ?>"><?php echo(substr("00".$K,-2)); ?></option>
						  <?php
						}
						?>													
					</select>
					<script language="javascript" type="text/javascript">
					    var d = new Date();
                        FNCombo("cbxDia1",d.getDate());				
					</script>	
                </div>
                <label class="col-sm-1 control-label" for="sm">Mes</label>
                <div class="col-sm-3">
					<select id="cbxMes1" name="cbxMes1" class="form-control">
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
					    var d = new Date();
                        FNCombo("cbxMes1",d.getMonth()+1);				
					</script>
                </div>
                <label class="col-sm-1 control-label" for="sm">Año</label>
                <div class="col-sm-3">
					<select id="cbxYear1" name="cbxYear1" class="form-control">
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
                        var d = new Date();
                        FNCombo("cbxYear1",d.getFullYear());				
					</script>	
                </div>
            </div>
 

           <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="sm">Día</label>
                <div class="col-sm-3">
					<select id="cbxDia2" name="cbxDia2" class="form-control">
						<option value="-1">--Selecciona el Día--</option>
						<?php
						for($K=1;$K<=31;$K++)
						{
						?>
						<option value="<?php echo(substr($K,-2)); ?>"><?php echo(substr("00".$K,-2)); ?></option>
						  <?php
						}
						?>													
					</select>
					<script language="javascript" type="text/javascript">
					    var d = new Date();					
					    FNCombo("cbxDia2",d.getDate());				
					</script>
                </div>
                <label class="col-sm-1 control-label" for="sm">Mes</label>
                <div class="col-sm-3">
					<select id="cbxMes2" name="cbxMes2" class="form-control">
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
					    var d = new Date();					
                        FNCombo("cbxMes2",d.getMonth()+1);				
					</script>	
                </div>
                <label class="col-sm-1 control-label" for="sm">Año</label>
                <div class="col-sm-3">
					<select id="cbxYear2" name="cbxYear2" class="form-control">
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
					    var d = new Date();					
					    FNCombo("cbxYear2",d.getFullYear());				
					</script>	
                </div>
            </div>
		<center>
            <input type="submit" id="btnAct" name="btnAct" value="Actualizar" class="btnIndexIn" onMouseOut="InOut(this.id,'btnIndexIn')" onMouseOver="InOut(this.id,'btnIndexOut')">	
        </center>
     	<table class="width200">
			<thead>
			<tr>
				<th>Fecha</th>
				<th>Concepto</th>				
				<th>Gasto</th>
				<th>Editar</th>
				<th>Eliminar</th>							
			</tr>
			</thead>
			<tbody>
			<?php
			$dFecha = FNDate(); 
			$aFecha = explode("/", $dFecha);
			$nYear = $aFecha[2]; $nMes = $aFecha[1]; $nDia = $aFecha[0]; 
            $dFecha1 = $nYear . "-" . $nMes . "-" . $nDia; $dFecha2 = $nYear . "-" . $nMes . "-" . $nDia;
			
			$EsGasEsp = $_POST['cbxGasEsp'];
			if($EsGasEsp=="") $EsGasEsp=0;
			if($EsAct==1){
                $dFecha1 = $_POST['cbxYear1']  . "-" . $_POST['cbxMes1'] . "-" . $_POST['cbxDia1'];
                $dFecha2 = $_POST['cbxYear2']  . "-" . $_POST['cbxMes2'] . "-" . $_POST['cbxDia2'];				
			}			
            $WCond = ($EsGasEsp==-1) ? "" : " AND GastoEsp=" . $EsGasEsp;
            $SQL="SELECT A.IDGas, DATE(A.Fecha) AS Fecha, B.Gastos, A.Gasto FROM TTransaccion A INNER JOIN CatGastos B ON A.IDGastos=B.IDGastos WHERE Fecha BETWEEN '" . $dFecha1 ." 00:00:00' AND '" . $dFecha2 . " 23:59:59' " . $WCond . " ORDER BY A.Fecha DESC;";	
			$rsData=FNRS($SQL,$nTotal); 
			foreach($rsData as $rs)
			{          
			?>
			<tr>
				<td class="Fuente"><?php echo($rs->Fecha); ?></td>
				<td class="Fuente"><?php echo($rs->Gastos); ?></td>
				<td class="Fuente"><?php echo($rs->Gasto); ?></td>
                <td class="Fuente"><img src="../../img/edt.gif" width="34" height="29" class="HandI" title="Modificar" onClick="fnMod('<?php echo $rs->IDGas ?>');"/></td>
				<td class="Fuente"><img src="../../img/Del.gif" width="34" height="29" class="HandI" title="Eliminar" onClick="fnDel('<?php echo $rs->IDGas ?>');"/></td>							
			</tr>
            <?php
			}
			unset($rs); $rs=null;
            unset($rsData); $rsData=null;
			?>	
			<tr>
                <td align="right" colspan="2" class="Fuente">Total:</td>
				<td class="Fuente"><?php echo(DevTotal($EsAct, $dFecha1, $dFecha2, $EsGasEsp)); ?></td>
				<td class="Fuente">&nbsp;</td>				
                <td class="Fuente">&nbsp;</td>				
			</tr>				
			</tbody>
		</table>
    </form>
</body>
</html>