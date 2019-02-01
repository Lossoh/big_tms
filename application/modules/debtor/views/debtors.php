<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_debtor()"><i class="fa fa-plus"></i> <?=lang('new_debtor')?></a>
              <a  class="btn btn-sm red" onclick="debtor_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="debtor_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('debtor_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <?php
              if($this->session->flashdata('success') != ''){
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Success!</strong> <br /> <?=$this->session->flashdata('success')?>
                </div>
              <?php
              }
              else if($this->session->flashdata('error') != ''){
              ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> <?=$this->session->flashdata('error')?>
                </div>
              <?php
              }
              ?>
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="10%"><?=lang('options')?></th>
                        <th><?=lang('debtor_cd')?></th>
                        <th><?=lang('debtor_name')?> </th>
                        <th>Type</th>
						<th><?=lang('debtor_pob')?> </th>
						<th><?=lang('debtor_dob')?> </th>
						<th><?=lang('debtor_id_type')?> </th>
						<th><?=lang('debtor_id_number')?> </th>
                        <th><?=lang('picture')?></th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($debtors)) {
                      foreach ($debtors as $debtor) { 
                         if ($debtor->type == 'D'){
                            if ($debtor->spare_driver == 0){
                                $class_debtor = 'Driver';
                            }
                            else{
                                $class_debtor = 'Spare Driver';
                            }
                         }else if ($debtor->type == 'C'){
                            $class_debtor = 'Company';
                         }else if ($debtor->type == 'E'){
                            $class_debtor = 'Employee';
                         }
                         else if ($debtor->type == 'M'){
                            $class_debtor = 'Mechanic';
                         }
                         
                         if ($debtor->id_type == 'S'){
                            $class_id = 'SIM';
                         }
                         else if ($debtor->id_type == 'P'){
                            $class_id = 'Passport';
                         }else if ($debtor->id_type == 'O'){
                            if($debtor->type == 'C')
                                $class_id = '-';
                            else
                                $class_id = 'Other';
                         } 
                        
                        $star = '';
                        if ($debtor->type == 'D'){
                            if($debtor->debtor_photo == '' && $debtor->debtor_photo_ktp == '' && $debtor->debtor_photo_sim == ''){
                                $star = '*';
                            }
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
									<li><a href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_debtor(<?=$debtor->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_debtor(<?=$debtor->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
                        <td><?=$debtor->type?><?=$debtor->debtor_cd?></a></td>
						<td><?=$debtor->debtor_name?><span style="color: #C00;"><?=$star?></span></td>
                        <td><?=$class_debtor?></td>
						<td><?=$debtor->pob == '' ? '-' : ucwords(strtolower($debtor->pob))?></td>
						<td><?=date("d F Y",strtotime($debtor->dob))?></td>
						<td><?=$class_id?></td>
						<td><?=$debtor->id_no == '' ? '-' : $debtor->id_no?></td>
                        <td>
                            <button class="btn btn-success" title="<?=lang('upload_photos')?>" onclick="upload_photo_debtor(<?=$debtor->rowID ?>,'<?=$debtor->debtor_photo ?>','<?=$debtor->debtor_photo_ktp ?>','<?=$debtor->debtor_photo_sim ?>')"><i class="fa fa-upload"></i> </button>
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
  <!--</aside>-->
  <!-- /.aside -->
<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-debtor"><?=lang('new_debtor_type')?></h3>
      </div>
      <div class="modal-body form">
        <?= form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        
            <div class="panel-group" id="accordion">
                <!-- First Panel -->
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-target="#collapseOne" style="cursor: pointer;">
                         <h4 class="panel-title pull-left">
                             <?=lang('debtor_data_customer')?>
                         </h4>
                         <div class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></div>
                         <div class="clearfix"></div>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                        
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_code_type')?> <span class="text-danger">*</span></label>
                                <div class="col-md-8">
			                         <select class="form-control" name="debtor_code" id="debtor_code" onchange="debtor_code_type()" placeholder="<?=lang('select')?>" >
										 <option value=""><?=lang('select_your_option')?></option>
                                         <?php if (!empty($debtors_type)) {
										  foreach ($debtors_type as $debtor_type) { ?>
										  <option value="<?php echo $debtor_type->rowID;?>"><?php echo $debtor_type->type_cd.' - '.$debtor_type->name;?></option>
										 <?php }} ?>
								    </select> 
                                </div>
                            </div>
                            <input type="hidden" name="debtor_category_type" value="" />
                            
                            <div id="field_spare_driver" style="display: none;">
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label">Spare Driver</label>
                                    <div class="col-md-1">
        						          <input type="checkbox" class="form-control" name="spare_driver" id="spare_driver" value="1" onclick="spare_driver_date()" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="input-sm form-control text-center tanggal_datetimepicker" value="" name="active_period" id="active_period" placeholder="Active Period" style="display: none;" />
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label">Finger ID <span class="text-danger">*</span></label>
                                    <div class="col-md-2">
                                        <input type="text" class="input-sm form-control" value="" name="finger_rowID" id="finger_rowID" onkeyup="angka(this);" maxlength="5" required="" style="text-align: center;" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtortype_category')?> <span class="text-danger">*</span></label>
                                <div class="col-md-8">
    						          <select  class="form-control" id="debtor_category" name="debtor_category">
            							<option value="C">Company</option>
            							<option value="I">Individu</option>
    						          </select> 
                                </div>

                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label">Debtor Type <span class="text-danger">*</span></label>
                                <div class="col-md-8">
    						          <select  class="form-control" id="debtor_type" name="debtor_type">
            							<option value="internal">Internal</option>
            							<option value="external">External</option>
    						          </select> 
                                </div>

                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_name')?> <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_name"  placeholder="Input Debtor Name" required>
                                </div>
                            </div>
                            <div id='D1'>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_no_ktp')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="debtor_no_ktp" id="debtor_no_ktp" maxlength="16" onkeyup="angka(this);" placeholder="Input ID Number" required>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_expired_date_ktp')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control tanggal_datetimepicker" value="" name="debtor_expired_date_ktp" id="debtor_expired_date_ktp" placeholder="<?=lang('debtor_expired_date_id')?>" required>
                                    </div>
                                </div>                        
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_id_type')?></label>
                                    <div class="col-md-8">
        						          <select id="debtor_id_type" class="form-control" id="debtor_id_type" name="debtor_id_type">
                							<option value="S">SIM</option>
                							<option value="P">Passport</option>
                							<option value="O">Other</option>
        						          </select> 
                                    </div>
    
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_id_number')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="debtor_id_number" maxlength="40" placeholder="Input ID Number" required>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_expired_date_id')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control tanggal_datetimepicker" value="" name="debtor_expired_date_id" id="debtor_expired_date_id" placeholder="<?=lang('debtor_expired_date_id')?>" required>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_address')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_address1"  placeholder="Input Debtor Address" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_address2"  placeholder="Input Debtor Address" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_address3"  placeholder="Input Debtor Address" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_postal_code')?></label>
                                <div class="col-lg-8" >
                                    <input type="text"  class="input-sm form-control" value="" name="debtor_postal_code" maxlength="5" onkeyup="angka(this);" placeholder="Input Postal Code" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_phone1')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_phone1" onkeyup="angka(this);" placeholder="Input Postal Code" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_phone2')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_phone2" onkeyup="angka(this);" placeholder="Input Postal Code" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_fax1')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_fax1" onkeyup="angka(this);" placeholder="Input Debtor Fax 1" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_fax2')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_fax2" onkeyup="angka(this);" placeholder="Input Debtor Fax 1" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_contact')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_contact"  placeholder="Input Contact Person" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_website')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_website"  placeholder="Input Website" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_email')?></label>
                                <div class="col-lg-8">
                                    <input type="email" class="input-sm form-control" value="" name="debtor_email"  placeholder="Input Email" required>
                                </div>
                            </div>
                            <div id="D2">
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_hp1')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="debtor_hp1" onkeyup="angka(this);" placeholder="Input Handphone" required>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_hp2')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="debtor_hp2" onkeyup="angka(this);" placeholder="Input Handphone" required>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_gender')?><span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                        			<select id="debtor_gender" name="debtor_gender" class="form-control" required>
                                        <option value="M">Male</option>
										<option value="F">Female</option>
                        			</select>
                                    </div>
                   		       </div>
                              
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_pob')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="debtor_pob"  placeholder="Input Place of Birth" required>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-lg-4 control-label"><?=lang('debtor_dob')?></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="input-sm form-control" value="" name="debtor_dob" id="debtor_dob" placeholder="dd-mm-yyyy" required>
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
                             <?=lang('debt_bank_account')?>
                         </h4>
                         <div class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></div>
                         <div class="clearfix"></div>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_bank_account_no1')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_bank_account_no1"  placeholder="Input Bank Account No" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_bank_account_name1')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_bank_account_name1"  placeholder="Input Bank Account Name 1" required>
                                </div>
                                
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_bank_account_no2')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_bank_account_no2"  placeholder="Input Bank Account No" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_bank_account_name2')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_bank_account_name2"  placeholder="Input Bank Account Name 1" required>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
                <!-- Third Panel -->
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-target="#collapseThree" style="cursor: pointer;">
                         <h4 class="panel-title pull-left">
                             <?=lang('debt_tax_registered')?>
                         </h4>
                         <div class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></div>
                         <div class="clearfix"></div>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_npwp')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_npwp"  placeholder="Input NPWP" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_npwp_registered')?></label>
                                <div class="col-lg-6">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_npwp_registered" id="debtor_npwp_registered" placeholder="dd-mm-yyyy" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_name_npwp')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_npwp_name"  placeholder="Input NPWP Name" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"><?=lang('debtor_npwp_address')?></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_npwp_address1"  placeholder="Input NPWP Address" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_npwp_address2"  placeholder="Input NPWP Address" required>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                    <input type="text" class="input-sm form-control" value="" name="debtor_npwp_address3"  placeholder="Input NPWP Address" required>
                                </div>
                            </div>
                            
           
                        </div>
                    </div>
                </div>
                             
            </div>

            <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_debtor()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<div class="modal fade" id="modal_form_upload" role="dialog">
  <div class="modal-dialog" style="width:650px;height:200px;">
    <div class="modal-content">
      <?= form_open(base_url().'debtor/upload_photo','autocomplete="off" id="form" class="form-horizontal" enctype="multipart/form-data"')?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-upload"><?=lang('upload_photos')?></h3>
      </div>
      <div class="modal-body form">
        <input type="hidden" name="upload_rowid" value="" />
        <div class="form-group form-md-line-input">
            <div class="col-lg-6">
                <label class="control-label">Upload <?=lang('personal_photo')?></label>
                <br /><br />
                <input type="file" name="userfile[]" id="userfile" class="form-control input-sm" placeholder="Photo" />
                <span style="font-size: 10px;color: #C00">*) File max 5 MB and must be gif, jpg, and png formats.</span>
            </div>
            <div class="col-lg-6">
                <label class="control-label">Preview <?=lang('personal_photo')?></label>
                <div class="text-center">
                    <img id="personal_photo" class="img-responsive img-thumbnail" width="75%" alt="<?=lang('personal_photo')?>" />
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <div class="col-lg-6">
                <label class="control-label">Upload <?=lang('ktp_photos')?></label>
                <br /><br />
                <input type="file" name="userfile[]" id="userfile" class="form-control input-sm" placeholder="Photo" />
                <span style="font-size: 10px;color: #C00">*) File max 5 MB and must be gif, jpg, and png formats.</span>
            </div>
            <div class="col-lg-6">
                <label class="text-center control-label">Preview <?=lang('ktp_photos')?></label>
                <div class="text-center">
                    <img id="ktp_photos" class="img-responsive img-thumbnail" width="100%" alt="<?=lang('ktp_photos')?>" style="height: 200px !important;" />
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <div class="col-lg-6">
                <label class="text-center control-label">Upload <?=lang('sim_photos')?></label>
                <br /><br />
                <input type="file" name="userfile[]" id="userfile" class="form-control input-sm" placeholder="Photo" />
                <span style="font-size: 10px;color: #C00">*) File max 5 MB and must be gif, jpg, and png formats.</span>
            </div>
            <div class="col-lg-6">
                <label class="text-center control-label">Preview <?=lang('sim_photos')?></label>
                <div class="text-center">
                    <img id="sim_photos" class="img-responsive img-thumbnail" width="100%" alt="<?=lang('sim_photos')?>" style="height: 200px !important;" />
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btnUpload" class="btn green">Upload</button>
        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
      </div>
      <?=form_close()?>
    </div>
  </div>
</div>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>