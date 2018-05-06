<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_modificar_personal.php';
include './modelo/bd_verificar_privilegios.php';
include './modelo/bd_lista_niveles.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('modificar_usuario.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$nivel = bd_lista_niveles();
$id = $_REQUEST['id'];
$usuario = sql2row("SELECT nombre,correo,nivel_id FROM usuarios WHERE id = '$id'");
$f1=new FormHandler('usuario',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->addHTML(" <br />"."<div id='titulo'>MODIFICAR USUARIO</div>"."<td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f1->hiddenField('id', $id);
$f1->textField($star.'Nombre y Apellido','nombre',FH_STRING,40,50,"onkeyup=\"usuario.nombre.value=usuario.nombre.value.toUpperCase();\"");
$f1->setValue('nombre', $usuario['nombre']);
$f1->textField($star.'Correo Electrónico','correo',FH_EMAIL,30,50,"onkeyup=\"usuario.nombre.value=usuario.nombre.value.toUpperCase();\"");
$f1->setValue('correo', $usuario['correo']);
$f1->selectField($star."Nivel de Acceso", "nivel",$nivel,FH_NOT_EMPTY,true);
$f1->setValue('nivel', $usuario['nivel_id']);
$f1->addLine($star ." = Campos Requeridos Obligatoriamente");
$f1->setMask(
  " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Registrar','registrar');
$f1->resetButton();
$f1->addHTML("<br />"." <td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f1->onCorrect("procesar");

function procesar($d)
{
		bd_modificar_personal($d);
		?>
				<script type="text/javascript">
				window.alert('USUARIO MODIFICADO CORRECTAMENTE');
				location.href='consmod_usuario.php';
				</script>
		<?php	
}
$smarty->assign('f1',$f1->flush(true));
$smarty->disp();