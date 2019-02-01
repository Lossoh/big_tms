<section id="content"> <section class="vbox"> <section class="scrollable padder">
	<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
		<li><a href="<?=base_url()?>"><i class="fa fa-home"></i> <?=lang('home')?></a></li>
		<li class="active"><a href="<?=base_url()?>templates"><?=lang('templates')?></a></li>
	</ul>
	<div class="row">
	<!-- Project Tasks -->
	<div class="col-lg-6">
	<section class="panel panel-default">
	<header class="panel-heading"> <i class="fa fa-navicon"></i> <?=lang('project')?> <?=lang('tasks')?></header>
	<div class="row text-sm wrapper">
		<div class="col-sm-5 m-b-xs">
			
			<a href="<?=base_url()?>templates/save_task" class="btn btn-sm btn-dark" data-toggle="ajaxModal"><i class="fa fa-plus"></i> <?=lang('add_task')?></a>
		</div>
		<div class="col-sm-1 m-b-xs">
			
		</div>


		<div class="col-sm-6">
			<?php echo form_open(base_url().'templates/search_task/'); ?>
			<div class="input-group">
				<input type="text" class="input-sm form-control" name="keyword" placeholder="<?=lang('keyword')?>">
				<span class="input-group-btn"> <button class="btn btn-sm btn-default" type="submit"><?=lang('go')?></button>
				</span>
			</div>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover b-t b-light text-sm">
			<thead>
				<tr>
					<th><?=lang('task_name')?></th>
					<th><?=lang('visible')?> </th>
					<th><?=lang('estimated_hours')?> </th>
					<th><?=lang('options')?></th>
				</tr> </thead> <tbody>
				<?php
								if (!empty($project_tasks)) {
				foreach ($project_tasks as $key => $task) { ?>
				<tr>
					<td>
					<a href="#" class="text-primary" data-toggle="popover" data-html="true" data-placement="right" data-content="<?=$task->task_desc?>" title="" data-original-title="<button type=&quot;button&quot; class=&quot;close pull-right&quot; data-dismiss=&quot;popover&quot;>×</button><?=lang('tasks')?> <?=lang('description')?>">
					<?=$task->task_name?></a></td>
					<td><?=$task->visible?></td>
					<td><strong><?=$task->estimate_hours?> <?=lang('hours')?></strong></td>
					<td>
					<a href="<?=base_url()?>templates/edit_task/<?=$task->template_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal">
					<i class="fa fa-edit"></i></a>
					<a href="<?=base_url()?>templates/delete_task/<?=$task->template_id?>" class="btn btn-dark btn-xs" data-toggle="ajaxModal">
					<i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				<?php  }} else{ ?>
				<tr>
					<td></td><td><?=lang('nothing_to_display')?></td><td></td><td></td>
				</tr>
				<?php } ?>
				
				
				
			</tbody>
		</table>
	</div>

<footer class="panel-footer">
				<div class="row">
				<div class="col-sm-2 hidden-xs">
				<?php
				 $tasks_found = $this->db->get('saved_tasks')->num_rows();
                ?>
				</div>
				<div class="col-sm-2 text-center"> 
				</div>
				<div class="col-sm-8 text-right text-center-xs">
				<!-- Paging-->
            <div class="mt40 clearfix">
                      <?php
                                   

                                  
                                        $this->load->library('pagination');
                                        $config['base_url'] = site_url().'templates/list_items/';
                                        $config['total_rows'] = $tasks_found;
                                        $config['full_tag_open'] = '<ul class="pagination pagination-sm m-t-none m-b-none">';
                                        $config['full_tag_close'] = '</ul>';
                                        $config['per_page'] = 20;
                                        $config['uri_segment'] = 3;
                                        $this->pagination->initialize($config);
                                        echo $this->pagination->create_links();
                                        ?>
               
            </div>
				</div>
				</div>
</footer>
</div>
<!-- End Project Tasks -->
<!-- Invoice Items -->
	<div class="col-lg-6">
	<section class="panel panel-default">
	<header class="panel-heading"> <i class="fa fa-navicon"></i> <?=lang('invoice')?> <?=lang('items')?></header>
	<div class="row text-sm wrapper">
		<div class="col-sm-5 m-b-xs">
			
			<a href="<?=base_url()?>templates/add_item" class="btn btn-sm btn-dark" data-toggle="ajaxModal"><i class="fa fa-plus"></i> <?=lang('new_item')?></a>
		</div>
		<div class="col-sm-1 m-b-xs">
			
		</div>


		<div class="col-sm-6">
			<?php echo form_open(base_url().'templates/search/'); ?>
			<div class="input-group">
				<input type="text" class="input-sm form-control" name="keyword" placeholder="<?=lang('keyword')?>">
				<span class="input-group-btn"> <button class="btn btn-sm btn-default" type="submit"><?=lang('go')?></button>
				</span>
			</div>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover b-t b-light text-sm">
			<thead>
				<tr>
					<th><?=lang('item_description')?></th>
					<th><?=lang('unit_price')?> </th>
					<th><?=lang('options')?></th>
				</tr> </thead> <tbody>
				<?php
								if (!empty($invoice_items)) {
				foreach ($invoice_items as $key => $item) { ?>
				<tr>
					<td><?=$item->item_desc?></td>
					<td><?=$this->config->item('default_currency')?> <?=number_format($item->unit_cost,2)?></td>
					<td>
					<a href="<?=base_url()?>templates/edit_item/<?=$item->item_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal">
					<i class="fa fa-edit"></i></a>
					<a href="<?=base_url()?>templates/delete_item/<?=$item->item_id?>" class="btn btn-dark btn-xs" data-toggle="ajaxModal">
					<i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				<?php  }} else{ ?>
				<tr>
					<td></td><td><?=lang('nothing_to_display')?></td><td></td><td></td>
				</tr>
				<?php } ?>
				
				
				
			</tbody>
		</table>
	</div>

<footer class="panel-footer">
				<div class="row">
				<div class="col-sm-1 hidden-xs">
				<?php
				 $items_found = $this->db->where('deleted','No')->get('items_saved')->num_rows();
                ?>
				</div>
				<div class="col-sm-1 text-center"> 
				</div>
				<div class="col-sm-10 text-right text-center-xs">
				<!-- Paging-->
            <div class="mt40 clearfix">
                      <?php
                                   

                                  
                                        $this->load->library('pagination');
                                        $config['base_url'] = site_url().'templates/list_items/';
                                        $config['total_rows'] = $items_found;
                                        $config['full_tag_open'] = '<ul class="pagination pagination-sm m-t-none m-b-none">';
                                        $config['full_tag_close'] = '</ul>';
                                        $config['per_page'] = 20;
                                        $config['uri_segment'] = 3;
                                        $this->pagination->initialize($config);
                                        echo $this->pagination->create_links();
                                        ?>
               
            </div>
				</div>
				</div>
</footer>
</div>
<!-- End Invoice Items -->
</div>

	</section>
</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>