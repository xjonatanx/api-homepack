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
    $id = $_POST["id"];
    $rut = $_POST["rut"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    
    $sql = "INSERT INTO direcciones (rut, nombre, telefono, email, direccion, fk_id_usuario) VALUES ('$rut', '$nombre', '$telefono', '$email', '$direccion', $id);";
    
    if ($conn->query($sql) === TRUE) {
        $myObj->status = 1;
        $myObj->mesagge = "Dirección ingresada correctamente..";
        $myJSON = json_encode($myObj);
        echo $myJSON;
    } else {
        $myObj->status = 0;
        $myObj->mesagge = "Ocurrió un problema al registrar la dirección.";
        $myJSON = json_encode($myObj);
        echo $myJSON;
    } 
    $conn->close();
} else {
    echo "No permitido";
}
?>