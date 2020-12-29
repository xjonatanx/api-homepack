<?php
    $user = $_POST["usuario"];
    $clave = md5($_POST["passwd"]);
    include("./conn.php");
    $token = "";
    $result = $conn->query("SELECT id, nombre, usuario, perfil, rut, email, telefono, fecha_nacimiento, comuna FROM usuarios WHERE usuario = '$user' AND passwd = '$clave';");
    while ( $row = $result->fetch_assoc())  {
        // base64 encodes the header json
        $arr = array('alg' => 'HS256', 'typ' => 'JWT');
        $arr2 = json_encode($arr);
        $encoded_header = base64_encode($arr2);


        // base64 encodes the payload json
        $arr3 = array(
            'id' => $row["id"], 
            'nombre' => $row["nombre"], 
            'usuario' => $row["usuario"], 
            'perfil' => $row["perfil"], 
            'telefono' => $row["telefono"], 
            'rut' => $row["rut"], 
            'email' => $row["email"], 
            'fecha_nacimiento' => $row["fecha_nacimiento"], 
            'comuna' => $row["comuna"]
        );
        $arr33 = json_encode($arr3);
        $encoded_payload = base64_encode($arr33);

        // base64 strings are concatenated to one that looks like this
        $header_payload = $encoded_header . '.' . $encoded_payload;

        //Setting the secret key
        $secret_key = 'HOMEPACKYITP2020';

        // Creating the signature, a hash with the s256 algorithm and the secret key. The signature is also base64 encoded.
        $signature = base64_encode(hash_hmac('sha256', $header_payload, $secret_key, true));

        // Creating the JWT token by concatenating the signature with the header and payload, that looks like this:
        $jwt_token = $header_payload . '.' . $signature;

        //listing the resulted  JWT
        $token = $jwt_token;
    }
    $rowcount=mysqli_num_rows($result);
    if($rowcount == 0) {
        $myObj->status = 0;
        $myObj->mesagge = "Usuario y/o Contraseña Incorrecta.";
        $myJSON = json_encode($myObj);
        echo $myJSON;
    } else {
        $myObj->status = 1;
        $myObj->mesagge = "Autenticación Correcta.";
        $myObj->token = $token;
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
    
?>