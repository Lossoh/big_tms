<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_transporter')?></a>
          <p><?=lang('registered_transporters')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table id="transporters" class="table table-striped m-b-none">
                    <thead>
                      <tr>
                        <th><?=lang('transporter_ref')?></th>
                        <th><?=lang('transporter_name')?> </th>
                        <th><?=lang('address_1')?></th>
						<th><?=lang('city')?></th>
						<th><?=lang('pic_1')?></th>
						<th><?=lang('truck_total')?></th>
						<th><?=lang('options')?></th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($transporters)) {
                      foreach ($transporters as $transporter) { ?>
						<tr>
						  <td><?=$transporter->transporter_ref?></a></td>
						  <td><?=$transporter->transporter_name?></td>
						  <td><?=$transporter->address_1?></td>
						  <td><?=$transporter->city?></td>
						  <td><?=$transporter->pic_1?></td>
						  
						  <td>
                        <a href="<?=base_url()?>transporters/view/details/<?=$transporter->transporter_id?>" class="btn btn-default btn-xs" title="<?=lang('details')?>"><i class="fa fa-home"></i> </a>
                        </td>
						<td>
						<a href="<?=base_url()?>transporters/view/delete/<?=$transporter->transporter_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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

  <!-- .aside -->
  <aside class="aside-lg bg-white b-l hide" id="aside">
    <section class="vbox">
      <section class="scrollable wrapper">
      <?php
      echo form_open(base_url().'companies/create'); ?>
      <?php echo validation_errors(); ?>
      <input type="hidden" name="company_ref" value="<?=$this->applib->generate_string()?>">
      <div class="form-group form-md-line-input">
        <label><?=lang('company_name')?> <span class="text-danger">*</span></label>
        <input type="text" name="company_name" placeholder="Eg. Envato" value="<?=set_value('company_name')?>" class="input-sm form-control">
      </div>
      <div class="form-group form-md-line-input">
        <label><?=lang('company_email')?> <span class="text-danger">*</span></label>
        <input type="email" placeholder="johndoe@domain.com" name="company_email" value="<?=set_value('company_email')?>" class="input-sm form-control">
      </div>
      <div class="form-group form-md-line-input">
        <label><?=lang('phone')?> </label>
        <input type="text" placeholder="<?=lang('phone')?>" value="<?=set_value('company_phone')?>" name="company_phone"  class="input-sm form-control">
      </div>
      <div class="form-group form-md-line-input">
        <label><?=lang('company_domain')?> </label>
        <input type="text" placeholder="<?=lang('company_domain')?>" value="<?=set_value('company_website')?>" name="company_website"  class="input-sm form-control">
      </div>
      <div class="form-group form-md-line-input">
        <label><?=lang('address')?> <span class="text-danger">*</span></label>
        <textarea name="company_address" class="form-control"></textarea>
      </div>
      <div class="form-group form-md-line-input">
        <label><?=lang('city')?> </label>
        <input type="text" placeholder="E.g New York" value="<?=set_value('city')?>" name="city" class="input-sm form-control">
      </div>
      <div class="form-group form-md-line-input">
        <label><?=lang('country')?> </label>
        <select id="select2-option" style="width:200px" name="country" > 
          <optgroup label="Default Country"> 
          <option value="<?=$this->config->item('company_country')?>"><?=$this->config->item('company_country')?></option>
          </optgroup> 
          <optgroup label="Other Countries"> 
            <?php foreach ($countries as $country): ?>
            <option value="<?=$country->value?>"><?=$country->value?></option>
            <?php endforeach; ?>
          </optgroup> 
          </select> 
      </div>
      <button type="submit" class="btn btn-sm btn-success"><?=lang('add_company')?></button>
      <hr>
    </form>
   
  </section></section>
   
</aside>
<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>