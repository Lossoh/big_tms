<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <!--<a  class="btn btn-sm green" onclick="add_port()"><i class="fa fa-plus"></i> <?=lang('new_port')?></a>-->
              <a  class="btn btn-sm red" onclick="port_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="port_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('port_details')?></p>
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
                        <th><?=lang('port_code')?> </th>
						<th><?=lang('port_name')?> </th>
						<th><?=lang('port_type')?> </th>						
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($ports)) {
                      foreach ($ports as $port) { ?>
                      <tr>
                        <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_port(<?=$port->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_port(<?=$port->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
						</td>
						<td><?=$port->port_cd?></td>
						<td><?=$port->port_name?></td>
						<td><?=$port->port_type?></td>
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

<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_income')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('port_code')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="input-sm form-control" value="" name="port_code"  placeholder="Input <?=lang('port_code')?>" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('port_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="port_name" placeholder="Input <?=lang('port_name')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('port_type')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <select name="port_type" id="port_type" class="input-sm form-control">
                    <option value="PORT">PORT</option>
                    <option value="WAREHOUSE">WAREHOUSE</option>
                    <option value="DEPO">DEPO</option>
                </select>
            </div>
        </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_port()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>