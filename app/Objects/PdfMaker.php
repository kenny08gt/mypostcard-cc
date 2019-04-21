<?php
/**
 * Created by PhpStorm.
 * User: Alan Hurtarte
 * Date: 2019-04-19
 * Time: 20:09
 */

namespace App\Objects;

/**
 * Class PdfMaker
 * @package App\Objects
 */
class PdfMaker
{
    /**
     * @param $url
     * @return string
     */
    public function generate($url)
    {
        $img = file_get_contents($url);
        list($width, $height) = getimagesize($url);
        $orientation = 'P';

        if($width >= $height)
            $orientation = 'L';

        $pdf = new \TCPDF($orientation);
        // set document information
        $pdf->SetCreator('My postcard');
        $pdf->SetAuthor('Alan Hurtarte');
        $pdf->SetTitle('My postcard');
        $pdf->SetSubject('Code challenge');
        $pdf->SetKeywords('TCPDF, PDF, postcard');

        // set margins
        $pdf->SetMargins(0, 0, 0);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 0);

        $pdf->AddPage();
        $pdf->setJPEGQuality(75);
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

        $pdf->Image('@' . $img, '', '', 0, 0 ,'', '', '', false, 190);
        $pdf->Output('mypostcard_'.uniqid().'.pdf', 'I');
    }
}
