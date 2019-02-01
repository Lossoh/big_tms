<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="<?php echo base_url().'employee/create'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_employee')?></a>
          <p><?=lang('employee_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('employee_code')?></th>
                        <th><?=lang('employee_name')?> </th>
						<th><?=lang('employee_telp1')?> </th>
						<th><?=lang('employee_hp1')?> </th>
						 <th><?=lang('actions')?> </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($employees)) {
                      foreach ($employees as $employee) { ?>
                      <tr>
                        <td><?=$employee->debtor_cd?></a></td>
						<td><?=$employee->debtor_name?></td>
						<td><?=$employee->telp_no1?></td>
						<td><?=$employee->hp_no1?></td>
                        <td>
					  	<a href="<?=base_url()?>employee/view/update/<?=$employee->rowID?>" class="btn btn-default btn-xs"  title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>employee/view/delete/<?=$employee->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>