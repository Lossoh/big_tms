<?php
//Set default date timezone
date_default_timezone_set('America/Los_Angeles');
if (!empty($invoice_details)) {
			foreach ($invoice_details as $key => $inv) { 
//Create a new instance
$invoice = new invoicr("A4",$inv->currency,"en");
//Set number formatting
$invoice->setNumberFormat($this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
//Set your logo
$invoice->setLogo(base_url()."resource/images/logos/".$this->config->item('invoice_logo'));
//Set theme color
$invoice->setColor("#53B567");
//Set type
$invoice->setType("Invoice");
//Set reference

$invoice->setReference($inv->reference_no);
//Set date
$invoice->setDate(strftime("%b %d, %Y", strtotime($inv->date_saved)));
//Set due date
$invoice->setDue(strftime("%b %d, %Y", strtotime($inv->due_date)));
//Set from
$invoice->setFrom(array(
                  $this->config->item('company_name'),
                  $this->config->item('company_address'),
                  $this->config->item('company_city'),
                  $this->config->item('company_country'),
                  lang('company_vat').': '.$this->config->item('company_vat')
                  ));
//Set to
$invoice->setTo(array(
    $this->applib->company_details($inv->client,'company_name'),
	$this->applib->company_details($inv->client,'company_address'),
	$this->applib->company_details($inv->client,'city'),
	lang('country').': '.$this->applib->company_details($inv->client,'country'),
	lang('vat').': '.$this->applib->company_details($inv->client,'VAT')));
// Calculate Invoice
$inv_tax = $inv->tax;
$invoice_cost = $this->user_profile->invoice_payable($inv->inv_id);
$payment_made = $this->user_profile->invoice_payment($inv->inv_id);
$tax = ($inv_tax/100) * $invoice_cost;
//Add items
if (!empty($invoice_items)) {
					foreach ($invoice_items as $key => $item) { 
$invoice->addItem($item->item_desc,false,$item->quantity,$inv_tax."%",round($item->unit_cost,2),false,round($item->total_cost,2));
} } 
//Add totals
$invoice->addTotal(lang('total')." ",round($invoice_cost,2));
$invoice->addTotal(lang('vat')." ".$inv_tax."%",round($tax,2));
$invoice->addTotal(lang('paid')." ",round($payment_made,2));
$invoice->addTotal(lang('balance_due')." ",round(($invoice_cost + $tax) - $payment_made,2),true);
//Set badge
$invoice->addBadge($payment_status);
//Add title
$invoice->addTitle(lang('payment_information'));
//Add Paragraph
$invoice->addParagraph($inv->notes);
//Set footer note
$invoice->setFooternote('tes');

//Render
$invoice->render('INVOICE '.$inv->reference_no.'.pdf','D');
} }
?>