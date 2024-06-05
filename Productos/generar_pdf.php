<?php
require_once('../TCPDF-main/tcpdf.php');

function generarPDF($pedido) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $html = "<h1>Ticket de Compra</h1>";
    $html .= "<p>Detalles del pedido:</p>";
    foreach ($pedido['productos'] as $producto) {
        $html .= "<p>{$producto['nombre']} - €{$producto['precio']}</p>";
    }
    $html .= "<p>Total: €{$pedido['total']}</p>";
    $pdf->writeHTML($html, true, false, true, false, '');
    $fileName = "ticket_{$pedido['id']}.pdf";
    $pdf->Output(__DIR__ . "/tickets/" . $fileName, 'F');
    return $fileName;
}
?>
