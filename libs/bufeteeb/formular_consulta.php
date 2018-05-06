<?php require_once('Connections/bufeteeb.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "infodatos")) {
  $insertSQL = sprintf("INSERT INTO consultas (fecha, asunto, apellidonombre, correo, personal_id) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['hfecha'], "date"),
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['txtNombre'], "text"),
                       GetSQLValueString($_POST['txtmail'], "text"),
                       GetSQLValueString($_POST['selectAbog'], "text"));

  mysql_select_db($database_bufeteeb, $bufeteeb);
  $Result1 = mysql_query($insertSQL, $bufeteeb) or die(mysql_error());

  $insertGoTo = "formular_consultaresp.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_bufeteeb, $bufeteeb);
$query_abogados = "SELECT * FROM personal ORDER BY apellido ASC";
$abogados = mysql_query($query_abogados, $bufeteeb) or die(mysql_error());
$row_abogados = mysql_fetch_assoc($abogados);
$totalRows_abogados = mysql_num_rows($abogados);
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
#Layer1 {	position:absolute;
	left:4px;
	top:2px;
	width:430px;
	height:56px;
	z-index:2;
}
.Estilo1 {	color: #a71007;
	font:Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
}
.Estilo2 {	font:Arial, Helvetica, sans-serif;
	font-size: 13px;
	color:#000000;
}
#Layer2 {	position:absolute;
	left:485px;
	top:79px;
	width:476px;
	height:327px;
	z-index:1;
}
#Layer3 {
	position:absolute;
	left:4px;
	top:60px;
	width:312px;
	height:416px;
	z-index:3;
}
-->
</style>

<script type="text/JavaScript">
<!--


function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>
<SCRIPT language=javascript src="validacion.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
var txt="::Bufete Estrada Barrios & Asociados:: *-* Formular Consulta";
var espera=100;
var refresco=null;
function rotulo_title() {
        document.title=txt;
        txt=txt.substring(1,txt.length)+txt.charAt(0);
        refresco=setTimeout("rotulo_title()",espera);}
rotulo_title();
</SCRIPT>
<div id="Layer1">
  <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','429','height','55','src','Imagenes/formular pregunta','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','Imagenes/formular pregunta' ); //end AC code
</script>
<noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="429" height="55">
    <param name="movie" value="Imagenes/formular pregunta.swf">
    <param name="quality" value="high">
    <embed src="Imagenes/formular pregunta.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="429" height="55"></embed>
  </object>
</noscript></div>
<div id="Layer3">
<form action="<?php echo $editFormAction; ?>" method="POST" name="infodatos">
  <table width="453" border="0">
    <tr>
      <td colspan="2" class="Estilo1"><div align="center">Si ha optado por hacernos llegar su consulta, rellene los   siguientes datos:</div></td>
    </tr>
    <tr>
      <td width="160" class="Estilo2"><div align="right">Nombre y apellido:</div></td>
      <td width="300"><input name="txtNombre" type="text" id="txtNombre" size="50" maxlength="50"></td>
    </tr>
    <tr>
      <td class="Estilo2"><div align="right">E-mail:</div></td>
      <td><input name="txtmail" type="text" id="txtmail" size="50" maxlength="50"></td>
    </tr>
    <tr>
      <td class="Estilo2"><div align="right">Abogado:</div></td>
      <td><select name="selectAbog" id="selectAbog">
        <option value="">- - Seleccione - -</option>
        <?php
do {  
?>
        <option value="<?php echo $row_abogados['id']?>"><?php echo $row_abogados['apellido']?> <?php echo $row_abogados['nombre']?></option>
        <?php
} while ($row_abogados = mysql_fetch_assoc($abogados));
  $rows = mysql_num_rows($abogados);
  if($rows > 0) {
      mysql_data_seek($abogados, 0);
	  $row_abogados = mysql_fetch_assoc($abogados);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center" class="Estilo2">Escriba el contenido de su consulta en el cuadro de   texto.</div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <textarea name="textfield" cols="50" rows="5"></textarea>
      </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
<input name="Submit" type="button" value="Consultar" onClick="javascript:validarconsulta_publica();">
          <input name="hfecha" type="hidden" id="hfecha" value="<?php echo date("Y-m-d"); ?>">
      </div></td>  
    </tr>
    <tr>
      <td colspan="2">       </td>
    </tr>
    <tr>
      <td colspan="2"><div align="justify"><span class="Estilo2">Advertencia Legal - La informaci&oacute;n   facilitada no podr&aacute; ser considerada como Dictamen o Informe. Siendo la misma   &uacute;nicamente una respuesta de car&aacute;cter orientativo, seg&uacute;n leal saber y entender y   sin perjuicio de mejor opini&oacute;n fundada en Derecho.   Este sistema de consultas debe limitarse a consultas previas destinadas a   la consecuci&oacute;n de un asunto judicial o extrajudicial que se pretenda encargar a   este Despacho, nunca como medio para resolver cualquier tipo de consulta   acad&eacute;mica de informaci&oacute;n general u otras que por su naturaleza no se encuadren   en la actividad propia de es Despacho y lamentando que en su caso no obtengan   respuesta por imposibilidad material de atender este tipo de consultas.</span> </div></td>
    </tr>
  </table>
  
  <input type="hidden" name="MM_insert" value="infodatos">
</form>
</div>
</body>
</html>
<?php
mysql_free_result($abogados);
?>
