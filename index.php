<?php
/*  MyApps Development group

    This file is part of Hastymail.

    PDF Invoice Generator is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    PDF Invoice Generator is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Hastymail; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

include 'config.php';
if (isset($_POST["submit"])) {
    //Company / freelancer details   
    $UserCompanyName = filter_var($_POST["usercompany"], FILTER_SANITIZE_STRING);
    $UserAddress = filter_var($_POST["useraddress"], FILTER_SANITIZE_STRING);
    $UserEmail = filter_var($_POST["useremail"], FILTER_SANITIZE_STRING);
    $UserPhone = filter_var($_POST["userphone"], FILTER_SANITIZE_STRING);

    //Reciepient Details
    $recipientCompanyName = filter_var($_POST["recipientcompany"], FILTER_SANITIZE_STRING);
    $recipientName = filter_var($_POST["recipientname"], FILTER_SANITIZE_STRING);
    $recipientAddress = filter_var($_POST["recipientaddress"], FILTER_SANITIZE_STRING);
    $recipientEmail = filter_var($_POST["recipientemail"], FILTER_SANITIZE_STRING);
    $recipientPhone = filter_var($_POST["recipientphone"], FILTER_SANITIZE_STRING);

//Invoice Details
    $invoiceType = filter_var($_POST["type"], FILTER_SANITIZE_STRING);
    $invoiceSubType ="Developer"; //filter_var($_POST["subtype"], FILTER_SANITIZE_STRING);

    $invoiceNumber = rand(1, 100);

//invoice Items
    $cartItems = array();
    //items can be fetched from the database 
    $item = filter_var($_POST["item"], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT);
    $itemNew = array('item' => $item, 'price' => $price); //create a new item
    array_push($cartItems, $itemNew); //push it to main array


    /* sample data
     * $cartItems=array(
      array('item'=>"Webhosting",'price'=>20),
      array('item'=>"Domain",'price'=>40),
      array('item'=>"SSL Cert",'price'=>10),
      array('item'=>"Online Badge",'price'=>5),

      ); */
//value added tax
    $vat = filter_var($_POST["vat"], FILTER_SANITIZE_NUMBER_FLOAT);

//invoice extra Notes
    $extraNotes = filter_var($_POST["notes"], FILTER_SANITIZE_STRING);


//Details for one who is creating the invoice
    $userDetails = array(
        'company' => $UserCompanyName,
        'address' => $UserAddress,
        'email' => $UserEmail,
        'phone' => $UserPhone);
//Reciepient Details
    $recipientDetails = array(
        'company' => $recipientCompanyName,
        'name' => $recipientName,
        'address' => $recipientAddress,
        'email' => $recipientEmail,
        'phone' => $recipientPhone);


    $footerheader = $extraNotes;

    $currency = "$";
    $currencyCode = "USD";
    $total = 0;
    $vatPercentage = 0.3;
//Path to invoice storage
    $invoicePath = "invoices/";
//invoice
    $invoiceName = "invoice_$invoiceNumber.pdf";
//Invoice name/type e.g Quotation ,Invoice
    $invoiceHeaders = array(
        "mainheader" => ucfirst(strtolower($invoiceType)),
        'submainheader' => ucfirst(strtolower($invoiceSubType)));

//Defining Text attributes
    $headerText = array(
        "position" => 'R',
        'font' => 'Arial',
        'weight' => '',
        'size' => 24);
    $accountTypeText = array(
        "position" => 'R',
        'font' => 'Arial',
        'weight' => '',
        'size' => 18);
    $invoiceText = array(
        "position" => 'L',
        'font' => 'Arial',
        'weight' => '',
        'size' => 11);
    $ordinaryText = array(
        "position" => 'L',
        'font' => 'Arial',
        'weight' => '',
        'size' => 12);
//define a color for backgeound
    $white = array('fill' => false, 'red' => 256, 'blue' => 256, 'green' => 256); //white
//include the file to generate the invoice
    include 'libs/createpdf.php';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Create a PDF invoice with PHP</title>
             <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/sweetalert.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <h3 class="text-center">Create a PDF invoice with PHP</h3>
            <div class="col-md-8 col-md-offset-2">
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Invoice Number</label>
                            <input class="form-control" name="number" placeholder="Invoice number" required='required' type="number" />
                        </div>
                     </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Invoice Type</label>
                            <input class="form-control" name="type" placeholder="Invoice type e.g Quotation /Invoice" required='required' type="text" />
                        </div>
                     </div>
                    
                    
                    <div class="col-md-6">
                        <h4>Company Details</h4>
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="usercompany" class="form-control"  required='required' placeholder=" Name" type="text" /></div>
                        <div class="form-group">
                            <label>Address</label>
                            <input class="form-control" name="useraddress" required='required' placeholder="Address" type="text" /></div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="useremail" required='required' placeholder="Email" type="email" /></div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" name="userphone" required='required' placeholder="phone number" type="tel" /></div>
                            </div>
                    <div class="col-md-6">
                        <h4>Customer Details</h4>
                        <div class="form-group">
                            <label>Company</label>
                            <input class="form-control" name="recipientcompany"  placeholder="Company Name" type="text" /></div>
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="recipientname" required='required' placeholder=" Name" type="text" /></div>
                        <div class="form-group">
                            <label>Address</label>
                            <input class="form-control" name="recipientaddress" required='required' placeholder="Address" type="text" /></div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="recipientemail" required='required' placeholder="Email" type="email" /></div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" name="recipientphone" required='required' placeholder="Phone number" type="tel" /></div>
                   </div>
                    
                    <div  class="col-md-12 panel panel-default">
                        
                        <label>Description</label>
                         <div class="form-group"><textarea class="form-control" rows="5" required='required' name="item" placeholder="Item description" ></textarea>
                         </div>
                        <label>Price</label>
                        <div class="form-group"><input class="form-control" required='required' name="price" placeholder="price" type="text" /></div>
                    
                        <label>Vat</label>
                         <div class="form-group"><input class="form-control" required='required' name="vat" placeholder="vat" type="text" /></div>
                    </div>
                       
                              <label>Add Extra Notes</label>           
                        <div class="form-group"><textarea class="form-control" rows="5" name="notes" placeholder="Add a comment"></textarea></div>
                                    
                    <div id="up" align="center"><input class="btn btn-default" name="submit" style="margin-top:60px;" value="Create your Invoice" type="submit" /><br /><br />

<?php
if (isset($_POST["submit"])) {
    echo'<a href="invoices/invoice_'.$invoiceNumber.'.pdf">Download your Invoice</a>';
}
?>
                    </div>
                </form>
        
        <div id="footer" align="center">Created by <a href="http://myapps.co.zw/" target="_blank">MyApps.co.zw</a></div>
    