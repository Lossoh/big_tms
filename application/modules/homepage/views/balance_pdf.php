<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Report</title>
	
	<style>
		table th,td{
			font-size: 12px;
		}
		
		@page { margin: 60px 10px; }
		#header { position: fixed; left: 0px; top: -60px; right: 0px; height: 50px;  text-align: center;  }
		#footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px; text-align:right; }
		#content{
		border-bottom:0px solid #000000;
		}
		#footer .page:after { content: counter(page, upper-roman); }
		#content{
		background-color:#FFFFFF;
		} 
	</style>
</head>

<body>
	<table width="100%">
		<tr>
			<td colspan="2" align="center">	
				<div id="header">
					<h2><?php echo lang('daily_balance'); ?></h2>
					<?= date("d/m/Y",strtotime($start_date)) ?> - <?= date("d/m/Y",strtotime($end_date));?>
				</div>			
			</td>
		</tr>
		<tr>
			<td width="50%" align="left">
				<?=$this->config->item('comp_name')?>
			</td>
			<td width="50%" align="right" style="font-size: 10px;">
				Created : <b><?=ucwords($this->session->userdata('username'))?></b> | Print Time : <b><?=date('d F Y H:i:s')?></b>
			</td>
		</tr>
	</table>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
			<tr>
				<th align="center" height="30px">No</th>
				<th align="center"><?php echo lang('date'); ?></th>
				<th align="center"><?php echo lang('department'); ?></th>
				<th align="center"><?php echo lang('balance'); ?></th>
				<th align="center"><?php echo lang('use_balance'); ?></th>
				<th align="center"><?php echo lang('remaining_balance'); ?></th>
			</tr>
			<?php 
			$i=0;
			foreach($balance as $val){
				$i++;
                $get_department = $this->homepage_model->get_by_id($tabel = 'sa_dep', $val->dep_rowID);

				$date = date('d-m-Y',strtotime($val->date_created));
				$department=ucwords($get_department->dep_cd. ' - ' .$get_department->dep_name);
				$balance=number_format($val->balance);
				$use_balance=number_format($val->use_balance);
				$remaining_balance=number_format($val->remaining_balance);
			?>
				<tr style="font-size:9px">
					<td><?php echo $i;?></td>
					<td align="left"><?php echo $date;?></td>
					<td align="left"><?php echo $department;?></td>
					<td align="right"><?php echo $balance;?></td>
					<td align="right"><?php echo $use_balance;?></td>
					<td align="right"><?php echo $remaining_balance;?></td>
				</tr>
			<?php 
			}
			?>
		</table>
	</div>
</body>
</html>
