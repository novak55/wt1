<?php
include_once ('../vendor/tfpdf/tFPDF.php');
class pdfZP {
    
    private $fPdf;
    private $vykreslitdata;
    private $size = [];
    CONST LWIDTH = 270;
    CONST PWIDTH = 200;
    Const SIZE = [80,30,30,30,50,50];
    
    public function __construct()
    {
        $this->fPdf = new tFPDF;
    }
    
    public function rendrujPdf()
    {
        if($this->isSize() == false){
            $this->fPdf->AddFont('Calibri', '', 'calibri.ttf', true);
            $this->fPdf->SetAuthor('Milan Novák');
    
            $this->fPdf->AddPage('l');
            $this->fPdf->SetFont('Calibri', '', '20');
            $this->fPdf->Cell(270, 15, "Chyba - nebylo nalezeno potřebné nastavení.", 1, '1', 'C');
    
        }else {
            $this->fPdf->AddFont('Calibri', '', 'calibri.ttf', true);
            $this->fPdf->SetAuthor('Milan Novák');
    
            $this->fPdf->AddPage('l');
            $this->fPdf->SetFont('Calibri', '', '20');
            $this->fPdf->Cell(270, 15, "Seznam hudebních kapel", 1, '1', 'C');
    
            $this->fPdf->SetFont('Calibri', '', '10');
    
            $i = 0;
            $this->fPdf->Cell($this->size[$i++], 10, "Název kapely", 1);
            $this->fPdf->Cell($this->size[$i++], 10, "Rok založení", 1, 0, 'C');
            $this->fPdf->Cell($this->size[$i++], 10, "Rok ukončení", 1, 0, 'C');
            $this->fPdf->Cell($this->size[$i++], 10, "Žánr", 1, 0, 'C');
            $this->fPdf->Cell($this->size[$i++], 10, "Město", 1);
            $this->fPdf->Cell($this->size[$i++], 10, "Stát", 1, '1', '');
    
            foreach ($this->vykreslitdata as $radek) {
                for ($i = 0; $i < count($radek); $i++) {
                    $bunka = $radek[$i];
                    $delka = count($this->size) - 2;
                    if ($delka >= $i) {
                        $this->fPdf->Cell($this->size[$i], 10, $bunka, 0, '0');
                    } else {
                        $this->fPdf->Cell($this->size[$i], 10, $bunka, 0, '1');
                    }
                }
            }
        }
        $this->fPdf->Output();
    }
    
    public function setVykreslitdata($vykreslitdata)
    {
        $this->vykreslitdata = $vykreslitdata;
    }
    
    public function addSize($size)
    {
        $this->size[] = $size;
    }
    
    public function isSize()
    {
        if(count($this->size) == 0) {
            if (count($this->vykreslitdata) > 0) {
                $prvku = count($this->vykreslitdata[0]);
                $rozmer = (int)self::LWIDTH / $prvku;
                for ($i = 0; $i < $prvku; $i++) {
                    $this->addSize($rozmer);
                }
            }else {
                return false;
            }
        }
        return true;
    }
    
    
}