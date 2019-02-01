<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_menu()"><i class="fa fa-plus"></i> <?=lang('new_menu')?></a>
            </div>
            <p class="pull-left"><?=lang('menus')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="10%"><?=lang('options')?></th>
                        <th><?=lang('menu_code')?> </th>
						<th><?=lang('menu_name')?> </th>
						<th><?=lang('menu_parent')?> </th>
						<th><?=lang('menu_link')?> </th>
						<th><?=lang('status')?> </th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($menus)) {
                      foreach ($menus as $menu) { ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_menu(<?=$menu->Seq_Menu ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_menu(<?=$menu->Seq_Menu ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
						<td>
                            <div class="pull-left">
                                <div id="view_<?=$menu->Seq_Menu ?>"><?=$menu->Kd_Menu?></div>
                                <div id="input_<?=$menu->Seq_Menu ?>" style="display: none;"><input type="text" class="form-control input-xs" id="kode_menu_<?=$menu->Seq_Menu ?>" value="<?=$menu->Kd_Menu?>" onkeyup="angka(this)" style="width: 50%;text-align:center" /></div>
                            </div>
                            <div class="pull-right">
                                <div>
                                    <a href="#" onclick="changeOrderMenu(<?=$menu->Seq_Menu ?>)" id="link_<?=$menu->Seq_Menu ?>"><i class="fa fa-edit"></i> <?=lang('change')?></a>
                                    <a href="#" onclick="saveOrderMenu(<?=$menu->Seq_Menu ?>)" id="save_<?=$menu->Seq_Menu ?>" style="display: none;"><i class="fa fa-save"></i> <?=lang('save_menu')?></a>
                                </div>
                            </div>
                        </td>
						<td><?=$menu->Nm_Menu?></td>
						<td>
                            <?php                    
                            $get_menu = $this->menu_model->get_by_id('sa_menu',$menu->ParentID);
                            if(count($get_menu) > 0)
                                echo ucwords($get_menu->Nm_Menu);
                            else
                                echo 'Parent';
                            ?>
                        </td>
						<td><?=$menu->Link_Menu?></td>
						<td><?=$menu->status == '1' ? '<span class="badge bg-success">'.lang('active').'</span>' : '<span class="badge" style="background-color:#f0ad4e;">'.lang('notactive').'</span>' ?></td>
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
  </section>
  
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_menu')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="seq_menu" value="">
        	
        <div class="form-group form-md-line-input" style="display: none;">
            <label class="col-lg-4 control-label"><?=lang('menu_code')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control"  name="kd_menu" placeholder="Input Menu Code" onkeyup="angka(this)" maxlength="10" value="<?=$menu_id?>" autocomplete="off" readonly="" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('menu_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="nm_menu" placeholder="Input Menu Name" value="" autocomplete="off" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('menu_link')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="link_menu" placeholder="Input Menu Link" value="" autocomplete="off" required>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('menu_language')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="lang" placeholder="Input Menu Language" value="" autocomplete="off" required>
            </div>
        </div>
        
  		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('menu_parent')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="parentid" id="parentid" class="form-control" required>
				<option value="0">- Parent -</option>
                <?php
                  if (!empty($parent_menus)) {
                      foreach ($parent_menus as $parent) { 
                ?>
				        <option value="<?=$parent->Seq_Menu?>"><?=$parent->Nm_Menu?></option>
                <?php 
                      }
                  }?>
			</select>
            </div>
		</div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('status')?><span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <input type="checkbox" name="status" class="form-control"  id="chk_status" checked>
            </div>
        </div>
              
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_menu()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
