<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('approval_reimburse')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>              
                        <a  class="btn btn-sm red" onclick="approval_reimburse_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                        <a  class="btn btn-sm btn-success" onclick="approval_reimburse_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </header>
        <div class="clearfix"></div> 
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>

                        <div class="input-group input-daterange pull-right" style="position: relative;top:10px;right: 14px; display: inline-flex;">
                          <font style="margin: 5px 10px 0px 0px">Filter:</font>
                          <input type="text" name="start_date" id="start_date" class="form-control input-sm start_date" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>" style="text-align: center;">
                          <span class="input-group-addon" style="width: 50px;">to</span>
                          <input type="text" name="end_date" id="end_date" class="form-control input-sm end_date" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>" style="text-align: center;">
                      </div>
                      <br><br>

                        <table class="table table-striped table-hover b-t b-light text-sm" id="tbl-approval-reimburse-new" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th><?=lang('reimburse_number')?></th>
                                    <th>Reimburse Date</th>
                                    <th>Advance Type</th>
                                    <th>Company Code</th>
                                    <th>Branch Company Code</th>
                                    <th>Approval</th>

                                    <!-- For Filter -->
                                    <th>start_date</th>
                                    <th>end_date</th>
                                </tr>
                            </thead>
                        </table>

                      <!-- <table class="table table-striped table-hover b-t b-light text-sm" id="tbl_approval_reimburse" width="100%"></table> -->
                  </div>
               </div>
            </div> 
                       
          </div>
        </div>
      </section>

    </section>
 <!-- </aside>-->
  <!-- /.aside -->

<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width: 55%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('approval_reimburse')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <div class="form-group form-md-line-input">
            <label class="col-lg-3 control-label"><?=lang('reimburse_number')?> <span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <input type="text" class="form-control input-sm" id="reimburse_no" name="reimburse_no" required readonly> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-3 control-label">Reimburse Date <span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <input type="text" class="form-control input-sm" id="reimburse_date" name="reimburse_date" required readonly> 
            </div>
        </div><div class="form-group form-md-line-input">
            <label class="col-lg-3 control-label">Reimburse Total <span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <input type="text" class="form-control input-sm" id="reimburse_total" name="reimburse_total" style="text-align: right;" required readonly> 
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="bs-example table-responsive"> 
            <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_reimburse"></table>
        </div>         
              
          <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnApprove" onclick="save_approval()" class="btn green">Approve</button>
            <button type="button" id="btnDisapprove" onclick="save_disapproval()" class="btn yellow">Disapprove</button>
            <button type="button" class="btn red" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'approval_reimburse/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <?=form_close()?>
        </section>
	</section>   
</aside>
<!-- /.aside -->

<script>
$(function(){
    $('.start_date, .end_date').datetimepicker({
            format: 'DD-MM-YYYY',
            showTodayButton:true
        }); 
        
        // var table_approval_reimburse = $('#tbl-approval-reimburse-new').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        //     sPaginationType: "full_numbers",
        //     ajax: {
        //         url: "<?= base_url() ?>apis/fetch_data_reimburse",
        //         type: 'POST',
        //         data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        //     },
        //     columns: [
        //         {
        //             "data": "no", "orderable": false, "searchable": false, "className" : "text-center"
        //         },
        //         {
        //             "data": "reimburse_no"
        //         },
        //         {
        //             "data": "reimburse_date"
        //         },
        //         {
        //             "data": "advance_type"
        //         },
        //         {
        //             "data": "company_code"
        //         },
        //         {
        //             "data": "branch_company_code"
        //         },
        //         {
        //             "data": "action", "orderable": false, "searchable": false, "className" : "text-center"
        //         },
        //         {
        //             "data": "start_date", "bVisible" : false
        //         },
        //         {
        //             "data": "end_date", "bVisible" : false
        //         }
        //     ],
        //     order: [0, "DESC"],
        //     iDisplayLength: 25
        // });

        // $('.dataTables_filter input').unbind().keyup(function() {
        //     var value = $(this).val();
        //     if (value.length > 2) {
        //         table_approval_reimburse.search(value).draw();
        //     } 
        //     if (value.length == 0) {
        //         table_approval_reimburse.search(value).draw();
        //     } 
        // });
        // $(".start_date").on("dp.change", function (e) {
        //     var start_date = $("#start_date").val();
        //     table_approval_reimburse.columns(7).search(start_date).draw();
        //     $("#start_date").blur();
        // });
        // $(".end_date").on("dp.change", function (e) {
        //     var end_date = $("#end_date").val();
        //     table_approval_reimburse.columns(8).search(end_date).draw();
        //     $("#end_date").blur();
        // });

   // $.ajax({
   //      type: "POST",
   //      url : "<?php echo base_url(); ?>api.php",
   //  	data: 'type=get_data_reimburse&start_date='+$('#start_date').val()+'&end_date='+$('#end_date').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
   //      dataType:"JSON",
   //      cache:false,
   //      success: function(result){
            
   //          $('#tbl_approval_reimburse').html('');

   //          var isi_table = '<thead>'+
   //                              '<tr>' +
   //                                  '<th>No</th>' +
   //                  				'<th><?=lang('reimburse_number')?></th>' +
   //                  				'<th>Reimburse Date</th>' +
   //                  				'<th>Advance Type</th>' +
   //                  				'<th>Company Code</th>' +
   //                  				'<th>Branch Company Code</th>' +
   //                  				'<th>Approval</th>' +
   //                              '</tr>' +
   //                          '</thead>';
                
   //          var no = 1;
   //          $.each(result, function(key, data) {	
                
			// 	isi_table += '<tr>'+
   //                              '<td>'+no+'</td>' +
   //                              '<td>'+data.reimburse_no+'</td>' +
   //                              '<td>'+data.reimburse_date+'</td>' +
   //                              '<td>'+data.advance_type+'</td>' +
   //                              '<td>'+data.company_code+'</td>' +
   //      						'<td>'+data.branch_company_code+'</td>' +  
   //      						'<td><button type="button" class="btn btn-sm btn-info" onclick="ApproveReimburse(\''+ data.reimburse_no +'\',\''+ data.reimburse_date +'\',\''+ data.grand_total_reimburse +'\')"><i class="fa fa-list-alt"></i> Detail</button></td>' +  
   //                           '</tr>';
			//      no++;
   //          });  
            
                      
   //          $('#tbl_approval_reimburse').append(isi_table);   
               
   //          $('#tbl_approval_reimburse').DataTable().destroy();
   //          $('#tbl_approval_reimburse').dataTable({
   //              "aaSorting": [[0, 'asc']],
   //      		"bProcessing": true,
   //              "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
   //              "sPaginationType": "full_numbers",
   //      	});
            
   //      },
   //  	error: function(xhr, status, error) {
   //  		document.write(xhr.responseText);
   //  	}
   //  });  
});

function ApproveReimburse(reimburse_no,reimburse_date,grand_total_reimburse){
    $('#modal_form').modal('show');
    
    $.ajax({
        url : "<?php echo base_url('approval_reimburse/check_data_reimburse')?>/" + reimburse_no,
        type: "GET",
        success: function(data)
        {
            if(data.count_data > 0){
                $('#btnApprove').hide();
                $('#btnDisapprove').show();                
            }
            else{
                $('#btnApprove').show();
                $('#btnDisapprove').hide();
            }
        }
    });
    
    $('#reimburse_no').val(reimburse_no);
    $('#reimburse_date').val(reimburse_date);
    $('#reimburse_total').val(tandaPemisahTitik(grand_total_reimburse));
    
    // $.ajax({
    //     type: "POST",
    //     url : "<?php echo base_url(); ?>api.php",
    // 	data: 'type=get_data_detail_reimburse&reimburse_no='+reimburse_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
    //     dataType:"JSON",
    //     cache:false,
    //     success: function(result){
            
    //         $('#detail_reimburse').html('');

    //         var isi_table = '<thead>' +
    //                             '<tr>' +
    //                                 '<th>No</th>' +
    //                 				'<th><?=lang('advance_number')?></th>' +
    //                 				'<th>Advance Date</th>' +
    //                 				'<th>Advance Type</th>' +
    //                 				'<th>Total Advance</th>' +
    //                 				'<th>Total Reimburse</th>' +
    //                             '</tr>' +
    //                         '</thead>' +
    //                         '<tbody>';
                
    //         var no = 1;
    //         var totalAdvance = 0;
    //         var totalReimburse = 0;
    
    //         $.each(result, function(key, data) {	
                
	// 			isi_table += '<tr>'+
    //                             '<td>'+no+'</td>' +
    //                             '<td>'+data.advance_no+'</td>' +
    //                             '<td>'+data.advance_date+'</td>' +
    //                             '<td>'+data.advance_type+'</td>' +
    //                             '<td align="right">'+tandaPemisahTitik(data.total_advance)+'</td>' +
    //     						'<td align="right">'+tandaPemisahTitik(data.total_reimburse)+'</td>' +  
    //                          '</tr>';
	// 		    no++;
                
    //             totalAdvance += parseFloat(data.total_advance);
    //             totalReimburse += parseFloat(data.total_reimburse);
                
    //         });  
            
    //         var status = '-';
    //         if(totalAdvance > totalReimburse){
    //             status = 'Kurang Bayar';
    //         }
    //         else if(totalAdvance < totalReimburse){
    //             status = 'Lebih Bayar';                
    //         }
            
    //         isi_table += '</tbody>' +
    //                      '<tfoot>'+
    //                         '<tr>' +
    //                             '<td colspan="3"><b>Status :</b> <b id="status"></b></td>' +
    //             				'<td align="right"><b>Total (Rp)</b> &nbsp; </td>' +
    //             				'<td align="right"><b id="totalAdvance"></b></td>' +
    //             				'<td align="right"><b id="totalReimburse"></b></td>' +
    //                         '</tr>' +
    //                      '</tfoot>';
    
    //         $('#detail_reimburse').append(isi_table);   
                        
    //         $('#detail_reimburse').DataTable().destroy();
    //         $('#detail_reimburse').dataTable({
    //             "aaSorting": [[0, 'asc']],
    //     		"bProcessing": true,
    //             "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
    //             "sPaginationType": "full_numbers",
    //     	});
            
    //         $('#status').html(status);
    //         $('#totalAdvance').html(tandaPemisahTitik(totalAdvance));
    //         $('#totalReimburse').html(tandaPemisahTitik(totalReimburse));

    //     },
    // 	error: function(xhr, status, error) {
    // 		document.write(xhr.responseText);
    // 	}
    // }); 
}

function save_approval(){
    sweetAlert({
      title: "Are you sure?",
      text: "Are you want to Approve?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Approve !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
              $.ajax({
                url : "<?php echo base_url('approval_reimburse/save_approval')?>",
                type: "POST",
                data: $('#form').serializeArray(),
                dataType: "JSON",
                success: function(result)
                {  
                    if (result.success){ 
                        $('#modal_form').modal('hide');
                        sweetAlert('<?=lang('information')?>',''+result.msg);   
                        location.replace("<?php echo base_url('approval_reimburse')?>");
                    }else{
                        sweetAlert('<?=lang('information')?>',''+result.msg); 
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error saving data", "error");
                }
                
            });  
        }
    });
    
}

function save_disapproval(){
    sweetAlert({
      title: "Are you sure?",
      text: "Are you want to Disapprove?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Disapprove !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
              $.ajax({
                url : "<?php echo base_url('approval_reimburse/save_disapproval')?>",
                type: "POST",
                data: $('#form').serializeArray(),
                dataType: "JSON",
                success: function(result)
                {  
                    if (result.success){ 
                        $('#modal_form').modal('hide');
                        sweetAlert('<?=lang('information')?>',''+result.msg);   
                        location.replace("<?php echo base_url('approval_reimburse')?>");
                    }else{
                        sweetAlert('<?=lang('information')?>',''+result.msg); 
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error saving data", "error");
                }
                
            });  
        }
    });
    
}

function approval_reimburse_pdf(){
    window.open('<?php echo base_url('approval_reimburse/pdf')?>');
}
    
function approval_reimburse_excel(){
    window.open('<?php echo base_url('approval_reimburse/excel')?>');
}

</script>