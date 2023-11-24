<?php

class MyPdf extends TCPDF {
    public function error($msg) {
        throw new Exception($msg);
    }

	public function generateTable($caption, $header, $rows) {
        // Caption font and color
        $this->SetFont('helvetica', 'B', 16);
        $this->SetTextColor(0);
        // Caption
        $this->Cell(180, 18, $caption, 0, 1, 'C', 0);
        $this->Ln();

        // Borders width
        $this->SetLineWidth(0.3);

        // Header font and colors
        $this->SetFont('helvetica', 'B', 10);
        $this->SetFillColor(220, 220, 220);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        // Header
        $w = array(35, 15, 20, 15, 20, 30, 35);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        // Rows font and border color
        $this->SetFont('helvetica', '', 10);
        $this->SetDrawColor(0);
        // Rows
        $i = 0;
        foreach ($rows as $r) {
            $this->SetTextColor(0);

            // Set X position for the first column

            // Adjust the width of specific cells or use MultiCell for fields that may overflow
            $this->Cell($w[0], 10, $r['tanosveny'], 1);
            $this->Cell($w[1], 10, $r['hossz'], 1);
            $this->Cell($w[2], 10, $r['allomas'], 1);
            $this->Cell($w[3], 10, $r['ido'], 1);
            $this->Cell($w[4], 10, ($r['vezetes'] == true) ? "Igen" : "Nem", 1);
            $this->Cell($w[5], 10, $r['telepules'], 1);
            $this->MultiCell($w[6], 10, $r['nemzeti_park'], 1);

            $this->Ln();
            $i = !$i;
        }
    }
}

?>
