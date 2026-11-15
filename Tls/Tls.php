<?php
function SPOpnDB()
{
    define('DB_HOST','localhost:3306'); define('DB_USER','bautista_usrexp');
    define('DB_PASS','ap3xp3f+-'); define('DB_NAME','bautista_expenses');
    try
    { 
        $DB = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        return $DB;
    }
    catch (PDOException $e)
    {
        exit("Error: " . $e->getMessage());
    }
}

function SPCMD($WSQL, $EsRS)
{     
    try
    {
        $DB = SPOpnDB(); $sql = $DB-> prepare($WSQL);   
        $sql->execute();
        if($EsRS==1) return $sql;              
        $DB = null;
    } 
    catch(PDOException $e) {
        echo "<br/>Connection failed: " . $e->getMessage() . "<br/>";
    }    
}	
function FNRS($WSQL,&$Total)
{    
    $query = SPCMD($WSQL,1); 
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $Total = $query->rowCount();
    return $results;
}
function FNMailCmpx($WMail, $WSubj, $WFrm, $WBody)
{
    $bPaso=FALSE; 
	return $bPaso;
}
function FNCdHx($WHnd)
{
    $nKey=31;
    for($J=0;$J<=strlen($WHnd)-1;$J++)
    {   
        $WCar=substr($WHnd,$J,1); $nAsc = FNAsc($WCar)*$nKey;	$nHex= dechex($nAsc);
        $Wrd=$Wrd . (strlen($nHex)==4 ? $nHex : str_pad("0" . $nHex,4, STR_PAD_LEFT));
    }
    return $Wrd;
}
function FNAsc($WAsc)
{
    $aAsc=unpack("C*", $WAsc); $nAsc = $aAsc[1];
    return $nAsc; 
}
function FNDcHx($WHnd)
{
	$nKey=31; $J=0; $nlen=strlen($WHnd);
	while($J<$nlen)
	{
        $WCar=substr($WHnd,$J,4); $XCar=$WCar; $nHNum=intval($XCar,16); $nChr = $nHNum / $nKey;
        $Wrd = $Wrd . chr($nChr);
        $J=$J+4;
    }
    return $Wrd;
}

function FNDateX()
{
    $url = "http://www.ufecha.theflirts.mx/api/99";	
    $client = curl_init($url); curl_setopt($client,CURLOPT_RETURNTRANSFER,true); $response = curl_exec($client); $result = json_decode($response);
    $WFec = $result->FechaY;    
    return $WFec;	
}  

function FNDates()
{
    $WTime=date("Y-m-d H:i:s", time()); $FDate=date_create($WTime,timezone_open("America/Mexico_City")); $WFec = date_format($FDate,"d/m/Y H:i:s");
    return $WFec;
}   

function FNDate()
{
    $time = time(); $TimeStr=date("Y-m-d H:i:s", $time); $TimeZoneNameFrom="UTC"; $TimeZoneNameTo="Mexico/General";
    $WFec=date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("d/m/Y");
    return $WFec;	 
}   

function FNTimes()
{
    $WTime=date("Y-m-d H:i:s", time()); $FDate=date_create($WTime,timezone_open("America/Mexico_City")); $WFec = date_format($FDate,"H:i:s");
    return $WFec;
}

function FNTime()
{
    $WTime=date("Y-m-d H:i:s", time()); $FDate=date_create($WTime,timezone_open("America/Mexico_City")); $WFec = date_format($FDate,"d/m/Y H:i:s");	
    return $WFec;
}

function FNTimeX()
{
    $WTime=date("Y-m-d H:i:s", time()); $FDate=date_create($WTime,timezone_open("America/Mexico_City")); $WFec = date_format($FDate,"Y-m-d");	
    return $WFec;
}

function FNTiempos()
{
    $time = time(); $TimeStr=date("Y-m-d H:i:s", $time); $TimeZoneNameFrom="UTC"; $TimeZoneNameTo="Mexico/General";
    $WFec=date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("d/m/Y H:i:s");
    return $WFec;
}

function FNDVMes($nMes)
{
    $oMes = array("AA", "Enero", "Febrero", "Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); $nEle = count($oMes); $WMes="";
    for($K=0; $K<$nEle; $K++)
    {
        if($K == $nMes) //
        {
            $WMes = $oMes[$K]; break;
        }
    }
    return $WMes;
}
?>