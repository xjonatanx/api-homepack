<?php
include("./conn.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

    $orden = $_POST["orden"];
    
    if ($result = $conn->query("SELECT * FROM despachos WHERE orden_compra = '$orden' AND retirado = 1;")) {
        $row_cnt = $result->num_rows;
        $result->close();
        if($row_cnt > 0) {
            $myObj->status = 0;
            $myObj->mesagge = "No se puede anular un despacho que ya se encuentra en transito.";
            $myJSON = json_encode($myObj);
            echo $myJSON;
        } else {
            $myObj->status = 1;
            $myJSON = json_encode($myObj);
            echo $myJSON;
        }
    }

    $conn->close();

?>