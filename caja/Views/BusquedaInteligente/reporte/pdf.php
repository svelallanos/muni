<?php
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('San Lucas');
$pdf->SetTitle('Reporte de conceptos');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

$html = '<h1 style="text-align:center;">Lista de conceptos relacionados</h1>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(2);

// recorremos los conceptos
foreach ($data['lista_conceptos']['data'] as $key => $value) {
    $pdf->setCellHeightRatio(0.8);
    // create some HTML content
    $html = '<label style="color: blue;"><b>'.$value['libro']['libro_titulo'].'</b></label>
    <p style="color: gray"><b>'.$value['ter_asociado'].'</b></p>';
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Ln(1);
    $pdf->setCellHeightRatio(1.5);
    $html = '<p style="text-align:justify;">'.$value['concepto'].'</p>';

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(5);
}
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+