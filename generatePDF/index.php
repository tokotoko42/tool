<?php
require_once('./tcpdf/tcpdf.php');
require_once('./tcpdf/fpdi/fpdi.php');

class PDF extends FPDI {
    /**
     * "Remembers" the template id of the imported page
     */
    var $_tplIdx;

    /**
     * include a background template for every page
     */
    function Header() {
        if (is_null($this->_tplIdx)) {
            $this->setSourceFile('sample.pdf');
            $this->_tplIdx = $this->importPage(1);
        }
        $this->useTemplate($this->_tplIdx);

    }

    function Footer() {}
}

// initiate PDF
$pdf = new PDF();
$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(true, 40);
$pdf->setFontSubsetting(false);


// add a page
$pdf->AddPage();
$pdf->SetDisplayMode('fullwidth','single');

// 
$pdf->SetFont('kozminproregular', '', 10);
$pdf->Text(40, 47, "佐藤");
$pdf->Text(60, 61, "鈴木");
$pdf->SetFont('kozminproregular', '', 7);
$pdf->Text(140, 41, "2016/10/19");


$pdf->Output('newpdf.pdf', 'I');

exit;