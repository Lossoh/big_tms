<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
	<ul class="nav">
	<?php 
	if (!empty($vessels)) {
		foreach ($vessels as $key => $vessel) { ?>		
		<li class="b-b b-light <?php if($vessel->vessel_id == $this->uri->segment(4)){ echo "bg-light dk"; } ?>">
		<a href="<?=base_url()?>vessels/manage/<?=$pathArray?>/<?=$vessel->vessel_id?>">
		<?=$vessel->vessel_ref?> - <?=$vessel->vessel_name?>
		<div class="pull-right">
		<span class="label label-<?=$vessel->Kondisi_Ref_Char_01?>"><?=$vessel->Nm_Ref?></span>
		</div> <br>
		<small class="block small text-muted"><?=$vessel->vessel_init?> | <?=strftime("%b %d, %Y", strtotime($vessel->date_created));?></small>
		</a> 
		</li>
	<?php } } ?>
	</ul> 
</div>
