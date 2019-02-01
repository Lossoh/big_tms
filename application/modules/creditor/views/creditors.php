<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_creditor()"><i class="fa fa-plus"></i> <?=lang('new_creditor')?></a>
              <a  class="btn btn-sm red" onclick="creditor_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="creditor_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('creditor_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="10%"><?=lang('options')?></th>
                        <th><?=lang('creditor_cd')?></th>
                        <th><?=lang('creditor_name')?> </th>
						<th><?=lang('creditor_phone1')?> </th>
						<th><?=lang('creditor_fax1')?> </th>
						<th><?=lang('creditor_hp1')?> </th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($creditors)) {
                      foreach ($creditors as $creditor) { 
                        $supplier_type = '';
                        if($creditor->supplier_type == 'E'){
                            $supplier_type = '(EXT)';                            
                        }
                        else{
                            $supplier_type = '(INT)';
                        }
                      ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_creditor(<?=$creditor->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_creditor(<?=$creditor->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
                        <td><?=$creditor->creditor_cd?></a></td>
						<td><?=$creditor->creditor_name.' '.$supplier_type?></td>
						<td><?=$creditor->telp_no1 == '' ? '-' : $creditor->telp_no1?></td>
						<td><?=$creditor->fax_no1 == '' ? '-' : $creditor->fax_no1?></td>
						<td><?=$creditor->hp_no1 == '' ? '-' : $creditor->hp_no1?></td>
                        <!--<td>
					  	<a href="<?=base_url()?>creditor/view/update/<?=$creditor->rowID?>" class="btn btn-default btn-xs"  title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>creditor/view/delete/<?=$creditor->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
                      </td>-->
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
  <!--</aside>-->
  <!-- /.aside -->
<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_creditor')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        
            <div class="panel-group" id="accordion">
                <!-- First Panel -->
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-target="#collapseOne" style="cursor: pointer;">
                         <h4 class="panel-title pull-left">
                             <?=lang('creditor_data_vendor')?>
                         </h4>
                         <div class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></div>
                         <div class="clearfix"></div>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                        
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_type')?><span class="text-danger">*</span></label>
                                <div class="col-md-8">
			                         <select class="form-control" name="creditor_type" id="creditor_type" placeholder="<?=lang('select')?>" >	
                                         <!--<option value=" " disabled selected><?=lang('select_your_option')?></option>-->
										 <?php if (!empty($creditor_types)) {
										  foreach ($creditor_types as $creditor_type) { ?>
										  <option value="<?php echo $creditor_type->rowID;?>"><?php echo $creditor_type->type_cd.' - '.$creditor_type->descs;?></option>
										 <?php }} ?>
								    </select> 
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_category')?><span class="text-danger">*</span></label>
                                <div class="col-md-8">
    						          <select  class="form-control" id="creditor_category" name="creditor_category" >
            							<option value="C">Company</option>
            							<option value="I">Individu</option>
    						          </select> 
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label">Supplier Type<span class="text-danger">*</span></label>
                                <div class="col-md-8">
    						          <select  class="form-control" id="supplier_type" name="supplier_type" >
            							<option value="E">External</option>
            							<option value="I">Internal</option>
    						          </select> 
                                </div>
                            </div>
                            <div id="C1">                        
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('creditor_id_type')?></label>
                                    <div class="col-md-8">
        						          <select id="creditor_id_type" class="form-control" id="creditor_id_type" name="creditor_id_type">
                							<option value="K">KTP</option>
                							<option value="S">SIM</option>
                							<option value="P">Passport</option>
        						          </select> 
                                    </div>
                                </div>
                            
                            
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_id_number')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_id_number"  placeholder="Input <?=lang('creditor_id_number')?>" required>
                                </div>
                            </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_name')?><span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_name"  placeholder="<?=lang('creditor_name')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_address')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_address1"  placeholder="Input <?=lang('creditor_address')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_address2"  placeholder="Input <?=lang('creditor_address')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_address3"  placeholder="Input <?=lang('creditor_address')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_postal_code')?></label>
                                <div class="col-lg-8" >
                                    <input type="text"  class="input-sm form-control" value="" name="creditor_postal_code" maxlength="5" onkeyup="angka(this);" placeholder="Input <?=lang('creditor_postal_code')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_phone1')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_phone1" onkeyup="angka(this);" placeholder="Input <?=lang('creditor_phone1')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_phone2')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_phone2" onkeyup="angka(this);" placeholder="Input <?=lang('creditor_phone2')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_fax1')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_fax1" onkeyup="angka(this);" placeholder="Input <?=lang('creditor_fax1')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_fax2')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_fax2" onkeyup="angka(this);" placeholder="Input <?=lang('creditor_fax2')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_contact')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_contact"  placeholder="Input <?=lang('creditor_contact')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_website')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_website"  placeholder="Input <?=lang('creditor_website')?>" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_email')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_email"  placeholder="Input Email" required>
                                </div>
                            </div>
                            
                            <div id='C2'>
                            
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('creditor_hp1')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="creditor_hp1" onkeyup="angka(this);" placeholder="Input Handphone" required>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('creditor_hp2')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="creditor_hp2" onkeyup="angka(this);" placeholder="Input Handphone" required>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('creditor_gender')?><span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                        			<select id="creditor_gender" name="creditor_gender" class="form-control" required>
                                        <option value="M">Male</option>
										<option value="F">Female</option>
                        			</select>
                                    </div>
                    		  </div>
                              
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('creditor_pob')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="creditor_pob"  placeholder="Input <?=lang('creditor_pob')?>" required>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('creditor_dob')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control tanggal_datepicker" value="" name="creditor_dob"  placeholder="dd-mm-yyyy" required>
                                    </div>
                                </div>
                         </div>
                            
                        </div>
                    </div>
                </div>
                
                <!-- Second Panel -->
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-target="#collapseTwo" style="cursor: pointer;">
                         <h4 class="panel-title pull-left">
                             <?=lang('creditor_bank_account')?>
                         </h4>
                         <div class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></div>
                         <div class="clearfix"></div>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_bank_account_no1')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_bank_account_no1"  placeholder="Input Bank Account No" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_bank_account_name1')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_bank_account_name1"  placeholder="Input Bank Account Name 1" required>
                                </div>
                                
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_bank_account_no2')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_bank_account_no2"  placeholder="Input Bank Account No" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_bank_account_name2')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_bank_account_name2"  placeholder="Input Bank Account Name 1" required>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
                <!-- Third Panel -->
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-target="#collapseThree" style="cursor: pointer;">
                         <h4 class="panel-title pull-left">
                             <?=lang('creditor_tax_registered')?>
                         </h4>
                         <div class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></div>
                         <div class="clearfix"></div>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_npwp')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_npwp"  placeholder="Input NPWP" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_npwp_registered')?></label>
                                <div class="col-lg-6">
                                    <input type="text" class="input-sm form-control tanggal_datepicker" value="" name="creditor_npwp_registered"  placeholder="dd-mm-yyyy" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_name_npwp')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_name_npwp"  placeholder="Input NPWP Name" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('creditor_npwp_address')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_npwp_address1"  placeholder="Input NPWP Address" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_npwp_address2"  placeholder="Input NPWP Address" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="creditor_npwp_address3"  placeholder="Input NPWP Address" required>
                                </div>
                            </div>
                            
           
                        </div>
                    </div>
                </div>
                
            </div>


        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_creditor()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>