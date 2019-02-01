<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
            <p class="pull-left"><?=lang('all_activities')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
            	<div class="table-responsive">
            		<table class="table table-striped table-hover b-t b-light text-sm" id="tbl-activities">
            			<thead>
            				<tr>					
            					<th><?=lang('no')?></th>
            					<th><?=lang('module')?></th>
            					<th><?=lang('activity')?> </th>
            					<th><?=lang('activity_date')?></th>
            				</tr> 
                        </thead> 
                        <tbody>
            			<!-- 	<?php
            				if (!empty($activities)) {
            				    $no = 1;
            					foreach ($activities as $key => $a) { 
                            ?>
            				    <tr>
                    				<td align="center"><?=$no++?></td>
                    				<td><?=strtoupper($a->module)?></td>
                    				<td><?=$a->activity?></td>
                    				<td><?=date('d F Y H:i:s',strtotime($a->activity_date))?></td>
                    			</tr>
                 			<?php 
                                }
                            } 
                            else{ 
                            ?>
            				    <tr>
                                    <td colspan="3"><?=lang('nothing_to_display')?></td>
            					</tr>
            				<?php 
                            } 
                            ?>
            			 -->
                        </tbody>
                    </table>
                </div>
               
                <!-- Paging manual
                <div class="row">
    				<div class="col-sm-4 hidden-xs">
        				<?php
        				$query = $this->db->where('user_rowID',$this->tank_auth->get_user_id())->get('activities');
                        $records_found = $query->num_rows();
                        ?>
    				</div>
    				<div class="col-sm-4 text-center"> 
                        <small class="text-muted inline m-t-sm m-b-sm">Showing <?=$records_found?> <?=lang('activities')?></small>
    				</div>
                    <div class="col-sm-4 text-right text-center-xs">
			         	
                        <div class="mt40 clearfix">
                            <?php      
                                $this->load->library('pagination');
                                $config['base_url'] = site_url().'profile/activities/';
                                $config['total_rows'] = $records_found;
                                $config['full_tag_open'] = '<ul class="pagination pagination-sm m-t-none m-b-none">';
                                $config['full_tag_close'] = '</ul>';
                                $config['per_page'] = 30;
                                $config['uri_segment'] = 3;
                                $this->pagination->initialize($config);
                                echo $this->pagination->create_links();
                            ?>               
                        </div>
                    </div>
                </div>
                -->
                
              </section>
            </div>
          </div>
        </section>
      </section>
  </section>       
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
<script type="text/javascript">
    $(function () {
        var table = $('#tbl-activities').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>profile/fetch_data",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "no", "orderable": false, "searchable": false
                },
                {
                    "data": "module"
                },
                {
                    "data": "activity"
                },
                {
                    "data": "activity_date"
                }
            ],
            order: [0, "DESC"]
        });
    });
</script>