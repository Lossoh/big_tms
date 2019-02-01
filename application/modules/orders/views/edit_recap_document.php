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
				<li class="b-b b-light"><a href="<?=base_url()?>orders/manage/addsjk/<?=$recap_document->recap_id?>">
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