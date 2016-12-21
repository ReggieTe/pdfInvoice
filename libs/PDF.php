<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDF
 *
 * @author Reggie Te
 */
class PDF extends FPDF
{
function Header($logoPath=L0GOURL)
{
//if(is_file($logoPath))
//{
$this->Image($logoPath,10,10,60);
//}
$this->SetFont('Arial','B',12);
$this->Ln(1);
}
function Footer()
{
$this->SetY(-15);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function ChapterTitle($num, $label,$text=array("position"=>'L','font'=>'Arial','weight'=>'','size'=>12),$color=array('fill'=>true,'red'=>200,'blue'=>220,'green'=>255))
{
 
$this->SetFont($text['font'],$text['weight'],$text['size']);

$this->SetFillColor($color['red'],$color['blue'],$color['green']);
$this->Cell(0,8,"$num $label",0,1,$text['position'],$color['fill']);
$this->Ln(0);
}
function ChapterTitle2($num, $label)
{
$this->SetFont('Arial','',12);
$this->SetFillColor(249,249,249);
$this->Cell(170,7,"$num $label",1,0,'C',true);  
//$this->Ln(0);
}
function TableContent($text,
        $position=array('x'=>170,'y'=>7,'column'=>1,'row'=>0),
        $font=array('font'=>'Arial','weight'=>'','size'=>12),
        $color=array('red'=>249,'blue'=>249,'green'=>249))
{ 
    
$this->SetFont($font['font'],$font['weight'],$font['size']);
$this->SetFillColor($color['red'],$color['blue'],$color['green']);
$this->Cell($position['x'],$position['y'],$text,$position['column'],$position['row'],'C',true);  
//$this->Ln(0);
}

function OrdinaryTitle($num, $label,$text=array("position"=>'L','font'=>'Arial','weight'=>'','size'=>12),$color=array('red'=>200,'blue'=>220,'green'=>255))
{
 
$this->SetFont($text['font'],$text['weight'],$text['size']);

$this->SetFillColor($color['red'],$color['blue'],$color['green']);
$this->Cell(0,5,"$num $label",0,1,$text['position'],true);
$this->Ln(0);
}
}
