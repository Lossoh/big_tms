<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">

				<header class="header bg-white b-b b-light">
					<p><strong><?=lang('new')?>  <?=lang('cash_advance')?></strong></p>
				</header>
				<section class="scrollable wrapper">				
				<div class="row"> 
					<div class="col-md-12">
					<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
    <br />
    <br />
	                <div class="table-responsive"><?php echo validation_errors(); ?>
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
          <th>Address</th>
          <th>Date of Birth</th>
          <th style="width:125px;">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
          <th>Address</th>
          <th>Date of Birth</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>	
					</div></div>
				<div class="line"></div>
				<div>
					<button type="submit" class="btn_cleartable green  btn-sm"><i class="fa fa-plus"></i>   <?=lang('save')?></button><button type="button" class="btn_cleartable red btn-sm pull-right" onclick="history.go(0);"><i class="fa fa-refresh"></i>   <?=lang('refresh')?></button><button type="button" class="btn_cleartable  yellow btn-sm pull-right" onclick="history.back();"><i class="fa fa-undo"></i>   <?=lang('back')?></button>
				</div>
				</form>					
				</section>  
			</section> 
		</aside>
	</section> 
</section>