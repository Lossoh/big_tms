<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox" style="background-color:#fff;">
        <header class="header bg-white b-b b-light">
          <!-- <a onclick="print_pdf()" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/Pdf.ico');background-repeat:no-repeat;"> PDF</a> -->
          <p><?=lang('company_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
                    <?php
                    if($this->session->flashdata('message')){ ?>
                    <div class="alert alert-success"> 
                        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button> <i class="fa fa-info-sign"></i>
                        <?=$this->session->flashdata('message');?>
                    </div>
                    
                    <?php 
                    }
                    elseif($this->session->flashdata('error')){
                    ?>
                    <div class="alert alert-danger"> 
                        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button> <i class="fa fa-info-sign"></i>
                        <?=$this->session->flashdata('error');?>
                    </div>
                    
                    <?php
                    }
                    ?> 
                    
                    <?php echo validation_errors(); ?>

                    <?=form_open($this->uri->uri_string().'/update','autocomplete="off"')?>
					<table class="table table-striped table-hover b-t b-light text-sm">
    					<tr>
    						<th width="15%">
    							Company Code <span class="text-danger">*</span>
    						</th>
    						<td width="2%">
    							: 
    						</td>
    						<td class="form-group form-md-line-input"><?php echo form_error('comp_cd'); ?>
                                <input type="text" class="form-control input-sm" name="comp_cd" value="<?=$this->config->item('comp_cd')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							Nama Perusahaan <span class="text-danger">*</span>
    						</th>
    						<td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="comp_name" value="<?=$this->config->item('comp_name')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							Alamat <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="address1" value="<?=$this->config->item('address1')?>" />
    						</td>
    					</tr>
                        <tr>
    						<th>
    							Kecamatan <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="address2" value="<?=$this->config->item('address2')?>" />
    						</td>
    					</tr>
                        <tr>
    						<th>
    							Kota <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="address3" value="<?=$this->config->item('address3')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							No. Telp 1 <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="telp1" onkeyup="angka(this);" value="<?=$this->config->item('telp1')?>" />
    						</td>
    					</tr>
    					
    					<?php if($this->config->item('telp2') != "") {?>
    					<tr>
    						<th>
    							No. Telp 2 <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="telp2" onkeyup="angka(this);" value="<?=$this->config->item('telp2')?>" />
    						</td>
    					</tr>
    					<?php } else { echo "";}?>
    					
    					<tr>
    						<th>
    							No. Fax 1 <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="fax1" onkeyup="angka(this);" value="<?=$this->config->item('fax1')?>" />
    						</td>
    					</tr>
    					
    					<?php if($this->config->item('fax2') <> "") { ?>
    					<tr>
    						<th>
    							No. Fax 2 <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="fax2" onkeyup="angka(this);" value="<?=$this->config->item('fax2')?>" />
    						</td>
    					</tr>
    					<?php } else { echo "";}?>
    
    					<tr>
    						<th>
    							Website <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="website" value="<?=$this->config->item('website')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							Email 1 <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="email" class="form-control input-sm" name="email1" value="<?=$this->config->item('email1')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							Email 2 <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="email" class="form-control input-sm" name="email2" value="<?=$this->config->item('email2')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							NPWP <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="npwp_no" value="<?=$this->config->item('npwp_no')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							Alamat di NPWP <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="npwp_address1" value="<?=$this->config->item('npwp_address1')?>" />
    						</td>
    					</tr>
                        <tr>
    						<th>
    							Kecamatan di NPWP <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="npwp_address2" value="<?=$this->config->item('npwp_address2')?>" />
    						</td>
    					</tr>
                        <tr>
    						<th>
    							Kota di NPWP <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="npwp_address3" value="<?=$this->config->item('npwp_address3')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							Kode Pos di NPWP <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="npwp_post_cd" maxlength="5" onkeyup="angka(this);" value="<?=$this->config->item('npwp_post_cd')?>" />
    						</td>
    					</tr>
    					<tr>
    						<th>
    							NPPKP <span class="text-danger">*</span>
    						</th>
                            <td>
    							: 
    						</td>
    						<td class="form-group form-md-line-input">
                                <input type="text" class="form-control input-sm" name="nppkp_no" value="<?=$this->config->item('nppkp_no')?>" />
    						</td>
    					</tr>
					</table>
                    <div class="form-group form-md-line-input text-center">
                        <button type="submit" class="btn green">Save</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        &nbsp;
                    </div>
                    <?=form_close()?>
              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  </aside>
  <!-- .end aside -->
  </section>
</section>
   
