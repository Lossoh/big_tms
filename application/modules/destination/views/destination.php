<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
   <!-- <aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_destination()"><i class="fa fa-plus"></i> <?=lang('new_destination')?></a>
              <a  class="btn btn-sm red" onclick="destination_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="destination_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('registered_destination')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th><?=lang('destination_code')?></th>
                        <th><?=lang('destination_name')?> </th>
                        <th><?=lang('address_1')?></th>
						<th><?=lang('address_2')?></th>
						<th><?=lang('address_3')?></th>
						<th><?=lang('debtor_postal_code')?></th>
                        <th><?=lang('destination_contact_person')?></th>
                        <th><?=lang('destination_phone')?></th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($destinations)) {
                      foreach ($destinations as $destination) { ?>
						<tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="Copy to Port" onclick="copy_to_port(<?=$destination->rowID ?>)"><i class="fa fa-copy"></i> Copy to Port</a></li>
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_destination(<?=$destination->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_destination(<?=$destination->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
							  </div>
						  </td>
						  <td><?=$destination->destination_no?><span style="color: #C00;"><?=$destination->coordinate_rowID == 0 ? '*' : ''?></span></a></td>
						  <td><?=$destination->destination_name?></td>
						  <td><?=$destination->address1?></td>
						  <td><?=$destination->address2?></td>
						  <td><?=$destination->address3?></td>
                          <td><?=$destination->post_cd?></td>
                          <td><?=$destination->contact_prs?></td>
                          <td><?=$destination->telp_no?></td>
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
 <!-- </aside>-->
  <!-- /.aside -->

  <!-- .aside -->
  <!--
<aside class="aside-lg bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
		<?php
		echo form_open(base_url().'destinations/create'); ?>
		<?php echo validation_errors(); ?>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_ref')?> <span class="text-danger">*</span></label>
			<input type="text" name="destination_ref" placeholder="Input Destination Reference" value="<?=set_value('destination_ref')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_name')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Destination Name" name="destination_name" value="<?=set_value('destination_name')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('address_1')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Address Line One Name" name="address_1" value="<?=set_value('address_1')?>" class="input-sm form-control">
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
			<label><?=lang('destination_flag')?> <span class="text-danger">*</span></label>
			<select name="destination_flag" class="form-control"> 
				<option value="1">Sumber</option>
				<option value="2">Client</option>
				<option value="3">POK</option>
			</select>
		</div>
 
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_item')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
-->
<!-- /.aside -->
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_copy" role="dialog">
  <div class="modal-dialog" style="width:30%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Copy to Port</h3>
      </div>
      <?=form_open('','autocomplete="off" id="form_copy" class="form-horizontal"')?>
      <div class="modal-body form">
        <input type="hidden" name="destination_rowID" value="" />
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('port_type')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <select name="port_type" id="port_type" class="input-sm form-control">
                    <option value=""><?=lang('select_your_option')?></option>
                    <option value="PORT">PORT</option>
                    <option value="WAREHOUSE">WAREHOUSE</option>
                    <option value="DEPO">DEPO</option>
                </select>
            </div>
        </div>
        
      </div>  
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save_copy_to_port()" class="btn green">Save</button>
        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('add_destination')?></h3>
      </div>
      <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
      <div class="modal-body form">
        <input type="hidden" name="rowID" value="">
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('destination_code')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="input-sm form-control" value="" name="destination_code"  placeholder="Input <?=lang('destination_code')?>" maxlength="3" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('destination_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="destination_name" placeholder="Input <?=lang('destination_name')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('koordinat_poi')?></label>
            <div class="col-lg-8">
                <select name="coordinate_rowID" id="coordinate_rowID" class="input-sm form-control all_select2">
                    <option value="0"><?=lang('select_your_option')?></option>
                    <?php 
                    if (!empty($coordinates)) {
                        foreach ($coordinates as $coordinate) { 
                    ?>
                            <option value="<?php echo $coordinate->rowID;?>"><?php echo $coordinate->location_name;?></option>
                    <?php 
                        }
                    } 
                    ?>
                </select>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('address_1')?></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="destination_address1" placeholder="Input <?=lang('address_1')?>" autocomplete="off" class="input-sm form-control" >
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="destination_address2" placeholder="Input <?=lang('address_2')?>" autocomplete="off" class="input-sm form-control" >
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="destination_address3" placeholder="Input <?=lang('address_3')?>" autocomplete="off" class="input-sm form-control" >
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtor_postal_code')?></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="destination_postal_code" placeholder="Input <?=lang('debtor_postal_code')?>" onkeyup="angka(this);" maxlength="5" autocomplete="off" class="input-sm form-control" >
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('destination_contact_person')?></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="destination_contact_person" placeholder="Input <?=lang('destination_contact_person')?>" autocomplete="off" class="input-sm form-control" >
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('destination_phone')?></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="destination_phone" placeholder="Input <?=lang('destination_phone')?>" onkeyup="angka(this);" autocomplete="off" class="input-sm form-control">
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save_destination()" class="btn green">Save</button>
        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>