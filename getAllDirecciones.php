<?php
    include("./conn.php");
    
    //Verifying the Signature
    $recievedJwt = $_GET['token'];
    $secret_key = 'HOMEPACKYITP2020';
    // Split a string by '.' 
    $jwt_values = explode('.', $recievedJwt);
    // extracting the signature from the original JWT 
    $recieved_signature = $jwt_values[2];
    // concatenating the first two arguments of the $jwt_values array, representing the header and the payload
    $recievedHeaderAndPayload = $jwt_values[0] . '.' . $jwt_values[1];
    // creating the Base 64 encoded new signature generated by applying the HMAC method to the concatenated header and payload values
    $resultedsignature = base64_encode(hash_hmac('sha256', $recievedHeaderAndPayload, $secret_key, true));
    // checking if the created signature is equal to the received signature
    $recieved_signature = str_replace(" ", "+", $recieved_signature);
    if($resultedsignature == $recieved_signature) {
        if (isset($_GET['pagina'])) {
        $page = $_GET['pagina'];
        } else {
            $page = 1;
        }
        $id = $_GET['id'];
        $direcciones = array();
        $total = 0;
        $no_of_records_per_page = $_GET['cantidad'];
        $offset = ($page-1) * $no_of_records_per_page;
        $search = $_GET['search'];
        $count = $conn->query("SELECT COUNT(*) AS countDirecciones FROM direcciones WHERE fk_id_usuario = $id AND (nombre LIKE '%$search%' OR rut LIKE '%$search%');");
        $fila = $count->fetch_assoc();
        $total = $fila['countDirecciones'];
        $count->close();
        
        $result = $conn->query("SELECT 	id, rut, nombre, telefono, email, direccion
                                FROM direcciones
                                WHERE fk_id_usuario = $id AND (nombre LIKE '%$search%' OR rut LIKE '%$search%')
                                LIMIT $offset, $no_of_records_per_page;"
                            );
        
        while ( $row = $result->fetch_assoc())  {
            $direcciones[] = array(
                'id' => $row["id"], 
                'rut' => $row["rut"], 
                'nombre' => $row["nombre"], 
                'telefono' => $row["telefono"], 
                'email' => $row["email"], 
                'direccion' => $row["direccion"]
            );
        }
        $myObj->data = $direcciones;
        $myObj->total = $total;
        $myJSON = json_encode($myObj);
        echo $myJSON;
    } else {
        echo "No permitido";
    }
?>