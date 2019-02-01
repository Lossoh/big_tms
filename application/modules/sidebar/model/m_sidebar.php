<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_sidebar extends CI_Model
{
 
	function getHeaderUserMenu($kd_perusahaan, $kd_cabang, $kd_user){

		$q=  $this->db->query("SELECT b.Kd_Menu as bKd_Menu, c.Nm_Menu as cNm_Menu , c.Link_Menu as cLink_Menu
								, c.ParentID as cParentID
								 FROM users a 
								 LEFT JOIN mst_usermenu b ON a.company_code= b.company_code AND a.site_code=b.site_code AND a.id=b.id
        						 LEFT JOIN mst_menu c ON b.Kd_Menu=c.Kd_Menu
								 WHERE a.company_code='$kd_perusahaan' AND a.site_code='$kd_cabang' AND a.id='$kd_user' AND c.ParentID=0 AND b.Actived=1");
		return $q;
	
	}

	function getDetailUserMenu($kd_perusahaan, $kd_cabang, $kd_user,$kd_menu){
        $q=  $this->db->query("SELECT a.Kd_Perusahaan as aKdPerusahaan, c.Collapse as cCollapse,  b.Kd_Menu as bKd_Menu,  c.Nm_Menu as cNm_Menu , c.Link_Menu as cLink_Menu, c.ParentID as cParentID, b.Actived as bActived, c.Collapse
								 FROM users a 
								 LEFT JOIN mst_usermenu b ON a.Kd_Perusahaan= b.Kd_Perusahaan AND a.Kd_Cabang=b.Kd_Cabang AND a.Kd_User=b.Kd_User
        						 LEFT JOIN mst_menu c ON b.Kd_Menu=c.Kd_Menu
								 WHERE a.Kd_Perusahaan='$kd_perusahaan' AND a.Kd_Cabang='$kd_cabang' AND a.Kd_User='$kd_user' AND c.ParentID=$kd_menu  AND b.Actived=1 AND c.Kd_Menu Is Not Null Order By Collapse, c.Kd_Menu  ASC");
		return $q;
	
	}
	function getPermissionUser($kd_perusahaan, $kd_cabang, $kd_user,$kd_menu){
		 $q=  $this->db->query("SELECT Created, Viewed, Updated, Deleted, Kondisi, Surat, Alat 
										 FROM usersmenu a LEFT JOIN mst_menu b ON a.kd_menu =b.kd_menu 
										 WHERE Kd_Perusahaan='$kd_perusahaan' AND Kd_Cabang='$kd_cabang' AND Kd_User='$kd_user' AND Actived=1 AND Link_Menu ='$kd_menu' Order By b.Kd_Menu  ASC");
		return $q;
	}
	
	

	
}