<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';

$filter = $_POST['filter'];
switch( $_POST['field'] ) {
	case 'municipio_id':
        if( $filter != 0 ) 
		{
		    $municipio_id = sql2opciones("SELECT id,nombres FROM municipios WHERE estado_id = '$filter'"); 
        	$n = count($municipio_id);
			if ($n != 0)
            {
                FormHandler::setDynamicOptions($municipio_id); 
				break;
			}
		}
       default:
          FormHandler::setDynamicOptions( array() );
      break;  
	case 'parroquia_id':
        if( $filter != 0 ) 
		{
		    $parroquia_id = sql2opciones("SELECT id,nombre FROM parroquias WHERE municipio_id = '$filter'"); 
        	$n = count($parroquia_id);
			if ($n != 0)
            {
                FormHandler::setDynamicOptions($parroquia_id); 
				break;
			}
		}
       default:
          FormHandler::setDynamicOptions( array() );
      break;       
}  