<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sidebar extends MX_Controller {
function __construct()
	{
		parent::__construct();
		
		$this->load->model('AppModel');
	}
	public function admin_menu()
	{
		$this->load->view('admin_menu',isset($data) ? $data : NULL);
	}
	public function collaborator_menu()
	{
		$this->load->view('collaborator_menu',isset($data) ? $data : NULL);
	}
	public function client_menu()
	{
			
		$datamenu=$this->AppModel->getHeaderUserMenu($this->session->userdata('company_rowID'),$this->session->userdata('dep_rowID'), $this->tank_auth->get_user_id(), $this->tank_auth->get_role_id());
       
		
		// now we will build the dynamic menus.
        $html_out  = "";
        
		if(isset($datamenu)){
			foreach($datamenu->result_array() as $row){	
			
			$datadetailmenu=$this->AppModel->getDetailUserMenu($this->session->userdata('company_rowID'),$this->session->userdata('dep_rowID'),$this->tank_auth->get_user_id(), $this->tank_auth->get_role_id(), $row['bKd_Menu']);
				$page_header="";
				if($this->session->userdata("page_header")==$row['Lang']){
				    $page_header="active";
                }
				$html_out .= "\t\t\t".'<li class ="nav-item '.$page_header.'">'."\n";
				$html_out .= "\t\t\t\t".'<a href="#">'."\n";
				$html_out .= "\t\t\t\t\t".'<span class="pull-right">'."\n";
                $html_out .= "\t\t\t\t\t\t".'<i class="fa fa-angle-down text"></i>'."\n";
				$html_out .= "\t\t\t\t\t\t\t".'<i class="fa fa-angle-up text-active"></i></span>'."\n";
				$html_out .= "\t\t\t".'<span>'.lang($row['Lang']);'</span> '."\n";
				$html_out .= "\t\t\t".'</a>'."\n";
				if(isset($datadetailmenu) && $datadetailmenu->num_rows()>0){	
					$html_out .= "\t\t\t".'<ul class="nav lt">'."\n";
					
					foreach($datadetailmenu->result_array() as $detailrows){
						$page_detail="";
						if($this->session->userdata("page_detail")==$detailrows['Lang']){$page_detail="active";}
						$html_out .= "\t\t\t".'<li class ="'.$page_detail.'"> <a href="'.base_url().$detailrows['cLink_Menu'].'" class="sub-menu">'."\n";
						$html_out .= "\t\t\t".''."\n";
						$html_out .= "\t\t\t".'<span>'.lang($detailrows['Lang']).'</span> </a> </li>'."\n";	
					}					
					$html_out .= "\t\t\t".'</ul>'."\n";
				}
				$html_out .= "\t\t\t".'</li>'."\n";					                
			}		
		}
		
		$data['_html_out']=$html_out;


		$this->load->view('user_menu',isset($data) ? $data : NULL);
	}

	public function general_menu()
	{
		$this->load->view('general_menu',isset($data) ? $data : NULL);
	}	
	public function top_header()
	{
		$this->load->view('top_header',isset($data) ? $data : NULL);
	}
	
	public function scripts()
	{
		$this->load->view('scripts/uni_scripts',isset($data) ? $data : NULL);
	}
	public function flash_msg()
	{
		$this->load->view('flash_msg',isset($data) ? $data : NULL);
	}
}
/* End of file sidebar.php */