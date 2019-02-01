<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_transporter')?></a>
          <p><?=lang('registered_transporters')?></p>
		  								<div class="col-sm-4 m-b-xs pull-right">
									<a href="<?=base_url()?>fopdf/contoh" target='_blank' class="btn btn-sm btn-dark pull-right">
									<i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?></a>
									
								</div>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="transporters" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('transporter_ref')?></th>
                        <th><?=lang('transporter_name')?> </th>
                        <th><?=lang('address_1')?></th>
						<th><?=lang('city')?></th>
						<th><?=lang('pic_1')?></th>
						<th><?=lang('truck_total')?></th>
						<th><?=lang('options')?></th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($transporters)) {
                      foreach ($transporters as $transporter) { ?>
						<tr>
						  <td><?=$transporter->transporter_ref?></a></td>
						  <td><?=$transporter->transporter_name?></td>
						  <td><?=$transporter->address_1?></td>
						  <td><?=$transporter->city?></td>
						  <td><?=$transporter->pic_1?></td>
						  <td>
						  	<a href="<?=base_url()?>transporters/view/details/<?=$transporter->transporter_id?>" class="btn btn-default btn-xs" title="<?=lang('truck_details')?>"><?=$this->transporter_model->transpoter_truck_total($transporter->transporter_id);
							?><br><i class="fa fa-truck"></i> </a>
						  </td>
						  <td>
							<a href="<?=base_url()?>transporters/view/update/<?=$transporter->transporter_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
							<a href="<?=base_url()?>transporters/view/delete/<?=$transporter->transporter_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
						  </td>
						</tr>
                    <?php } } ?>
                    
                    
                  </tbody>
                </table>

              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  </aside>
  <!-- /.aside -->

  <!-- .aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
		<?php
		echo form_open(base_url().'transporters/create'); ?>
		<?php echo validation_errors(); ?>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('transporter_ref')?> <span class="text-danger">*</span></label>
			<input type="text" name="transporter_ref" placeholder="Input Transporter Reference" value="<?=set_value('transporter_ref')?>" class="input-sm form-control" required>
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('transporter_name')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Transporter Name" name="transporter_name" value="<?=set_value('transporter_name')?>" class="input-sm form-control" required>
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('address_1')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Address Line One Name" name="address_1" value="<?=set_value('address_1')?>" class="input-sm form-control" required>
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('address_2')?></label>
			<input type="text" placeholder="Input Address Line Two Name" name="address_2" value="<?=set_value('address_2')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('address_3')?> </label>
			<input type="text" placeholder="Input Address Line Three Name" name="address_3" value="<?=set_value('address_3')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('city')?></label>
			<input type="text" placeholder="Input City Name" name="city" value="<?=set_value('city')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('pic_1')?><span class="text-danger">*</span></label>
			<input type="text" placeholder="Input PIC One Name" name="pic_1" value="<?=set_value('pic_1')?>" class="input-sm form-control" required>
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('pic_2')?></label>
			<input type="text" placeholder="Input PIC Two Name" name="pic_2" value="<?=set_value('pic_2')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('pic_3')?></label>
			<input type="text" placeholder="Input PIC Three Name" name="pic_3" value="<?=set_value('pic_3')?>" class="input-sm form-control">
		</div>
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_item')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>