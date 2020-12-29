<?php

require_once __DIR__ . '/vendor/autoload.php';

$filename = "BOLETA";
$estado = $_GET["pago"];
$orden = $_GET["orden"];
$div_estado = "";
if($estado == "pagado") {
    $div_estado = "<div style='padding: 6px; color: white; background-color: green; text-align: center; letter-spacing: 4px;'><b>DESPACHO PAGADO</b></div>";
}
if($estado == "pendiente") {
    $div_estado = "<div style='padding: 6px; color: black; background-color: #ffc107; text-align: center; letter-spacing: 4px;'><b>PAGO PENDIENTE</b></div>";
}
if($estado == "rechazado") {
    $div_estado = "<div style='padding: 6px; color: white; background-color: red; text-align: center; letter-spacing: 4px;'><b>PAGO RECHAZADO</b></div>";
}
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('
    <html>
        <head><meta charset="gb18030">
            <link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
              <style>
                body {
                    font-family: "Roboto", sans-serif;
                }
                .card {
                  background: #fff;
                  display: inline-block;
                  border: 1px solid #ddd;
                }
            
                .image {
                  float: left;
                  width: 25%;
                  height: 150px
                }
            
                .content {
                  float: left;
                  height: 140px;
                  width: 73%;
                  overflow: hidden;
                  padding: 5px;
                }
            
                .content h4 {
                  margin: 5px 0;
                }
              </style>
        </head>
        <body>
            <div class="container">

              <div class="col-md-4">
                
                <div class="card">
                    <div
                      class="head-ticket"
                      style="padding: 10px; background-color: purple; color: white; text-align: center;"
                    >
                        <b><span style="letter-spacing: 4px">HOME PACK CHILE</span></b>
                    </div>
                    <div
                      class="head-ticket"
                      style="padding: 10px; background-color: gray; color: white; text-align: center; letter-spacing: 4px;"
                    >
                        <b>NÚMERO DE SEGUIMIENTO: '.$_GET["numero_seguimiento"].'</b>
                    </div>
                  <div class="image pull-left">
                    <img src="https://yitp.cl/khipu/'.$_GET["qr"].'"/>
                  </div>
                  <div class="content pull-left">
                    <div
                      style="padding: 10px;"
                    >
                        <div style="color: purple; font-weight: bold; margin-bottom: 5px">
                          REMITENTE
                        </div>
                        <b>Nombre:</b> '.$_GET["nombre_remitente"].'<br />
                        <b>RUT:</b> '.$_GET["rut_remitente"].'<br />
                        <b>Teléfono:</b> '.$_GET["telefono_remitente"].'<br />
                        <b>Email:</b> '.$_GET["email_remitente"].'<br />
                        <b>Dirección:</b> '.$_GET["direccion_remitente"].'<br />
                        <hr />
                        <div style="color: purple; font-weight: bold; margin-bottom: 5px">
                          DESTINATARIO
                        </div>
                        <b>Nombre:</b> '.$_GET["nombre_destinatario"].'<br />
                        <b>RUT:</b> '.$_GET["rut_destinatario"].'<br />
                        <b>Teléfono:</b> '.$_GET["telefono_destinatario"].'<br />
                        <b>Email:</b> '.$_GET["email_destinatario"].'<br />
                        <b>Dirección:</b> '.$_GET["direccion_destinatario"].'<br />
                    </div>
                  </div>
                  <div class="clearfix">
        
                  </div>
                  <div
                      class="head-ticket"
                      style="padding: 15px; text-align: center;"
                    >
                        <img src="https://yitp.cl/khipu/'.$_GET["barcode"].'"/>
                    </div>
                    <div style="padding: 10px; color: white; background-color: purple; text-align: center; letter-spacing: 4px;"><b>ORDEN DE COMPRA: '.$orden.'</b></div>
                    '.$div_estado.'
                </div>
              </div>
            </div>
        </body>
    </html>
');
$mpdf->Output("BOLETA_".$_GET["orden"], "D");