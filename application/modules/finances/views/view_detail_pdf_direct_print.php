<script src="<?=base_url()?>resource/js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>resource/plugin/font-awesome/css/font-awesome.min.css" type="text/css" cache="false" />
<script type="text/javascript">
    function btnPrint(){
        $('#print_area').hide();
        window.print();
        window.close();
    }
    
    document.addEventListener('contextmenu', event => event.preventDefault());
    jQuery(document).bind("keyup keydown", function(e){
        if(e.ctrlKey && e.keyCode == 80){
            return false;
        }
    });
</script>
<style type="text/css">
    #print_btn{
        padding: 5px 10px;
        color: #fff !important;
        font-size: 12px;
        font-weight: 500;
        background-color: #65bd77;
        display: inline-block;
        margin-bottom: 0;
        border: 1px solid transparent;
        border-radius: 2px;
        border-color: #65bd77;
        line-height: 1.5;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
    }
</style>
<div id="print_area" style="text-align: right;">
    <button type="button" onclick="btnPrint()" id="print_btn">
        <i class="fa fa-print"></i> Print
    </button>
</div>
<table width="100%" style="font-size: 14px;">
    <tr valign="top">
        <td width="50%">
          <table width="100%">
              <tr>
                <td width="100%">
                    <h3 style="margin-bottom: 0px !important;"><?=lang('bukti_pengeluaran_kas')?></h3>
                </td>
              </tr>
          </table>
          <br />
          <table width="100%">
              <tr>
                <td width="34%"><?=lang('kas')?></td>
				<td width="1%">:</td>
				<td width="65%"><?=$all_data->dep_name.' / '.$this->config->item('comp_cd')?></td>
              </tr> 
              <tr>
                <td><?=lang('tipe_transaksi')?></td>
				<td>:</td>
				<td><?=$all_data->advance_name?></td>
              </tr> 
              <tr>
                <td><?=lang('no_ref')?></td>
				<td>:</td>
				<td><?=$all_data->advance_no.' - '.date('d/m/Y',strtotime($all_data->advance_date))?></td>
              </tr>
              <?php
              if($all_data->advance_type_rowID == '1'){
              ?> 
                  <tr>
                    <td><?=lang('dari_ke')?></td>
    				<td>:</td>
    				<td>
                        <?php
                        $destination = '';
                        if($all_data->destination_from_name == '' || $all_data->destination_to_name == '')
                            $destination = '';
                        else
                            $destination = $all_data->destination_from_name.' - '.$all_data->destination_to_name;
                        
                        echo $destination;
                        ?>
                    </td>
                  </tr> 
                  <tr>
                    <td><?=lang('no_pol')?></td>
    				<td>:</td>
    				<td><?=$all_data->police_no != '' ? $all_data->police_no : ''?></td>
                  </tr> 
                  <tr>
                    <td><?=lang('tipe_kendaraan')?></td>
    				<td>:</td>
    				<td><?=$all_data->type_name != '' ? $all_data->type_name : ''?></td>
                  </tr> 
              <?php
              }
              ?>
              <tr>
                <td><?=lang('dibayarkan_kepada')?></td>
				<td>:</td>
				<td>
                    <?php
                        $type = '-';
                        if($all_data->debtor_type == 'C'){
                            $type = 'Company';
                        }
                        else if($all_data->debtor_type == 'D'){
                            $type = 'Driver';                                
                        }
                        else if($all_data->debtor_type == 'E'){
                            $type = 'Employee';                                
                        }
                    ?>
                    <?=$all_data->debtor_type.$all_data->debtor_code.' - '.strtoupper($all_data->debtor_name).' ['.$type.']'?>
                </td>
              </tr> 
              <tr>
                <td><?=lang('sejumlah_uang')?></td>
				<td>:</td>
				<td>Rp <?=number_format($all_data->advance_amount + $all_data->advance_extra_amount,0,',','.')?></td>
              </tr> 
              <tr>
                <td><?=lang('keterangan')?></td>
				<td>:</td>
                <td><?=$all_data->description != '' ? $all_data->description : '-'?></td>
              </tr> 
              <tr valign="top">
                <td colspan="2" align="center">
                    <br /><br />
                    <b><?=lang('pemegang_kas')?>,</b>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <?=strtoupper($this->tank_auth->get_username())?>
                </td>
				<td align="center">
                    <br /><br />
                    <b><?=lang('penerima')?>,</b>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <?=strtoupper($all_data->debtor_name)?><br />
                    <?=$all_data->no_ktp == '' ? '<br>' : $all_data->no_ktp?>
                </td>
              </tr> 
              <tr>
                <td colspan="2" align="center">
                    <img src="http://200.10.10.7:2987/includebar/barcode.php?codetype=Code39&size=35&text=<?=urlencode($all_data->barcode_no) ?>" /><br />
                    <b style="font-size: 9px;"><?=$all_data->barcode_no?></b>
                </td>
				<td>&nbsp;</td>
              </tr> 
              <tr>
                <td colspan="3" align="left" style="font-size: 11px;">
                    <div style="margin-top: 12px;">
                        1) Asli untuk Kantor Pusat, 2) Copy untuk Petugas Uang Jalan <br />                        
                        <?=lang('dicetak_oleh').' : '.ucwords(strtolower($this->tank_auth->get_username())).', '.lang('tanggal_jam').' : '.date('d/m/Y H:i:s')?> <br />
                    </div>
                </td>
              </tr> 
          </table>          
      </td>

      <td width="50%">
      <?php
      if($all_data->advance_type_rowID == '1'){
      ?>
          <table width="100%">
              <tr>
                <td width="100%">
                    <h3 style="margin-bottom: 0px !important;"><?=lang('surat_perintah_kerja')?></h3>
                </td>
              </tr>  
          </table>
          <br />
          <table class="table table-responsive table-striped table-condensed table-hover" width="100%">
              <tr>
                <td width="34%"><?=lang('site')?></td>
				<td width="1%">:</td>
				<td width="65%"><?=$all_data->dep_name.' / '.$this->config->item('comp_cd')?></td>
              </tr> 
              <tr>
                <td><?=lang('no_ref')?></td>
				<td>:</td>
				<td><?=$all_data->advance_no.' - '.date('d/m/Y',strtotime($all_data->advance_date))?></td>
              </tr> 
              <tr>
                <td><?=lang('dari_ke')?></td>
				<td>:</td>
				<td>
                    <?php
                    $destination = '';
                    if($all_data->destination_from_name == '' || $all_data->destination_to_name == '')
                        $destination = '';
                    else
                        $destination = $all_data->destination_from_name.' - '.$all_data->destination_to_name;
                    
                    echo $destination;
                    ?>
                </td>
              </tr> 
              <tr>
                <td><?=lang('no_pol')?></td>
				<td>:</td>
				<td><?=$all_data->police_no != '' ? $all_data->police_no : ''?></td>
              </tr> 
              <tr>
                <td><?=lang('tipe_kendaraan')?></td>
				<td>:</td>
				<td><?=$all_data->type_name != '' ? $all_data->type_name : ''?></td>
              </tr> 
              <tr>
                <td><?=lang('nama_supir')?></td>
				<td>:</td>
				<td><?=strtoupper($all_data->debtor_name)?></td>
              </tr> 
              <tr>
                <td><?=lang('keterangan')?></td>
				<td>:</td>
                <td><?=$all_data->description != '' ? $all_data->description : '-'?></td>
              </tr> 
              <tr>
                <td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
              </tr> 
              <tr>
                <td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
              </tr> 
              <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
                <td align="center">
                    <br /><br />
                    <b style="margin-top: -10px;"><?=lang('petugas')?>,</b>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <?=strtoupper($this->tank_auth->get_username())?>
                    <br /><br />
                </td>
              </tr> 
              <tr>
                <td colspan="2" align="center">
                    <img src="http://200.10.10.7:2987/includebar/barcode.php?codetype=Code39&size=35&text=<?=urlencode($all_data->barcode_no) ?>" /><br />
                    <b style="font-size: 9px;"><?=$all_data->barcode_no?></b>
                </td>
				<td>&nbsp;</td>
              </tr> 
              <tr>
                <td colspan="3" align="left" style="font-size: 11px;">
                    *) Periksa kembali dokumen yang dibawa seperti KIR, STNK &amp; Kunci Mobil. <br />
                    1) Asli untuk Petugas Surat Muat, 2) Copy untuk Supir <br />
                    <?=lang('dicetak_oleh').' : '.ucwords(strtolower($this->tank_auth->get_username())).', '.lang('tanggal_jam').' : '.date('d/m/Y H:i:s')?> <br />
                </td>
              </tr> 
          </table>
        
      <?php
      }
      else if($all_data->advance_type_rowID == '4'){
      ?>
          <div class="panel panel-default">
            <div class="table-responsive">
              <div class="row">
                <div class="col-md-8">
                    <h3 style="margin-bottom: 0px !important;">SALDO PINJAMAN</h3>
                </div>
              </div>  
              <br />
              <table cellpadding='0' cellspacing='0' width="100%">
                  <tr>
                    <th width="7%" style="border-top: solid 1px #000;border-bottom: solid 1px #000;">No</th>
					<th width="20%" style="border-top: solid 1px #000;border-bottom: solid 1px #000;">Tanggal</th>
					<th style="border-top: solid 1px #000;border-bottom: solid 1px #000;">Keterangan</th>
					<th width="25%" style="border-top: solid 1px #000;border-bottom: solid 1px #000;">Jumlah (Rp)</th>
                  </tr> 
                  <tr>
                    <td align="center" style="border-top: solid 1px #000;border-bottom: solid 1px #000;">1.</td>
                    <td style="border-top: solid 1px #000;border-bottom: solid 1px #000;"><?=date('d-m-Y',strtotime($all_data->advance_date))?></td>
                    <td style="border-top: solid 1px #000;border-bottom: solid 1px #000;">PINJAMAN : <?=$all_data->description?></td>
                    <td align="right" style="border-top: solid 1px #000;border-bottom: solid 1px #000;"><?=number_format($all_data->advance_amount + $all_data->advance_extra_amount,0,',','.')?></td>
                  </tr>
                  <?php
                    $saldo = $all_data->advance_amount + $all_data->advance_extra_amount;
                    $get_data_commission = $this->finances_model->get_data_commission_by_ca_no($all_data->advance_no);
                    if(count($get_data_commission) > 0){
                        $no = 2;
                        foreach($get_data_commission as $row_comm){
                            $amount = $row_comm->alloc_amt * -1;
                            $saldo -= $row_comm->alloc_amt;
                            
                            $description = '-';
                            if($row_comm->commission_no == ''){
                                $description = $row_comm->descs;                                    
                            }
                            else{
                                $description = 'POTONGAN PINJAMAN '.$row_comm->descs.'['.$row_comm->period.']';
                            }
                  ?>
                          <tr>
                            <td align="center" style="border-top: solid 1px #000;border-bottom: solid 1px #000;"><?=$no++?>.</td>
                            <td style="border-top: solid 1px #000;border-bottom: solid 1px #000;"><?=date('d-m-Y',strtotime($row_comm->alloc_date))?></td>
                            <td style="border-top: solid 1px #000;border-bottom: solid 1px #000;"><?=$description?></td>
                            <td align="right" style="border-top: solid 1px #000;border-bottom: solid 1px #000;"><?=number_format($amount,0,',','.')?></td>
                          </tr>
                  <?php
                        }
                  ?>
                          <tr>
                            <td colspan="3" align="right" style="border-top: solid 1px #000;border-bottom: solid 1px #000;"><b>Sisa Saldo (Rp)</b> &nbsp; </td>
                            <td align="right" style="border-top: solid 1px #000;border-bottom: solid 1px #000;"><b><?=number_format($saldo,0,',','.')?></b></td>
                          </tr>
                  <?php
                    }
                  ?>
              </table>
          </div>
        </div>     
      <?php  
      }
      ?>         
      </td>
  </tr>
</table>
      