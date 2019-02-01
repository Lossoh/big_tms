<section id="content">
	<section class="hbox stretch">		
		<aside class="aside-lg bg-white b-r" id="subNavOrders">

		<header class="dk header b-b">

		<p class="h5" ><strong><span class="text-danger">
		<?php echo  $this->AppModel->get_id('fx_mst_vessels',$array=array('vessel_id' => $this->session->userdata('vessel_active')),'vessel_name');?></span></strong>
		</p>
		
		
		</header>
		<section class="vbox">
			<section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<ul class="nav">
			<?php
			if (!empty($document_destination_vessel)) {
			foreach ($document_destination_vessel as $key => $doc_des_vessel) {  //$encrypted_string = $this->encrypt->encode($vessel->vessel_id);
					?>
				<li class="b-b b-light"><a href="<?=base_url()?>orders/manage/addsjk/<?=$doc_des_vessel->document_separate_id?>">
				<?=$doc_des_vessel->vessel_ref?> - <?=$doc_des_vessel->vessel_name?> <br>
				PO &nbsp &nbsp &nbsp &nbsp &nbsp : <?=$doc_des_vessel->po_ref?> - <?=strftime("%b %d, %Y", strtotime($doc_des_vessel->po_date));?><br>
				<?=$doc_des_vessel->destination_description?><br>
				TO &nbsp &nbsp &nbsp &nbsp &nbsp : <?=$doc_des_vessel->destination_name?><br>
				ITEM &nbsp &nbsp &nbsp : <?=$doc_des_vessel->item_name?><br>
				CLIENT &nbsp : <?=$doc_des_vessel->client_name?>
				<div class="pull-right">
				<span class="label label-<?=$doc_des_vessel->Kondisi_Ref_Char_01?>"><?=$doc_des_vessel->hNm_Ref?></span>
				</div> <br>
				<small class="block small text-muted"><?=$doc_des_vessel->vessel_init?> | <?=strftime("%b %d, %Y", strtotime($doc_des_vessel->date_created));?></small>

				</a> </li>
				<?php } } ?>
			</ul> 
			</div></section>
			</section>
			</aside> 
			
			<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
							<a href="#subNavOrders" data-toggle="class:hide" class="btn btn-sm btn-default active">
							<i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
						

						</div>

					</div> </header>
					<section  class="scrollable w-f">
						<div class="slim-scroll" id="detail_vessel" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
								
						</div>




					</section>  




		</section> </aside> </section>  </section>



<!-- end -->