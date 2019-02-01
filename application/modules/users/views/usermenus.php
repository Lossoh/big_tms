<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm btn-dark" href="<?=base_url()?>users/account" ><i class="fa fa-arrow-left"></i> <?=ucwords(lang('back'))?></a>
              <a  class="btn btn-sm green" onclick="add_usermenu()"><i class="fa fa-plus"></i> <?=lang('new_usermenu')?></a>
            </div>
            <p class="pull-left"><?=lang('usermenus')?> - <?=$fullname?></p>
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
                        <th><?=lang('menu_name')?> </th>
						<th><?=lang('menu_parent')?> </th>
						<th><?=lang('status')?> </th>
						</tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($usermenus)) {
                      foreach ($usermenus as $usermenu) { ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_usermenu(<?=$usermenu->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_usermenu(<?=$usermenu->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
						<td><?=$usermenu->Nm_Menu?></td>
						<td>
                            <?php                    
                            $get_menu = $this->menu_model->get_by_id('sa_menu',$usermenu->ParentID);
                            if(count($get_menu) > 0)
                                echo ucwords($get_menu->Nm_Menu);
                            else
                                echo 'Parent';
                            ?>
                        </td>
                        <td><?=$usermenu->StatusUsermenu == '1' ? '<span class="badge bg-success">'.lang('active').'</span>' : '<span class="badge" style="background-color:#f0ad4e;">'.lang('notactive').'</span>' ?></td>
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
        <h3 class="modal-title"><?=lang('new_usermenu')?></h3>
      </div>
      <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
      <div class="modal-body form">
            <input type="hidden" name="rowID" value="">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <input type="hidden" name="kd_menu_tmp" value="">
            
           	<div class="row">
               <div class="col-lg-6">
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('menu')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="kd_menu" id="cmb_kd_menu" class="form-control" required>
                        <?php
                          if (!empty($menus)) {
                              foreach ($menus as $menu) {
                                //$cek_usermenu = $this->usermenu_model->get_usermenu_by_menu_id($menu->Seq_Menu);
                                //if(count($cek_usermenu) == 0){
                        ?>
        				        <option value="<?=$menu->Seq_Menu?>"><?=$menu->Nm_Menu?></option>
                        <?php 
                                //}
                              }
                          }?>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('availabled')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="availabled" id="availabled" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('created')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="created" id="created" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('viewed')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="viewed" id="viewed" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('updated')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="updated" id="updated" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('deleted')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
            			<select name="deleted" id="deleted" class="form-control" required>
            		        <option value="1"><?=lang('yes')?></option>
            		        <option value="0"><?=lang('no')?></option>
            			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('status')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="checkbox" name="status" class="form-control"  id="chk_status" checked>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('approved')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="approved" id="approved" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('verified')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="verified" id="verified" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('verified')?> Second<span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="verified_second" id="verified_second" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('fullaccess')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="fullaccess" id="fullaccess" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('printlimited')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="printlimited" id="printlimited" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('printunlimited')?><span class="text-danger">*</span></label>
                    <div class="col-lg-8">
        			<select name="printunlimited" id="printunlimited" class="form-control" required>
        		        <option value="1"><?=lang('yes')?></option>
        		        <option value="0"><?=lang('no')?></option>
        			</select>
                    </div>
        		</div>    
                   
              </div>
              </div>   
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_usermenu()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
