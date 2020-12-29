<?php
    include("./conn.php");
    $numero_seguimiento = $_GET["numero_seguimiento"];
    $historial = array();
    $result = $conn->query("
    SELECT seguimiento.id as 'id', seguimiento.fecha as 'fecha', seguimiento.estado as 'estado', seguimiento.foto as 'foto', seguimiento.fk_id_despacho as 'fk_id_despacho', seguimiento.nombre_recepcion as 'nombre_recepcion', seguimiento.apellido_recepcion as 'apellido_recepcion', seguimiento.rut_recepcion as 'rut_recepcion', seguimiento.motivo as 'motivo'
    FROM seguimiento 
    LEFT JOIN despachos
    ON seguimiento.fk_id_despacho = despachos.id
    WHERE despachos.numero_seguimiento = '$numero_seguimiento'
    ORDER BY fecha DESC;");
    while ( $row = $result->fetch_assoc())  {
        $historial[] = array(
            'id' => $row["id"], 
            'fecha' => $row["fecha"], 
            'estado' => $row["estado"], 
            'foto' => $row["foto"], 
            'fk_id_despacho' => $row["fk_id_despacho"],
            'nombre_recepcion' => $row["nombre_recepcion"],
            'apellido_recepcion' => $row["apellido_recepcion"],
            'rut_recepcion' => $row["rut_recepcion"],
            'motivo' => $row["motivo"]
        );
    }
    echo json_encode($historial);
?>