<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a class="btn btn-sm btn-dark" href="<?=base_url()?>finances/cash_advance_list"><i class="fa fa-arrow-left"></i> <?=lang('back')?></a>
              <?php
              if($this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintLimited') == 1 || $this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintUnlimited') == 1 || 
                $this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintOne') == 1 || $this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintTwo') == 1){
                    if($this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintLimited') == 1){
                        if($this->user_profile->get_log_limited_printed($all_data->advance_no,'Print Cash Advance') == 0){
              ?>
                            <a class="btn btn-sm green" href="<?=base_url()?>finances/print_ca/<?=$all_data->rowID?>" target="_blank"><i class="fa fa-print"></i> <?=lang('print')?></a>
              <?php
                        }
                    }
                    else{
              ?>
                            <a class="btn btn-sm green" href="<?=base_url()?>finances/print_ca/<?=$all_data->rowID?>" target="_blank"><i class="fa fa-print"></i> <?=lang('print')?></a>
              <?php
                    }
              ?>
              <?php
              }
              
              ?>
            </div>
            <p class="pull-left"><?=lang('detail_cash_advance')?></p>
        </header>
        <section class="scrollable wrapper">
          <?php
          if($this->session->flashdata('success') != ''){
          ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?=$this->session->flashdata('success')?>
            </div>
          <?php
          }
          else if($this->session->flashdata('error') != ''){
          ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?=$this->session->flashdata('error')?>
            </div>
          <?php
          }
          ?>
          <div class="row">
            <div class="col-lg-6">
              <div class="panel panel-default">
                <div class="table-responsive">
                  <div class="row">
                    <div class="col-md-8" style="margin-left: 15px;">
                        <h3 style="margin-bottom: 0px !important;"><?=lang('bukti_pengeluaran_kas')?></h3>
                    </div>
                    <div class="col-md-4 text-center" style="margin-left: -15px;margin-top:15px">
                        <img src="<?=base_url()?>includebar/barcode.php?codetype=Code39&size=35&text=<?=urlencode($all_data->barcode_no) ?>" /><br />
                        <small><b><?=$all_data->barcode_no?></b></small>
                    </div>
                  </div>
                  <br />
                  <table class="table table-responsive table-striped table-condensed table-hover">
                      <tr>
                        <th width="31%"><?=lang('kas')?></th>
						<th width="1%">:</th>
						<td width="68%"><?=$all_data->dep_name?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('tipe_transaksi')?></th>
						<th>:</th>
						<td><?=$all_data->advance_name?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('no_ref')?></th>
						<th>:</th>
						<td><?=$all_data->advance_no?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('dari_ke')?></th>
						<th>:</th>
						<td><?=$all_data->destination_from_name.' - '.$all_data->destination_to_name?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('no_pol')?></th>
						<th>:</th>
						<td><?=$all_data->police_no != '' ? $all_data->police_no : '-'?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('tipe_kendaraan')?></th>
						<th>:</th>
						<td><?=$all_data->type_name != '' ? $all_data->type_name : '-'?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('dibayarkan_kepada')?></th>
						<th>:</th>
						<td><?=strtoupper($all_data->debtor_name)?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('sejumlah_uang')?></th>
						<th>:</th>
						<td>Rp <?=number_format($all_data->advance_amount + $all_data->advance_extra_amount,0,',','.')?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('keterangan')?></th>
						<th>:</th>
                        <td><?=$all_data->description != '' ? $all_data->description : '-'?></td>
                      </tr> 
                      <tr>
                        <td>
                            <p>&nbsp;</p>
                            <b><?=lang('pemegang_kas')?>,</b>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <?=strtoupper($this->tank_auth->get_username())?>
                        </td>
						<td>&nbsp;</td>
						<td class="text-center">
                            <p>&nbsp;</p>
                            <b><?=lang('penerima')?>,</b>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <?=strtoupper($all_data->debtor_name)?>
                        </td>
                      </tr> 
                  </table>
              </div>
            </div>            
          </div>
          <div class="col-lg-6">
          <?php
          if($all_data->advance_type_rowID == '1'){
          ?>
              <div class="panel panel-default">
                <div class="table-responsive">
                  <div class="row">
                    <div class="col-md-8" style="margin-left: 15px;">
                        <h3 style="margin-bottom: 0px !important;"><?=lang('surat_perintah_kerja')?></h3>
                    </div>
                    <div class="col-md-4 text-center" style="margin-left: -15px;margin-top:15px">
                        <img src="<?=base_url()?>/includebar/barcode.php?codetype=Code39&size=35&text=<?=urlencode($all_data->barcode_no) ?>" /><br />
                        <small><b><?=$all_data->barcode_no?></b></small>
                    </div>
                  </div>  
                  <br />
                  <table class="table table-responsive table-striped table-condensed table-hover">
                      <tr>
                        <th width="31%"><?=lang('site')?></th>
						<th width="1%">:</th>
						<td width="68%"><?=$all_data->dep_name?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('no_ref')?></th>
						<th>:</th>
						<td><?=$all_data->advance_no?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('dari_ke')?></th>
						<th>:</th>
						<td><?=$all_data->destination_from_name.' - '.$all_data->destination_to_name?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('no_pol')?></th>
						<th>:</th>
						<td><?=$all_data->police_no != '' ? $all_data->police_no : '-'?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('tipe_kendaraan')?></th>
						<th>:</th>
						<td><?=$all_data->type_name != '' ? $all_data->type_name : '-'?></td>
                      </tr> 
                      <tr>
                        <th><?=lang('nama_supir')?></th>
						<th>:</th>
						<td><?=strtoupper($all_data->debtor_name)?></td>
                      </tr> 
                      <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
                        <td class="text-center">
                            <p>&nbsp;</p>
                            <b><?=lang('petugas')?>,</b>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <?=strtoupper($this->tank_auth->get_username())?>
                        </td>
                      </tr> 
                  </table>
              </div>
            </div>   
          <?php
          }
          ?>         
          </div>
          
        </div>
      </section>

    </section>
 <!-- </aside>-->
  <!-- /.aside -->
     
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>