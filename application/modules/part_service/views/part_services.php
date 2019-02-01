<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <?php
              if($this->user_profile->get_user_access('Created') == 1){
              ?>
                <a class="btn btn-sm green" onclick="add_part_service()"><i class="fa fa-plus"></i> <?=lang('new_part_service')?></a>
              <?php
              }
              if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                 $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
              ?>                              
                <a class="btn btn-sm red" onclick="part_service_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                <a class="btn btn-sm btn-success" onclick="part_service_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
              <?php
              }
              ?>
            </div>
            <p class="pull-left"><?=lang('part_service')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#part_tab" aria-controls="part_tab" role="tab" data-toggle="tab">PART <span class="badge"><?=count($parts)?></span></a></li>
                    <li role="presentation"><a href="#material_tab" aria-controls="material_tab" role="tab" data-toggle="tab">MATERIAL <span class="badge"><?=count($materials)?></span></a></li>
                    <li role="presentation"><a href="#service_tab" aria-controls="service_tab" role="tab" data-toggle="tab">SERVICE <span class="badge"><?=count($services)?></span></a></li>
                    <li role="presentation"><a href="#template_service_tab" aria-controls="template_service_tab" role="tab" data-toggle="tab">TEMPLATE SERVICE <span class="badge"><?=count($templates)?></span></a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="part_tab">
                          <section class="panel panel-default">
                            <div class="table-responsive">
                              <table id="tbl_part" class="table table-striped table-hover b-t b-light text-sm" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th width="10%"><?=lang('options')?></th>
                                    <th>Part <?=lang('code')?></th>
                                    <th><?=lang('part_name')?></th>
                                    <th><?=lang('moving_type')?></th>
                                    <th><?=lang('variant')?></th>
                                    <th><?=lang('brand')?></th>
                                    <th><?=lang('uoms')?></th>
                                    <th>Discount</th>
                                    <th><?=lang('sale_price')?> (Rp)</th>
                                    <th><?=lang('hpp')?> (Rp)</th>
                                    <th><?=lang('reorder')?></th>
                                  </tr> 
                                </thead> 
                                <tbody>
                                  <?php
                                  if (!empty($parts)) {
                                  foreach ($parts as $part) { 
                                    if($part->discount_type == 'price'){
                                        $discount = 'Rp '.number_format($part->discount,0,',','.');
                                    }
                                    else{
                                        $discount = number_format($part->discount,0,',','.').'%';                                        
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
                                                <?php
                                                if($this->user_profile->get_user_access('Updated') == 1){
                                                ?>
            									    <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_part_service(<?=$part->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                                <?php
                                                }
                                                if($this->user_profile->get_user_access('Deleted') == 1){
                                                ?>
                                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_part_service(<?=$part->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                                <?php
                                                }
                                                ?>
            								</ul>
            							  </div>
            						</td>
            						<td><?=$part->code?></td>
            						<td><?=$part->name?></td>
            						<td><?=ucfirst($part->moving_type)?></td>
            						<td><?=$part->variant?></td>
            						<td><?=$part->brand_name?></td>
            						<td align="center"><?=$part->uom_cd?></td>
            						<td align="right"><?=$discount?></td>
            						<td align="right"><?=number_format($part->sale_price,0,',','.')?></td>
            						<td align="right"><?=number_format($part->hpp,0,',','.')?></td>
            						<td><?=number_format($part->reorder,0,',','.')?></td>
                                  </tr>
                                <?php } } ?>
                                
                                
                              </tbody>
                            </table>
            
                          </div>
                        </section>      
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade in" id="material_tab">
                          <section class="panel panel-default">
                            <div class="table-responsive">
                              <table id="tbl_material" class="table table-striped table-hover b-t b-light text-sm" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th width="5%"><?=lang('options')?></th>
                                    <th>Material <?=lang('code')?></th>
                                    <th><?=lang('material_name')?></th>
                                    <th><?=lang('variant')?></th>
                                    <th><?=lang('brand')?></th>
                                    <th><?=lang('uoms')?></th>
                                    <th>Discount</th>
                                    <th><?=lang('sale_price')?> (Rp)</th>
                                    <th><?=lang('hpp')?> (Rp)</th>
                                    <th><?=lang('reorder')?></th>
                                  </tr>
                                </thead> 
                                <tbody>
                                  <?php
                                  if (!empty($materials)) {
                                  foreach ($materials as $material) { 
                                    if($material->discount_type == 'price'){
                                        $discount = 'Rp '.number_format($material->discount,0,',','.');
                                    }
                                    else{
                                        $discount = number_format($material->discount,0,',','.').'%';                                        
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
                                                <?php
                                                if($this->user_profile->get_user_access('Updated') == 1){
                                                ?>
            									    <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_part_service(<?=$material->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                                <?php
                                                }
                                                if($this->user_profile->get_user_access('Deleted') == 1){
                                                ?>
                                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_part_service(<?=$material->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                                <?php
                                                }
                                                ?>
            								</ul>
            							  </div>
            						</td>
            						<td><?=$material->code?></td>
            						<td><?=$material->name?></td>
            						<td><?=$material->variant?></td>
            						<td><?=$material->brand_name?></td>
            						<td align="center"><?=$material->uom_cd?></td>
            						<td align="right"><?=$discount?></td>
            						<td align="right"><?=number_format($material->sale_price,0,',','.')?></td>
            						<td align="right"><?=number_format($material->hpp,0,',','.')?></td>
            						<td><?=number_format($material->reorder,0,',','.')?></td>
                                  </tr>
                                <?php } } ?>
                                
                                
                              </tbody>
                            </table>
            
                          </div>
                        </section>      
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade in" id="service_tab">
                          <section class="panel panel-default">
                            <div class="table-responsive">
                              <table id="tbl_service" class="table table-striped table-hover b-t b-light text-sm" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th width="5%"><?=lang('options')?></th>
                                    <th>Service <?=lang('code')?></th>
                                    <th><?=lang('service_name')?></th>
                                    <th><?=lang('work_hours')?></th>
                                    <th>Discount</th>
                                    <th><?=lang('flat_rate')?> (Rp)</th>
                                  </tr> 
                                </thead> 
                                <tbody>
                                  <?php
                                  if (!empty($services)) {
                                  foreach ($services as $service) { 
                                    if($service->discount_type == 'price'){
                                        $discount = 'Rp '.number_format($service->discount,0,',','.');
                                    }
                                    else{
                                        $discount = number_format($service->discount,0,',','.').'%';                                        
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
                                                <?php
                                                if($this->user_profile->get_user_access('Created') == 1){
                                                ?>
            									    <li><a  href="javascript:void()" title="<?=lang('create_template')?>" onclick="create_template_service('<?=$service->code ?>')"><i class="fa fa-list-alt"></i> <?=lang('create_template')?></a></li>
                                                <?php
                                                }
                                                if($this->user_profile->get_user_access('Updated') == 1){
                                                ?>
            									    <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_part_service(<?=$service->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                                <?php
                                                }
                                                if($this->user_profile->get_user_access('Deleted') == 1){
                                                ?>
                                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_part_service(<?=$service->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                                <?php
                                                }
                                                ?>
            								</ul>
            							  </div>
            						</td>
                                    <td><?=$service->code?></td>
            						<td><?=$service->name?></td>
            						<td><?=number_format($service->work_hours,0,',','.')?></td>
            						<td align="right"><?=$discount?></td>
            						<td align="right"><?=number_format($service->flat_rate,0,',','.')?></td>
                                  </tr>
                                <?php } } ?>
                                
                                
                              </tbody>
                            </table>
            
                          </div>
                        </section>      
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade in" id="template_service_tab">
                          <section class="panel panel-default">
                            <div class="table-responsive">
                              <table id="tbl_template_service" class="table table-striped table-hover b-t b-light text-sm" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th width="5%"><?=lang('options')?></th>
                                    <th>Template <?=lang('code')?></th>
                                    <th><?=lang('template_name')?></th>
                                  </tr> 
                                </thead> 
                                <tbody>
                                  <?php
                                  if (!empty($templates)) {
                                  foreach ($templates as $template) { ?>
                                  <tr>
                                    <td>
            							  <div class="btn-group">
            								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
            								 <?=lang('options')?>
            								<span class="caret"></span>
            								</button>
            								<ul class="dropdown-menu">
                                                <?php
                                                if($this->user_profile->get_user_access('Updated') == 1){
                                                ?>
       									         <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_part_service(<?=$template->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                                <?php
                                                }
                                                if($this->user_profile->get_user_access('Deleted') == 1){
                                                ?>
                                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_part_service(<?=$template->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                                <?php
                                                }
                                                ?>
            								</ul>
            							  </div>
            						</td>
            						<td><?=$template->code?></td>
            						<td><?=$template->name?></td>
                                  </tr>
                                <?php } } ?>
                                
                                
                              </tbody>
                            </table>
            
                          </div>
                        </section>      
                    </div>
                    
                </div>      
          </div>
        </div>
      </section>

    </section>
 <!-- </aside>-->
<!-- /.aside -->

<select class="form-control input-sm" name="services" id="services">
    <option value=""><?=lang('select_your_option')?></option>
    <?php
    foreach($services as $service){
        echo '<option value="'.$service->code.'">'.$service->name.'</option>';
    }
    ?>
</select>
    
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_part_service')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input row">
                    <label class="col-lg-4 control-label"><?=lang('type')?><span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <select class="form-control input-sm" name="type" id="type" onchange="part_service_type()">
                            <option value="part">Part</option>
                            <option value="material">Material</option>
                            <option value="service">Service</option>
                            <option value="template">Template</option>
                        </select>
                        <div id="text_type" style="margin-top: 8px;font-weight: bold;"></div>
                    </div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-lg-4 control-label"><span id="type_name">Part</span> Name<span class="text-danger">*</span></label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control input-sm" name="name" id="name" placeholder="Name" maxlength="150" />
                    </div>
                </div>
                <div class="form-group form-md-line-input row only_part">
                    <label class="col-lg-4 control-label"><?=lang('moving_type')?><span class="text-danger">*</span></label>
                    <div class="col-lg-6">
                        <select class="form-control input-sm" name="moving_type" id="moving_type">
                            <option value="slow">Slow</option>
                            <option value="fast">Fast</option>
                        </select>
                    </div>
                </div>
                <div class="part">
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-4 control-label"><?=lang('variant')?></label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" name="variant" id="variant" placeholder="<?=lang('variant')?>" maxlength="100" />
                        </div>
                    </div>
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-4 control-label"><?=lang('brand')?></label>
                        <div class="col-lg-6">
                            <select class="form-control input-sm all_select2" name="brand_rowID" id="brand_rowID">
                                <option value=""><?=lang('select_your_option')?></option>
                                <?php
                                foreach($brands as $brand){
                                    echo '<option value="'.$brand->rowID.'">'.$brand->brand_name.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-4 control-label"><?=lang('uoms')?></label>
                        <div class="col-lg-5">
                            <select class="form-control input-sm" name="uom_rowID" id="uom_rowID">
                                <option value=""><?=lang('select_your_option')?></option>
                                <?php
                                foreach($uoms as $uom){
                                    echo '<option value="'.$uom->rowID.'">'.$uom->uom_cd.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="service">
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-4 control-label"><?=lang('work_hours')?></label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="work_hours" id="work_hours" placeholder="<?=lang('minute')?>" maxlength="5" value="0" onkeyup="IsNumericOnly(this)" style="text-align: center;" />
                                <span class="input-group-addon" id="basic-addon2"><?=lang('minute')?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-4 control-label"><?=lang('flat_rate')?></label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Rp</span>
                                <input type="text" class="form-control input-sm angka_jutaan" name="flat_rate" id="flat_rate" placeholder="<?=lang('flat_rate')?>" value="0" style="text-align: right;" />
                                <span class="input-group-addon" id="basic-addon2">/<?=lang('minute')?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input row discount">
                    <label class="col-lg-4 control-label">Discount</label>
                    <div class="col-lg-3">
                        <select class="form-control input-sm" name="discount_type" id="discount_type">
                            <option value="price">Price</option>
                            <option value="percent">Percent</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control input-sm angka_jutaan" name="discount" id="discount" placeholder="Discount" value="0" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group form-md-line-input row part">
                    <label class="col-lg-4 control-label"><?=lang('sale_price')?></label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control input-sm angka_jutaan" name="sale_price" id="sale_price" placeholder="<?=lang('sale_price')?>" style="text-align: right;" />
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input row part">
                    <label class="col-lg-4 control-label"><?=lang('hpp')?></label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control input-sm angka_jutaan" name="hpp" id="hpp" placeholder="<?=lang('hpp')?>" style="text-align: right;" />
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input row part">
                    <label class="col-lg-4 control-label"><?=lang('reorder')?></label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control input-sm angka_ribuan" name="reorder" id="reorder" placeholder="<?=lang('reorder')?>" style="text-align: center;" />
                    </div>
                </div>
                <div class="form-group form-md-line-input row part">
                    <label class="col-lg-4 control-label"><?=lang('last_stock')?></label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control input-sm angka_ribuan" name="last_stock" id="last_stock" placeholder="<?=lang('last_stock')?>" value="0" readonly="" style="text-align: center;" />
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="table-responsive template_service">
            <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_template_service">
                <tr valign="middle">
                    <th width="5%">
                        <input id="tamdet" title="Add Row" type="button" onclick="add_template_service()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                    </th>
                    <th width="45%"><?=lang('job_description')?></th>
                    <th width="20%"><?=lang('work_hours')?></th>
                    <th width="30%"><?=lang('flat_rate')?></th>
                </tr>
            </table>
        </div>
        <?=form_close()?>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_part_service()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_template_service" role="dialog">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-template"><?=lang('template_service')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_template_service" class="form-horizontal"')?>
        <input type="hidden" name="code_template" value="">
        <div class="row">
            <div class="col-md-12">
                <br />
                
            </div>
        </div>
        <?=form_close()?>
      </div>
      <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_template_service()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>