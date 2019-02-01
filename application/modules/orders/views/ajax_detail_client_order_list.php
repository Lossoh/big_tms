<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
			<ul class="nav">
			<?php
			if (!empty($document_destination_vessel)) {
			foreach ($document_destination_vessel as $key => $doc_des_vessel) {  //$encrypted_string = $this->encrypt->encode($vessel->vessel_id);
					?>
				<input type="hidden" name="filter_client_id" value="<?=$doc_des_vessel->client_id?> ">	
				<li class="b-b b-success <?php if($doc_des_vessel->document_separate_id == $this->uri->segment(4)){ echo "bg-success dk"; } ?>"><a href="<?=base_url()?>orders/manage/<?=$linkdata?>/<?=$doc_des_vessel->document_separate_id?>">
				<?=$doc_des_vessel->vessel_ref?> - <?=$doc_des_vessel->vessel_name?> <br>
				PO &nbsp &nbsp &nbsp &nbsp &nbsp : <?=$doc_des_vessel->po_ref?> - <?=strftime("%b %d, %Y", strtotime($doc_des_vessel->po_date));?><br>
				<?=$doc_des_vessel->destination_description?><br>
				TO &nbsp &nbsp &nbsp &nbsp &nbsp : <?=$doc_des_vessel->destination_name?><br>
				ITEM &nbsp &nbsp &nbsp : <?=$doc_des_vessel->item_name?><br>
				CLIENT &nbsp : <?=$doc_des_vessel->client_name?>
				<div class="pull-right">
				<span class="label label-<?=$doc_des_vessel->Kondisi_Ref_Char_01?>"><?=$doc_des_vessel->hNm_Ref?></span>
				</div> <br>
				<small class="block small text-error"><?=$doc_des_vessel->vessel_init?> | <?=strftime("%b %d, %Y", strtotime($doc_des_vessel->date_created));?></small>

				</a> </li>
				<?php } } ?>
			</ul> 
			</div>
