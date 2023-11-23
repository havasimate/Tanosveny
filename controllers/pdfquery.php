<?php

error_reporting(E_ALL);
ini_set('display_errors', "On");

require_once(SERVER_ROOT . 'tcpdf/tcpdf.php');

class Pdfquery_controller
{
    public string $baseName = 'pdfmaker';

    public function main(array $vars)
    {
        $pdfQueryModel = new Pdfquery_model($vars);
        $retData = $pdfQueryModel->get_data($vars);

        if ($retData['eredmeny'] == "OK") {
            $pdf = $this->initializePDF();

            // add a page
            $pdf->AddPage();

            // table caption
            $caption = 'Tanösvények';

            // column titles
            $header = array('Tanösvény neve', 'Táv', 'Állomások', 'Ido', 'Vezeto', 'Település', 'Park neve');

            // data loading
            $rows = $retData['tanosvenyek'];

            // print colored table
            $pdf->generateTable($caption, $header, $rows);

            // close and output PDF document
            $pdf->Output('tanosvenyek' . date('Ymd-Gis', time()) . '.pdf', 'D');
        } else {
            $this->renderErrorPage($retData);
        }
    }

    private function initializePDF(): MyPdf
    {
        $pdf = new MyPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $languageFile = dirname(__FILE__) . '/lang/hun.php';
        if (!@file_exists($languageFile)) {
            $languageFile = './beadando2/tcpdf/examples/lang/hun.php';
        }

        if (@file_exists($languageFile)) {
            require_once($languageFile);
            $pdf->setLanguageArray($l);
        } else {
            $l['a_meta_charset'] = 'UTF-8';
            $l['a_meta_dir'] = 'ltr';
            $l['a_meta_language'] = 'hu';
            $l['w_page'] = 'oldal';
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('helvetica', 'B', 10);

        return $pdf;
    }

    private function renderErrorPage(array $retData)
    {
        $view = new View_Loader($this->baseName . '_main');
        foreach ($retData as $name => $value) {
            $view->assign($name, $value);
        }
    }
}
