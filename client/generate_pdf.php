<?php

use Dompdf\Dompdf;

// You need the full path to the autoload.php file in order for this to work!
require_once "../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $html = $_POST['html'];

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Save the generated PDF to a file
    $output = $dompdf->output();
    file_put_contents('order.pdf', $output);

    echo 'order.pdf';
}
