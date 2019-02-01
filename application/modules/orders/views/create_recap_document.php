
<!-- Start -->


<section id="content">
	<section class="hbox stretch">
	
<aside class="aside-lg bg-white b-r" id="subNavOrders">

		<header class="dk header b-b">
		<a href="<?=base_url()?>orders/manage/add_recap_document" data-original-title="<?=lang('new_recap_document')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-plus"></i></a>
		<p class="h5" ><strong><span class="text-danger">
		<?php echo  $this->AppModel->get_id('fx_mst_vessels',$array=array('vessel_id' => $this->session->userdata('vessel_active')),'vessel_name');?></span></strong>
		</p>
		
		
		</header>
		<section class="vbox">
			<section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<ul class="nav">
			<?php
			if (!empty($recap_documents)) {$i=1;
			foreach ($recap_documents as $key => $recap_document) {  //$encrypted_string = $this->encrypt->encode($vessel->vessel_id);
					?>
				<li class="b-b b-light"><a href="<?=base_url()?>orders/manage/recap_document_details/<?=$recap_document->recap_id?>">
				<?=$i?>. <?=$recap_document->recap_no?><br>


				</a> </li>
				<?php $i++;} } ?>
			</ul> 
			</div></section>
			</section>
			</aside> 
			
			<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
							<a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active">
							<i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
						<div class="btn-group">
						
						</div>
						
						</div>

					</div> </header>
					<section class="scrollable wrapper w-f">

					 <!-- Start create invoice -->
<div class="col-sm-12">
	<section class="panel panel-default">
	<header class="panel-heading font-bold"><i class="fa fa-info-circle"></i> <?=lang('recap_document_header')?></header>
	<div class="panel-body">

<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'orders/manage/add_recap_document',$attributes); ?>
			 <?php echo validation_errors(); ?>
          		<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('reference_no')?> <span class="text-danger">*</span></label>
				<div class="col-lg-3">

					<input type="text" class="form-control" value="" name="recap_no" maxlength=7>
					<?php
					if (!empty($vessel_defaults)) {
					foreach ($vessel_defaults as $key => $vessel_default) { ?>
					<input type="hidden" class="form-control" value="<?= $vessel_default->vessel_id?>" name="vessel_id" >
					<?php }} ?>
				</div>

				</div>

				<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('transporter_name')?> <span class="text-danger">*</span> </label>
				<div class="col-lg-6">
					<div class="m-b"> 
					<select id="select2-option" style="width:260px" name="transporter_id" >
					<optgroup label="Transporters"> 
					<option value=""></option>
					<?php 
					if (!empty($transporters)) {
						foreach ($transporters as $transporter): ?>
					<option value="<?=$transporter->transporter_id?>"><?=strtoupper($transporter->transporter_name)?></option>
					<?php endforeach; } ?>
					</optgroup> 
					</select> 
					</div> 
				</div>
			</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('receipt_date')?></label> 
				<div class="col-lg-8">
				<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=date('d-m-Y')?>" name="receipt_date" data-date-format="dd-mm-yyyy" >
				</div> 
				</div> 
				<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('due_date')?></label> 
				<div class="col-lg-8">
				<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=date('d-m-Y', strtotime("+30 days"))?>" name="due_date" data-date-format="dd-mm-yyyy" >
				</div> 
				</div> 

			<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('currency')?></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" value="0" name="currency">
				</div>
				</div>				
				
				<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('notes')?> </label>
				<div class="col-lg-8">
				<textarea name="notes" class="form-control"></textarea>
				</div>
				</div>
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> <?=lang('create_recap_document')?></button>


				
		</form>
</div>
</section>
</div>


<!-- End create invoice -->



					</section>  




		</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->






