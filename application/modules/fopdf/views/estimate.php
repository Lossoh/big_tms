<?php
//Set default date timezone
date_default_timezone_set('America/Los_Angeles');

//Create a new instance
$estimate = new invoicr("A4",$this->config->item('default_currency_symbol'),"en");
//Set number formatting
$estimate->setNumberFormat($this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
//Set your logo
$estimate->setLogo(base_url()."resource/images/logos/".$this->config->item('invoice_logo'));
//Set theme color
$estimate->setColor("#FB6B5B");
//Set type
$estimate->setType("Estimate");
//Set reference
if (!empty($estimate_details)) {
			foreach ($estimate_details as $key => $e) {

$estimate->setReference($e->reference_no);
//Set date
$estimate->setDate(strftime("%b %d, %Y", strtotime($e->date_saved)));
//Set due date
$estimate->setDue(strftime("%b %d, %Y", strtotime($e->due_date)));
//Set from
$estimate->setFrom(array($this->config->item('company_name'),$this->config->item('company_address'),$this->config->item('company_city'),$this->config->item('company_country'),lang('phone').': '.$this->config->item('company_phone')));
//Set to
$estimate->setTo(array(
    $this->applib->company_details($e->client,'company_name'),
	$this->applib->company_details($e->client,'company_address'),
	$this->applib->company_details($e->client,'city'),
	lang('country').': '.$this->applib->company_details($e->client,'country'),
	lang('vat').': '.$this->applib->company_details($e->client,'VAT')));
// Calculate estimate
$est_tax = $e->tax;
$estimate_cost = $this->user_profile->estimate_payable($e->est_id);
$tax = ($est_tax/100) * $estimate_cost;
//Add items
if (!empty($estimate_items)) {
					foreach ($estimate_items as $key => $item) { 
$estimate->addItem($item->item_desc,false,$item->quantity,$est_tax."%",round($item->unit_cost,2),false,round($item->total_cost,2));
} } 
//Add totals
$estimate->addTotal(lang('total')." ",round($estimate_cost,2));
$estimate->addTotal(lang('vat')." ".$est_tax."%",round($tax,2));
$estimate->addTotal(lang('estimate_cost')." ",round($estimate_cost + $tax,2),true);
//Set badge
$estimate->addBadge($e->status);
//Add title
$estimate->addTitle(lang('payment_information'));
//Add Paragraph
$estimate->addParagraph($e->notes);
//Set footer note
$estimate->setFooternote($this->config->item('company_name'));

//Render
$estimate->render('Estimate '.$e->reference_no.'.pdf','D');
} }
?>