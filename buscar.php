<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "arqdicosg";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    //$query = "SELECT * FROM jugadores WHERE Name NOT LIKE '' ORDER By Id_no LIMIT 25";
	$query = "SELECT * FROM proveedores ORDER By idProveedor";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM proveedores WHERE idProveedor LIKE '%$q%' OR razonSocial LIKE '%$q%' OR ruc LIKE '%$q%' OR telefono LIKE '$q' ";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					
    					<td>Razon Social</td>
    					<td>Ruc</td>
    					<td>Relefono</td>
    					
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					
    					<td>".$fila['razonSocial']."</td>
    					<td>".$fila['ruc']."</td>
    					<td>".$fila['telefono']."</td>
    					
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="NO HAY DATOS PE, NO BAÑASTE";
    }


    echo $salida;

    $conn->close();



?>