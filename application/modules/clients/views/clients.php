<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_client')?></a>
          <p><?=lang('registered_clients')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('client_ref')?></th>
                        <th><?=lang('client_name')?> </th>
                        <th><?=lang('address_1')?></th>
						<th><?=lang('city')?></th>
						<th><?=lang('pic_1')?></th>
						<th><?=lang('destination_name')?></th>
						<th><?=lang('options')?></th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($clients)) {
                      foreach ($clients as $client) { ?>
						<tr>
						  <td><?=$client->client_ref?></a></td>
						  <td><?=$client->client_name?></td>
						  <td><?=$client->address_1?></td>
						  <td><?=$client->city?></td>
						  <td><?=$client->pic_1?></td>
						  <td><?=$client->destination_name?></td>
						  <td>
							<a href="<?=base_url()?>clients/view/update/<?=$client->client_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
							<a href="<?=base_url()?>clients/view/delete/<?=$client->client_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
		echo form_open(base_url().'clients/create'); ?>
		<?php echo validation_errors(); ?>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('Kode Department')?> <span class="text-danger">*</span></label>
			<input type="text" name="client_ref" placeholder="Input Client Reference" value="<?=set_value('client_ref')?>" class="input-sm form-control" required>
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('client_name')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Client Name" name="client_name" value="<?=set_value('client_name')?>" class="input-sm form-control" required>
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
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_name')?><span class="text-danger">*</span></label>
			<br>
			          <div class="sm-b"> 
			          <select id="select2-option" style="width:260px" name="destination_id" required> 			          
			          <optgroup label="Destinations"> 
			            <?php
			            if (!empty($destinations)) {
			            foreach ($destinations as $key => $d) { ?>
			            <option value="<?=$d->destination_id?>"><?=strtoupper($d->destination_name)?></option>
			            <?php }} ?>
			          </optgroup> 
			          </select> 
			          </div> 
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