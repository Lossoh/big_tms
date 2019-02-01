<section id="content">
          <section class="hbox stretch">
            <!-- .aside -->
            <aside>
              <section class="vbox">
               <header class="header bg-white b-b b-light">
                  <a href="#" data-toggle="modal" data-target="#modalAddNewUser" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_user')?></a>
                  <p><?=lang('users')?></p>
                </header>
                <section class="scrollable wrapper">

                  <div class="row">			
				<div class="col-lg-12">
					<section class="panel panel-default">

						<div class="table-responsive">
							<table id="clients" class="table table-striped m-b-none">
								<thead>
									<tr>
									<th><?=lang('full_name')?></th>	
									<th><?=lang('username')?> </th>
									<th><?=lang('company')?> </th>
									<th><?=lang('role')?> </th>
									<th class="hidden-sm"><?=lang('registered_on')?> </th>
									<th class="hidden-sm"><?=lang('avatar_image')?></th>
									<th><?=lang('options')?></th>
									</tr> 
                                    </thead> <tbody>
			<?php
			if (!empty($users)) {
			foreach ($users as $key => $user) { ?>
									<tr>
									
									<td><?=$user->fullname?></td>
									<td><?=ucwords($user->username)?></td>
									<!--
                                    <td><a href="<?=base_url()?>companies/view/details/<?=$user->company?>" class="text-info">
									<?php //echo $this->applib->company_details($user->company,'company_name')?></a></td>
									-->
                                    <td><?=ucwords($user->company)?></td>	
                                        <td><?php
					if ($this->user_profile->role_by_id($user->role_rowID) == 'admin') {
						$span_badge = 'label label-danger';
					}elseif ($this->user_profile->role_by_id($user->role_rowID) == 'collaborator') {
						$span_badge = 'label label-primary';
					}
					else{
						$span_badge = '';
					}
					?><span class="<?=$span_badge?>">
					<?=ucfirst($this->user_profile->role_by_id($user->role_rowID))?></span></td>
										<td class="hidden-sm"><?=strftime("%b %d, %Y", strtotime($user->created));?> </td>
									<td class="hidden-sm">
                                        <a class="pull-left thumb-sm avatar"><img src="<?=base_url()?>resource/avatar/<?=$user->avatar?>" class="img-circle"></a>
									</td>
					<td>
                    <a href="<?=base_url()?>users/usermenu/setting/<?=$user->user_rowID?>" class="btn btn-sm blue" title="<?=lang('btnusermenu')?>"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="<?=base_url()?>users/view/update/<?=$user->rowID?>" class="btn btn-sm yellow" data-toggle="ajaxModal" title="<?=lang('update')?>"><i class="fa fa-edit"></i> </a>
					<a class="btn btn-sm red" title="Reset Password" onclick="reset_password(<?=$user->user_rowID?>)"><i class="fa fa-refresh"></i> </a>
					<?php
					if ($user->username != $this->tank_auth->get_username()) { ?>
					<a href="<?=base_url()?>users/account/delete/<?=$user->user_rowID?>" class="btn btn-sm red" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
					<?php } ?>
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
      </section>
    

<div class="modal fade" id="modalAddNewUser" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?=lang('new_user')?></h4>
      </div>
      <?php echo form_open(base_url().'auth/register_user', 'autocomplete="off"'); ?>
      <div class="modal-body">
           <?php echo $this->session->flashdata('form_errors'); ?>
           <input type="hidden" name="r_url" value="<?=base_url()?>users/account">
           <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-md-line-input">
    				    <label><?=lang('full_name')?> <span class="text-danger">*</span></label>
    					<input type="text" class="input-sm form-control" value="<?=set_value('fullname')?>" placeholder="E.g John Doe" name="fullname" required>
    				</div>
                      <div class="form-group form-md-line-input">
                        <label><?=lang('username')?> <span class="text-danger">*</span></label>
                        <input type="text" name="username" placeholder="Min. 4 & Max. 20 Character" value="<?=set_value('username')?>" class="input-sm form-control" required>
                      </div>
                      <div class="form-group form-md-line-input">
                        <label><?=lang('email')?> <span class="text-danger">*</span></label>
                        <input type="email" placeholder="johndoe@me.com" name="email" value="<?=set_value('email')?>" class="input-sm form-control" required>
                      </div>
    			      <div class="form-group form-md-line-input">
    				    <label><?=lang('phone')?> </label>
    					<input type="text" class="input-sm form-control" value="<?=set_value('phone')?>" onkeyup="angka(this);" name="phone">
 				      </div>
                      <div class="form-group form-md-line-input">
    				    <label><?=lang('departement')?> </label>
    					<select class="form-control" name="departement" > 
    			        <?php 
                            if (!empty($departements)) {
                                foreach ($departements as $departement){ 
                        ?>
                                    <option value="<?=$departement->rowID?>" <?=$user->dep_rowID == $departement->rowID ? 'selected' : ''?>><?=$departement->dep_name?></option>
    	                <?php 
                                }
                            } 
                        ?>
    			        </select> 
 				      </div>                      
                </div>
                <div class="col-md-6">
                  <div class="form-group form-md-line-input">
                    <label><?=lang('password')?> <span class="text-danger">*</span></label>
                    <input type="password" placeholder="<?=lang('password')?>" value="<?=set_value('password')?>" name="password"  class="input-sm form-control" required>
                  </div>
                  <div class="form-group form-md-line-input">
                    <label><?=lang('confirm_password')?> <span class="text-danger">*</span></label>
                    <input type="password" placeholder="<?=lang('confirm_password')?>" value="<?=set_value('confirm_password')?>" name="confirm_password"  class="input-sm form-control" required>
                  </div>
                  <div class="form-group form-md-line-input">
			        <label><?=lang('company')?> </label>
			        <select class="form-control" style="width:200px" name="company" > 
			          <option value="<?=$this->config->item('comp_name')?>"><?=$this->config->item('comp_name')?></option>
			          </select> 
			      </div>
                  <div class="form-group form-md-line-input">
                    <label><?=lang('role')?></label>
                    <div>
                      <select name="role" class="form-control">
                      <?php
                      if (!empty($roles)) {
                      foreach ($roles as $r) { ?>
                      	 <option value="<?=$r->rowID?>"><?=ucfirst($r->role)?></option>
                      <?php } } ?>
                          </select>
                    </div>
                  </div>
                </div>
           </div> 
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn green"><?=lang('save')?></button>
            <button type="button" class="btn red" data-dismiss="modal"><?=lang('close')?></button>
        </div>
        <?= form_close()?>
        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>          

