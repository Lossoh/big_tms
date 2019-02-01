<section id="content">
  <section class="hbox stretch">
 
<!-- .aside -->
<!--<aside>-->
<section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="pull-right" style="margin-top: 10px;">
            <a class="btn btn-sm btn-dark" href="<?=base_url()?>generate_commission"><i class="fa fa-arrow-left"></i> <?=lang('back')?></a>
        </div>
      <p class="pull-left">Print <?=lang('generate_commissions')?> (Comm)</p>
    </header>
    <section class="scrollable wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Print Commission</div>
            </div>
            <div class="panel-body">
            <?=form_open(base_url().'generate_commission/print_data_commission','autocomplete="off" id="form" class="form-horizontal" target="_blank"')?>
                <div class="form-group form-md-line-input">
					<div class="col-md-2"><strong>Commission No</strong></div>
					<div class="col-md-2">
                        <input type="text" class="form-control input-sm text-center" name="comm_no" id="comm_no" value="<?=$comm_no?>" readonly="" />
    				</div>
                </div>
                <div class="form-group form-md-line-input">
					<div class="col-md-2"><strong>Type</strong></div>
					<div class="col-md-2">
                        <select class="form-control input-sm" name="type" id="type" onchange="print_type_commission()">
                            <option value="summary">Summary</option>
                            <option value="detail_do">Delivery Order</option>
                            <option value="detail_field_cost">Field Cost Detail</option>
                            <option value="detail_vehicle">Police No</option>
                            <option value="detail_driver">Driver</option>
                        </select>
    				</div>
                </div>
                <div class="form-group form-md-line-input" id="departement" style="display: none;">
					<div class="col-md-2"><strong>Departement Name</strong></div>
					<div class="col-md-3">
                        <select class="form-control input-sm all_select2" name="departement_id" id="departement_id" style="width: 80%;">
                            <option value="all">- All -</option>
                            <?php
                            if(count($departements) > 0){
                                foreach($departements as $row_dep){
                                    echo '<option value="'.$row_dep->rowID.'">'.$row_dep->dep_name.'</option>';
                                }
                            }
                            ?>
                        </select>
    				</div>
                </div>
                <div class="form-group form-md-line-input" id="driver" style="display: none;">
					<div class="col-md-2"><strong>Driver Name</strong></div>
					<div class="col-md-3">
                        <select class="form-control input-sm all_select2" name="driver_id" id="driver_id" onchange="show_part_commission()" style="width: 80%;">
                            <option value="all">- All -</option>
                            <?php
                            if(count($drivers) > 0){
                                foreach($drivers as $row){
                                    echo '<option value="'.$row->rowID.'">'.ucwords(strtolower($row->debtor_name)).'</option>';
                                }
                            }
                            ?>
                        </select>
    				</div>
                </div>
                <div class="form-group form-md-line-input part" style="display: none;">
					<div class="col-md-2"><strong>Part</strong></div>
					<div class="col-md-2">
                        <select class="form-control input-sm" name="part" id="part">
                            <option value="1">Part 1</option>
                            <option value="2">Part 2</option>
                            <option value="3">Part 3</option>
                            <option value="4">Part 4</option>
                            <option value="5">Part 5</option>
                            <option value="6">Part 6</option>
                            <option value="7">Part 7</option>
                            <option value="8">Part 8</option>
                            <option value="9">Part 9</option>
                            <option value="10">Part 10</option>
                        </select>
    				</div>
                </div>
                <div class="form-group form-md-line-input">
					<div class="col-md-2"><strong>Print Type</strong></div>
					<div class="col-md-2">
                        <select class="form-control input-sm" name="print_type" id="print_type">
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>
    				</div>
                </div>
                <div class="form-group form-md-line-input">
					<div class="col-md-2"></div>
					<div class="col-md-3">
                        <button type="submit" id="btnPrint" class="btn green"><i class="fa fa-print"></i> Print</button>
    				</div>
                </div>
                <?=form_close()?>
            </div>
          </div>            
        </div>
      </div>
    </section>

</section>
  
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>