<header class="bg-dark  header navbar navbar-fixed-top-xs">
	<div class="navbar-header aside-md"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"> <i class="fa fa-bars"></i> </a> <a href="<?=base_url()?>home"><img src="<?=base_url()?>resource/images/<?=$this->config->item('company_logo')?>" class="m-r-sm"></a><a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user"> <i class="fa fa-cog"></i> </a>

	</div>
	<ul class="nav navbar-nav" id="menu_bar">
        <li style="cursor: pointer;">
            <a class="dropdown-toggle" onclick="menuBar(1)" id="btnTrue"><i class="fa fa-bars"></i></a>
            <a class="dropdown-toggle" onclick="menuBar(0)" id="btnFalse"><i class="fa fa-bars"></i></a>
        </li>
	</ul>
    
	<ul class="nav navbar-nav navbar-right hidden-xs nav-user">						
		<li style="padding-top: 15px; padding-bottom: 15px;font-weight: bold; color: #fff"><?=strtoupper($this->config->item('comp_name'))?> &nbsp; &nbsp; &nbsp; </li>
		<li class="dropdown"> 
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<span class="thumb-sm avatar pull-left"> 
					<?php
					$avatar = $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'avatar');
					if(empty($avatar)){
					$avatar = "default_avatar.jpg";
					}
					?>
					<img src="<?=base_url()?>resource/avatar/<?=$avatar?>">
				</span> 
				<?php 
				echo $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') ? $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') : $this->tank_auth->get_username()?> <b class="caret"></b> 	
			</a>
			<ul class="dropdown-menu animated fadeInRight">
				<li> <a href="<?=base_url()?>profile/settings"><?=lang('my_profile')?></a> </li>
				<li> <a href="<?=base_url()?>profile/activities"><span class="badge pull-right" style="background-color:#777;">
					<?php
						$query = $this->db->where('user_rowID',$this->tank_auth->get_user_id())->get('activities');
						echo $query->num_rows();
					?>
				</span> <?=lang('activities')?> 
				</a> </li>						
				<li class="divider"></li>
				<li> <a href="<?=base_url()?>auth/logout" ><?=lang('logout')?></a> </li>
			</ul> 
		</li>
	</ul>

	<br />
	<div  class="text-white font-bold time-header">
		<?php 
			//Array Hari
			date_default_timezone_set('Asia/Bangkok');
			$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
			$array_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$hari = $array_hari[date('N')];
			echo $hari.', ';
			echo date('d').' '.$array_bulan[(int) date('m') - 1].' '.date('Y').' ';
		?>
		<span id="clock"><?php print date('H:i:s'); ?></span>
	</div>
</header>