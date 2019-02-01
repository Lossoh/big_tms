<section id="content" style="background-color: #fff;"> 
	<section class="vbox"> 
		<section class="scrollable padder">
		<div class="m-b-md"> 
			<h3 class="m-b-none"><?=lang('dashboard')?></h3>
            <br />
			<h4>
                <strong>
        			<?=lang('welcome_back')?>, 
                    <?=$this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') ? $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') : $this->tank_auth->get_username(); ?>.
                </strong>
            </h4>
            
            <p>&nbsp;</p>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="fa fa-bar-chart"></i> Cash Advance and Realization Monitoring</div>
                </div>
                <div class="panel-body">
                    <div id="chart_ca_rea" style="min-width: 310px; height: 400px; margin: 0 auto">&nbsp;</div>
                </div>
            </div>
            
            <p>&nbsp;</p>      
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="fa fa-pie-chart"></i> Vehicle by Category Monitoring</div>
                </div>
                <div class="panel-body">
                    <div class="form-group form-md-line-input row">
                        <?=form_open('home/set_filter','autocomplete="off" id="form" class="form-horizontal"')?>
                        <label class="col-md-1 control-label text-right">Period : </label>
                        <div class="col-md-3">
                            <div class="input-group input-daterange">
                                <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=$start_date?>">
                                <span class="input-group-addon">to</span>
                                <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=$end_date?>">
                            </div> 
                        </div>
                        <div class="col-md-1" style="padding-left: 0px;"> 
                            <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Search</button>
                        </div>
                        <?=form_close()?>
                    </div>
                    <p>&nbsp;</p>
                    <div id="vehicle_category" style="height: 400px; margin: 0 auto">&nbsp;</div>
                    <div id="vehicle_category_tmp" style="min-width: 310px; height: 400px; margin: 0 auto;text-align: center;">
                        <h4 style="color: #000;">Vehicle by Category Monitoring</h4>
                        Period on <?=$start_date?> to <?=$end_date?> <br />
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>No data to display</p>
                    </div>
                </div>
            </div>
                   
            <p>&nbsp;</p>      
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="fa fa-pie-chart"></i> Top Ten Driver</div>
                </div>
                <div class="panel-body">
                    <div class="form-group form-md-line-input row">
                        <?=form_open('home/set_filter','autocomplete="off" id="form" class="form-horizontal"')?>
                        <label class="col-md-1 control-label text-right">Period : </label>
                        <div class="col-md-3">
                            <div class="input-group input-daterange">
                                <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=$start_date?>">
                                <span class="input-group-addon">to</span>
                                <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=$end_date?>">
                            </div> 
                        </div>
                        <div class="col-md-1" style="padding-left: 0px;"> 
                            <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Search</button>
                        </div>
                        <?=form_close()?>
                    </div>
                    <p>&nbsp;</p>
                    <div id="achievement_driver" style="height: 400px; margin: 0 auto">&nbsp;</div>
                    <div id="achievement_driver_tmp" style="min-width: 310px; height: 400px; margin: 0 auto;text-align: center;">
                        <h4 style="color: #000;">Top Ten Driver</h4>
                        Period on <?=$start_date?> to <?=$end_date?> <br />
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>No data to display</p>
                    </div>
                </div>
            </div>
                        
		</div>	
		</section>
	</section>
</section>

<script>
$(function() {
    <?php
    if(count($vehicle_category) > 0){
        echo "
            $('#vehicle_category_tmp').hide();
            $('#vehicle_category').show();    
        ";
    }
    else{
        echo "
            $('#vehicle_category_tmp').show();
            $('#vehicle_category').hide();    
        ";        
    }
    
    if(count($achievement_driver) > 0){
        echo "
            $('#achievement_driver_tmp').hide();
            $('#achievement_driver').show();    
        ";
    }
    else{
        echo "
            $('#achievement_driver_tmp').show();
            $('#achievement_driver').hide();    
        ";        
    }
    ?>
    
    var categories = [<?=$categories?>];
    $('#chart_ca_rea').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Cash Advance and Realization Monitoring'
        },
        subtitle: {
            text: 'Period of the last 7 days'
        },
        xAxis: [{
            categories: categories,
            reversed: true,
            labels: {
                step: 1
            }
        },{ // mirror axis on right side
            opposite: true,
            reversed: true,
            categories: categories,
            linkedTo: 0,
            labels: {
                step: 1
            }
        }],
        yAxis: {
            title: {
                text: null
            },
            labels: {
                formatter: function () {
                    return Highcharts.numberFormat(Math.abs(this.value),0) + ',-';
                }
            }
        },
        plotOptions: {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            window.open(this.options.url, '_blank');
                        }
                    }
                }
            }
        },
        tooltip: {
            formatter: function () {
                    return '<b>' + this.series.name + ', on ' + this.point.category + '</b><br/>' +
                        'Total : Rp ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
        },
        colors :['#d9534f','#449d44'],
        series: [{
                    name: 'Cash Advance',
                    data: <?=str_replace('"','',json_encode($total_cash_adv))?>
                }, {
                    name: 'Realization',
                    data: <?=str_replace('"','',json_encode($total_realization))?>
                }]
    });     
    
    $('#vehicle_category').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Vehicle by Category Monitoring' 
        },
        subtitle: {
            text: 'Period on <?=$start_date?> to <?=$end_date?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Total Vehicle',
            colorByPoint: true,
            data: <?=str_replace('"','',json_encode($vehicle_category))?>
        }]
    });
    
    $('#achievement_driver').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Top Ten Driver' 
        },
        subtitle: {
            text: 'Period on <?=$start_date?> to <?=$end_date?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Total Tonase',
            colorByPoint: true,
            data: <?=str_replace('"','',json_encode($achievement_driver))?>
        }]
    });
    
});

</script>
