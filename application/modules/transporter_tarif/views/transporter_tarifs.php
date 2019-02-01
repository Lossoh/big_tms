<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
                <div class="row">
                    <div class="col-lg-12" style="padding-left: 0px;">
                        <?php
                        if($this->user_profile->get_user_access('Created') == 1){
                        ?>
                            <a  class="btn btn-sm green" onclick="add_transporter_tarif()"><i class="fa fa-plus"></i> <?=lang('new_transporter_tarif')?></a>
                        <?php
                        }
                        if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                            $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                        ?>
                            <a  class="btn btn-sm red" onclick="transporter_tarif_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                            <a  class="btn btn-sm btn-success" onclick="transporter_tarif_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>     
            </div>
            <p class="pull-left"><?=lang('transporter_tarif')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table class="table table-striped table-hover b-t b-light text-sm tbl-data">
                    <thead>
                      <tr>
                        <th width="10%"><?=lang('options')?></th>
                        <th><?=lang('creditor_type_name')?> </th>
						<th><?=lang('jo_type')?> </th>
						<th><?=lang('cargo_name')?> </th>
						<th><?=lang('from')?> </th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($transporter_tarifs)) {
                        foreach ($transporter_tarifs as $transporter_tarif) {                         
                            $jo_type = '';
                            if($transporter_tarif->jo_type == 1)
                                $jo_type = 'BULK';
                            else if($transporter_tarif->jo_type == 2)
                                $jo_type = 'CONTAINER';
                            else if($transporter_tarif->jo_type == 3)
                                $jo_type = 'OTHERS';
                      ?>
                      <tr>
                        <td align="center">
						  <div class="btn-group">
							<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
							 <?=lang('options')?>
							<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
                                <?php
                                if($this->user_profile->get_user_access('Updated') == 1){
                                ?>
								    <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_transporter_tarif(<?=$transporter_tarif->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                <?php
                                }
                                
                                if($this->user_profile->get_user_access('Deleted') == 1){
                                ?>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_transporter_tarif(<?=$transporter_tarif->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                <?php
                                }
                                ?>
							</ul>
                            
						  </div>
						</td>
						<td><?=$transporter_tarif->creditor_name?></td>
						<td><?=$jo_type?></td>
						<td><?=$transporter_tarif->item_name?></td>
						<td><?=$transporter_tarif->destination_no.' - '.$transporter_tarif->destination_name?></td>
                    </tr>
                    <?php 
                        } 
                    } 
                    ?>
                    
                  </tbody>
                </table>

              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
    <!--</aside>-->
    <select class="form-control input-sm" name="vehicle_type" id="vehicle_type">
        <?php
            if (!empty($vehicle_categories)) {
                echo "<option value=''>".lang('select_your_option')."</option>";
                foreach ($vehicle_categories as $row_vehicle) {
    		      echo '<option value="'.$row_vehicle->rowID.'">'.$row_vehicle->type_name.'</option>';
                }
            }
        ?>
    </select> 

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width: 50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_transporter_tarif')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <input type="hidden" name="edit" id="edit" />        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('creditor_type_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control input-sm all_select2" name="creditor_rowID" id="creditor_rowID">
                    <?php
                        echo "<option value=''>".lang('select_your_option')."</option>";
                        if (!empty($creditors)) {
                            foreach ($creditors as $creditor) {
                		      echo '<option value="'.$creditor->rowID.'">'.$creditor->creditor_name.'</option>';
                            }
                        }
                    ?>
                </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('jo_type')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control input-sm" name="jo_type" id="jo_type">
                    <option value="">Select Job Order Type</option>
					<option value="1">BULK</option>
					<option value="2">CONTAINER</option>
					<option value="3">OTHERS</option>
                </select>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('cargo_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control input-sm all_select2" name="cargo_rowID" id="cargo_rowID">
                    <?php
                        echo "<option value=''>".lang('select_your_option')."</option>";
                        if (!empty($cargos)) {
                            foreach ($cargos as $cargo) {
                		      echo '<option value="'.$cargo->rowID.'">'.$cargo->item_name.'</option>';
                            }
                        }
                    ?>
                </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('from')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control input-sm all_select2" name="from_rowID" id="from_rowID">
                    <?php
                        echo "<option value=''>".lang('select_your_option')."</option>";
                        if (!empty($destinations)) {
                            foreach ($destinations as $destination) {
                		      echo '<option value="'.$destination->rowID.'">'.$destination->destination_no.' - '.$destination->destination_name.'</option>';
                            }
                        }
                    ?>
                </select> 
            </div>
        </div>
        <p>&nbsp;</p>
          <div class="bs-example"> 
                <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_tarif">
                    <tr valign="middle">
                        <th width="5%">
                            <input id="tamdet" title="Add Row" type="button" onclick="add_tarif()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                        </th>
                        <th width="35%"><?=lang('to')?></th>
                        <th width="30%"><?=lang('vehicle_category')?></th>
                        <th width="30%"><?=lang('price')?> (Rp/Kg)</th>
                    </tr>
                </table>
          </div>         
              
          <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_transporter_tarif()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>