<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
            <p class="pull-left"><?=lang('planning_order_monitor')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title"><?=lang('planning_order').' '.lang('date')?> : <?=date('d F Y', strtotime($date_monitor))?></div>
                </div>
                <div class="panel-body">
                    <?=form_open(base_url().'planning_order_monitor/set_date_monitor','autocomplete="off" id="form" class="form-horizontal"')?>
                    <div class="row">
                        <div class="col-md-2"><input type="text" name="date_monitor" class="form-control input-sm tanggal_datetimepicker" value="<?=date('d-m-Y', strtotime($date_monitor))?>" style="text-align: center;" required="" /></div>
                        <div class="col-md-4"><button class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button></div>
                        <div class="col-md-6"></div>
                    </div>
                    <?=form_close()?>
                    <br />
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table id="tbl_part" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th width="5%"><?=lang('no')?></th>
                            <th width="12%"><?=lang('police_no')?></th>
                            <th width="12%"><?=lang('ritase_target')?></th>
                            <th width="20%"><?=lang('spk_total')?></th>
                            <th width="20%"><?=lang('total_realization')?></th>
                            <th><?=lang('information')?></th>
                          </tr> 
                        </thead> 
                        <tbody>
                        <?php
                        if(!empty($vehicles)){
                            $no = 1;
                            foreach($vehicles as $vehicle){
                                $check_condition = $this->planning_order_monitor_model->check_condition($vehicle->rowID);
                                $get_spk_total = $this->planning_order_monitor_model->check_spk_by_vehicle($vehicle->rowID,$date_monitor);
                                $get_realization_total = $this->planning_order_monitor_model->check_realization_by_vehicle($vehicle->rowID,$date_monitor);
                                $check_po = $this->planning_order_monitor_model->check_po_by_vehicle($vehicle->rowID,$date_monitor);
                                $ritase = 0;
                                $info_jo = '';    
                                if(count($check_po) > 0){
                                    foreach($check_po as $row_po){
                                        $ritase += $row_po->ritase;
                                        $info_jo .= '<a href="javascript:void()" title="'.lang('detail_job_order').'" onclick="detail_job_order_monitor(\''.$row_po->jo_no.'\', \''.$row_po->vessel_name.'\', \''.$row_po->from_name.' - '.$row_po->to_name.'\')">'.$row_po->jo_no.'</a>, ';
                                    }
                        ?>
                                    <tr>
                                        <td><?=$no?></td>
                                        <td><?=$vehicle->police_no?></td>
                                        <td><?=number_format($ritase,0,',','.')?></td>
                                        <td><?=number_format($get_spk_total->spk_total,0,',','.')?></td>
                                        <td><?=number_format($get_realization_total->realization_total,0,',','.')?></td>
                                        <td align="justify">
                                            <?=substr($info_jo,0,-2)?>
                                        </td>
                                    </tr>
                        <?php
                                }
                                else{
                        ?>
                                    <tr>
                                        <td><?=$no?></td>
                                        <td><?=$vehicle->police_no?></td>
                                        <td><?=number_format($ritase,0,',','.')?></td>
                                        <td><?=number_format($get_spk_total->spk_total,0,',','.')?></td>
                                        <td><?=number_format($get_realization_total->realization_total,0,',','.')?></td>
                                        <td><?=$check_condition->condition?></td>
                                    </tr>
                        <?php
                                }
                                
                                $no++;
                            }
                        } 
                        ?>
                        
                      </tbody>
                    </table>
    
                  </div>
               </div>
            </div> 
            <p>&nbsp;</p>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Planning Order Graph</div>
                </div>
                <div class="panel-body">
                    <?=form_open(base_url().'planning_order_monitor/view_graph','autocomplete="off" id="form_graph" class="form-horizontal"')?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                                <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=$start_date?>">
                                <span class="input-group-addon" style="width: 50px;">to</span>
                                <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=$end_date?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </div>
                    <?=form_close()?>
                    <p>&nbsp;</p>
                    <div id="view_graph"></div>
                </div>
            </div>    
          </div>
        </div>
      </section>

    </section>
 <!-- </aside>-->
  <!-- /.aside -->
  
  
<div class="modal fade" id="modal_jo_detail" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('detail_job_order')?></h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-3"><?=lang('job_order_no')?></div>
            <div class="col-md-9"><b id="jo_no"></b></div>
        </div>
        <div class="row">
            <div class="col-md-3"><?=lang('vessel_name')?></div>
            <div class="col-md-9"><b id="vessel_name"></b></div>
        </div>
        <div class="row">
            <div class="col-md-3"><?=lang('destination')?></div>
            <div class="col-md-9"><b id="destination"></b></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>


<script>
$(function() {
    var categories = [<?=$categories?>];
    var ritase_total = [<?=$ritase_total?>];
    var spk_total = [<?=$spk_total?>];
    var realization_total = [<?=$realization_total?>];
    
    $('#view_graph').highcharts({
        title: {
            text: 'Period Planning Order',
            x: -20 //center
        },
        subtitle: {
            text: '<?=$this->config->item('comp_name')?>',
            x: -20
        },
        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: 'Total'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Ritase',
            data: ritase_total
        }, {
            name: 'SPK',
            data: spk_total
        }, {
            name: 'Realization',
            data: realization_total
        }]
    });
    
});

</script>