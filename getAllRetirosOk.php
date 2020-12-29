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
        $total = 0;
        if (isset($_GET['pagina'])) {
            $page = $_GET['pagina'];
        } else {
            $page = 1;
        }
        $no_of_records_per_page = $_GET['cantidad'];
        $offset = ($page-1) * $no_of_records_per_page;
        
        $perfil = $_GET["tipo"];
        $id_chofer = $_GET["id_user"];
        
        $search = $_GET['search'];
        $despachos = array();
        
        if($perfil == "admin") {
            $count = $conn->query("
            SELECT COUNT(*) AS countDespachos 
            FROM despachos 
            LEFT JOIN usuarios
            ON despachos.id_chofer = usuarios.id
            WHERE despachos.retirado = 1 AND despachos.centro_distribucion = 0 AND despachos.sobrancia = 0 AND  (usuarios.nombre LIKE '%$search%' OR despachos.orden_compra LIKE '%$search%' OR despachos.numero_seguimiento LIKE '%$search%');");
            $fila = $count->fetch_assoc();
            $total = $fila['countDespachos'];
            
            $count->close();
            
            $result = $conn->query("
            SELECT 	despachos.id, 
                    despachos.rut_destinatario, 
                    despachos.nombre_destinatario, 
                    despachos.telefono_destinatario, 
                    despachos.email_destinatario, 
                    despachos.fecha_ingreso, 
                    despachos.detalle, 
                    despachos.numero_seguimiento, 
                    despachos.total, 
                    despachos.origen, 
                    despachos.destino, 
                    despachos.id_usuario, 
                    despachos.peso, 
                    despachos.orden_compra, 
                    despachos.qr, 
                    despachos.referencia, 
                    despachos.direccion, 
                    despachos.rut_remitente, 
                    despachos.nombre_remitente, 
                    despachos.telefono_remitente, 
                    despachos.email_remitente, 
                    despachos.direccion_remitente, 
                    despachos.retirado,
                    usuarios.nombre as 'chofer'
            FROM despachos 
            LEFT JOIN usuarios
            ON despachos.id_chofer = usuarios.id
            WHERE despachos.retirado = 1 AND despachos.centro_distribucion = 0 AND despachos.sobrancia = 0 AND (usuarios.nombre LIKE '%$search%'  OR despachos.orden_compra LIKE '%$search%'  OR despachos.numero_seguimiento LIKE '%$search%') 
            ORDER BY fecha_ingreso DESC
            LIMIT $offset, $no_of_records_per_page;");
        }
        
        if($perfil == "chofer") {
            $count = $conn->query("
            SELECT COUNT(*) AS countDespachos 
            FROM despachos 
            LEFT JOIN usuarios
            ON despachos.id_chofer = usuarios.id
            WHERE despachos.id_chofer = $id_chofer AND despachos.retirado = 1 AND despachos.centro_distribucion = 0 AND despachos.sobrancia = 0 AND  (usuarios.nombre LIKE '%$search%' OR despachos.orden_compra LIKE '%$search%' OR despachos.numero_seguimiento LIKE '%$search%');");
            $fila = $count->fetch_assoc();
            $total = $fila['countDespachos'];
            
            $count->close();
            
            $result = $conn->query("
            SELECT 	despachos.id, 
                    despachos.rut_destinatario, 
                    despachos.nombre_destinatario, 
                    despachos.telefono_destinatario, 
                    despachos.email_destinatario, 
                    despachos.fecha_ingreso, 
                    despachos.detalle, 
                    despachos.numero_seguimiento, 
                    despachos.total, 
                    despachos.origen, 
                    despachos.destino, 
                    despachos.id_usuario, 
                    despachos.peso, 
                    despachos.orden_compra, 
                    despachos.qr, 
                    despachos.referencia, 
                    despachos.direccion, 
                    despachos.rut_remitente, 
                    despachos.nombre_remitente, 
                    despachos.telefono_remitente, 
                    despachos.email_remitente, 
                    despachos.direccion_remitente, 
                    despachos.retirado,
                    usuarios.nombre as 'chofer'
            FROM despachos 
            LEFT JOIN usuarios
            ON despachos.id_chofer = usuarios.id
            WHERE despachos.id_chofer = $id_chofer AND despachos.retirado = 1 AND despachos.centro_distribucion = 0 AND despachos.sobrancia = 0 AND (usuarios.nombre LIKE '%$search%'  OR despachos.orden_compra LIKE '%$search%'  OR despachos.numero_seguimiento LIKE '%$search%') 
            ORDER BY fecha_ingreso DESC
            LIMIT $offset, $no_of_records_per_page;");
        }
            
        while ( $row = $result->fetch_assoc())  {
            $despachos[] = array(
                'id' => $row["id"], 
                'rut_destinatario' => $row["rut_destinatario"], 
                'nombre_destinatario' => $row["nombre_destinatario"], 
                'telefono_destinatario' => $row["telefono_destinatario"], 
                'email_destinatario' => $row["email_destinatario"], 
                'fecha_ingreso' => $row["fecha_ingreso"],
                'detalle' => $row["detalle"],
                'numero_seguimiento' => $row["numero_seguimiento"],
                'total' => $row["total"],
                'origen' => $row["origen"],
                'destino' => $row["destino"],
                'id_usuario' => $row["id_usuario"],
                'peso' => $row["peso"],
                'orden_compra' => $row["orden_compra"],
                'qr' => $row["qr"],
                'referencia' => $row["referencia"],
                'direccion' => $row["direccion"],
                'rut_remitente' => $row["rut_remitente"],
                'nombre_remitente' => $row["nombre_remitente"],
                'telefono_remitente' => $row["telefono_remitente"],
                'email_remitente' => $row["email_remitente"],
                'direccion_remitente' => $row["direccion_remitente"],
                'retirado' => $row["retirado"],
                'chofer' => $row["chofer"]
            );
        }
        $myObj->data = $despachos;
        $myObj->total = $total;
        $myJSON = json_encode($myObj);
        echo $myJSON;
    } else {
        echo "No permitido";
    }
?>