<?php

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//Biller
$pdf->ChapterTitle($invoiceHeaders['mainheader'],$invoiceNumber,$headerText,$white);
$pdf->ChapterTitle($invoiceHeaders['submainheader'],'',$accountTypeText,$white);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$userDetails['company'],0,1,'R');
$pdf->Cell(0,5,$userDetails['address'],0,1,'R');
$pdf->Cell(0,5,$userDetails['email'],0,1,'R');
$pdf->Cell(0,5,$userDetails['phone'],0,1,'R');
$pdf->Cell(0,10,'',0,1,'R');
//Invoice details
$pdf->SetFillColor(200,220,255);
$pdf->ChapterTitle('Invoice #',$invoiceNumber,$invoiceText);
$pdf->ChapterTitle('Invoice Date :',date('d/m/y'),$invoiceText);
$pdf->ChapterTitle('Invoice Due Date :',date('d/m/Y'),$invoiceText);
$pdf->Cell(0,15,'',0,1,'R');//Space
//Billed to
$pdf->OrdinaryTitle('Billed To','',$ordinaryText,$white);
$pdf->OrdinaryTitle($recipientDetails['company'],'',$ordinaryText,$white);
$pdf->OrdinaryTitle($recipientDetails['name'],'',$ordinaryText,$white);
$pdf->OrdinaryTitle($recipientDetails['phone'],'',$ordinaryText,$white);
$pdf->OrdinaryTitle($recipientDetails['email'],'',$ordinaryText,$white);
$pdf->Cell(0,10,'',0,1,'R'); 
//invoice header
$pdf->TableContent('Description');
$pdf->TableContent('Price',array('x'=>20,'y'=>7,'column'=>1,'row'=>1));
//invoice contents
 foreach ($cartItems as $key => $value) {
    $pdf->Cell(170,7,$value['item'],1,0,'L',0);
    $pdf->Cell(20,7,$currency." ".$value['price'],1,1,'C',0);
   //Calcaluting Total
    $total=+$value['price'];
    }
   //Calcaluting vat 
$vat=$total*$vatPercentage;
$currentTotal=$total+$vat;
$pdf->Cell(0,0,'',0,1,'R');
$pdf->Cell(170,7,'VAT',1,0,'R',0);//name
$pdf->Cell(20,7,$currency." ".$vat,1,1,'C',0);//data
$pdf->Cell(170,7,'Total',1,0,'R',0);//name
$pdf->Cell(20,7,$currency." ".$currentTotal,1,0,'C',0);//data
$pdf->Cell(0,20,'',0,1,'R');
$pdf->Cell(190,40,$footerheader,0,0,'C');
//Storing invoice
$filename=$invoicePath.$invoiceName;
$pdf->Output($filename,'F');
