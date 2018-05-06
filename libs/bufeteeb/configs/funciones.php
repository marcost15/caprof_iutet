<?php

function filtrorif($rif)
{
    $letras='JVPEG';
    $rif=ucfirst($rif);
    if (strpos($letras,$rif{0})===false){
        echo '    Error : Letra incorrecta: ',$rif{0};
        return false;
    }
    $patron = "/[^$letras\\d]/";
    $reemplazo = '';
    $rif=preg_replace($patron, $reemplazo, $rif);
    $r=array();
    $r[0]=$rif{0};
    $r[1]=str_pad(substr(substr($rif, 1),0,-1), 8, "0", STR_PAD_LEFT);
    $r[2]=substr($rif, -1, 1);
    $rif=join($r);
    return $rif;
}

function f2f($fecha){
   $f=explode('-',$fecha);
   return $f[2].'-'.$f[1].'-'.$f[0];
}

function sesion(){
   if (!$_SESSION['nombre']){
      echo "
<html>
<head></head>
<body>
<div style=\"\">
Lo siento. No est&#225;s autorizado para ingresar aqu&#237;
<a href=\"login.php\">Continuar</a>
</div>
</body>
</html>
      ";
      return false;
   }else{
      return true;
   }
}

function ir($direccion){
  header("Location: $direccion");
  exit();
}
///////
function ver2($matriz) {
   $estilo='style="font-size:9pt;"';
   $color1='#dfdfdf';
   $color2='#fefefe';
   $color3='#fdfdfd';
   $color='color1';
   $salida='<table border="1" cellspacing="1" cellpadding="1"  '.$estilo.' rules="all">';
   if (!is_array($matriz)){var_dump($matriz);return $matriz;}
      foreach($matriz as $key=>$value) {
         if(count($value)>0){
       //$color=($color=='color1')?'color2':'color1';
       if(is_array($value)||is_object($value)) {
           $salida.='<tr bgcolor="'.$color3."\"><td valign='top' bgcolor=\"$color1\">$key</td><td>";
           $salida.=ver2($value);
           $salida.="</td></tr>";
         } else {
            $salida.='<tr bgcolor="'.$color1."\"><td valign='top'>$key</td><td bgcolor=\"$color2\">$value</td></tr>";
         }

       }
   }
   $salida.='</table>';
   return $salida;
}

function ver($ss){
   if(!(is_array($ss)||is_object($ss))){
      echo $ss;
   }else{
      echo ver2($ss);
   }
}

function v(){
echo <<<bufetestradabarrios
    <table border="1">
	<tr>
	    <td>SESSION
	    </td>
	    <td>REQUEST
	    </td>
	</tr>
	<tr>
	    <td>
bufetestradabarrios;
   ver($_SESSION);
echo <<<bufetestradabarrios
	    </td>
	    <td>REQUEST
bufetestradabarrios;
   ver($_REQUEST);
echo <<<bufetestradabarrios
	    </td>
	</tr>
    </table>
bufetestradabarrios;
 }

