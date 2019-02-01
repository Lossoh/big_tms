<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class fare_trip_model extends CI_Model
{

    function save_data_header($dataPost)
    {
        $data_fare_trip = array(
            'destination_from_rowID' => $dataPost['fare_trip_destination_from'],
            'destination_to_rowID' => $dataPost['fare_trip_destination_to'],
            'distance' => str_replace('.', '', $dataPost['fare_trip_distance']),
            'trip_condition' => $dataPost['trip_condition'],
            'poin' => $dataPost['poin'],
            'split' => empty($dataPost['split']) ? 0 : 1,
            'trip_type' => $dataPost['trip_type'],
            'komisi_supir' => str_replace('.', '', $dataPost['komisi_supir']),
            'komisi_kernet' => str_replace('.', '', $dataPost['komisi_kernet']),
            'deposit' => str_replace('.', '', $dataPost['deposit']),
            'min_amount' => str_replace('.', '', $dataPost['min_amount']),
            'os_amount' => str_replace('.', '', $dataPost['os_amount']),
            'note' => $dataPost['note'],
            'vehicle_id' => $dataPost['vehicle_type'],
            'cost_id' => $dataPost['cost_code'],
            'total' => str_replace('.', '', $dataPost['Total']),
            'estimated_time_receipt' => str_replace('.', '', $dataPost['estimated_time_receipt']),
            'effective_date' => date('Y-m-d', strtotime($dataPost['effective_date'])),
            //'fare_trip_no' => $dataPost['destination_from_code'] . '-' . $dataPost['destination_to_code'],
            'fare_trip_cd' => $dataPost['destination_from_code'] . '-' . $dataPost['destination_to_code'],
            'user_created' => $this->session->userdata('user_id'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s'));
        $this->db->insert('sa_fare_trip_hdr', $data_fare_trip);
        return $this->db->insert_id();
    }
    
    function save_update_data_header($dataPost)
    {
        $data_fare_trip = array(
            'poin' => $dataPost['poin'],
            'split' => empty($dataPost['split']) ? 0 : 1,
            'distance' => str_replace('.', '', $dataPost['fare_trip_distance']),
            'komisi_supir' => str_replace('.', '', $dataPost['komisi_supir']),
            'komisi_kernet' => str_replace('.', '', $dataPost['komisi_kernet']),
            'deposit' => str_replace('.', '', $dataPost['deposit']),
            'min_amount' => str_replace('.', '', $dataPost['min_amount']),
            'os_amount' => str_replace('.', '', $dataPost['os_amount']),
            'note' => $dataPost['note'],
            'total' => str_replace('.', '', $dataPost['Total']),
            'estimated_time_receipt' => str_replace('.', '', $dataPost['estimated_time_receipt']),
            'effective_date' => date('Y-m-d', strtotime($dataPost['effective_date'])),
            'fare_trip_cd' => $dataPost['destination_from_code'] . '-' . $dataPost['destination_to_code'],
            'user_modified' => $this->session->userdata('user_id'),
            'date_modified' => date('Y-m-d'),
            'time_modified' => date('H:i:s')
        );
        $this->db->where('rowID', $dataPost['rowID']);
        $this->db->update('sa_fare_trip_hdr', $data_fare_trip);
    }
    
    function activate_data($id)
    {
        $data_fare_trip = array(
            'status' => 1,
            'user_modified' => $this->session->userdata('user_id'),
            'date_modified' => date('Y-m-d'),
            'time_modified' => date('H:i:s')
        );
        $this->db->where('rowID', $id);
        $this->db->update('sa_fare_trip_hdr', $data_fare_trip);
    }
    
    function disactivate_data($id)
    {
        $data_fare_trip = array(
            'status' => 0,
            'user_modified' => $this->session->userdata('user_id'),
            'date_modified' => date('Y-m-d'),
            'time_modified' => date('H:i:s')
        );
        $this->db->where('rowID', $id);
        $this->db->update('sa_fare_trip_hdr', $data_fare_trip);
    }
    
    function delete_data_header($dataPost)
    {
        $data_fare_trip = array(
            'deleted' => 1,
            'user_deleted' => $this->session->userdata('user_id'),
            'date_deleted' => date('Y-m-d'),
            'time_deleted' => date('H:i:s')
        );
        $this->db->where('rowID', $dataPost['rowID']);
        $this->db->update('sa_fare_trip_hdr', $data_fare_trip);
        return $this->db->affected_rows();
    }
    
    function edit_data_header($dataPost)
    {
        $data_fare_trip = array(
            'destination_from_rowID' => $dataPost['fare_trip_destination_from'],
            'destination_to_rowID' => $dataPost['fare_trip_destination_to'],
            'distance' => str_replace('.', '', $dataPost['fare_trip_distance']),
            'trip_type' => $dataPost['trip_type'],
            'trip_condition' => $dataPost['trip_condition'],
            'komisi_supir' => str_replace('.', '', $dataPost['komisi_supir']),
            'komisi_kernet' => str_replace('.', '', $dataPost['komisi_kernet']),
            'deposit' => str_replace('.', '', $dataPost['deposit']),
            'min_amount' => str_replace('.', '', $dataPost['min_amount']),
            'os_amount' => str_replace('.', '', $dataPost['os_amount']),
            'note' => $dataPost['note'],
            'vehicle_id' => $dataPost['vehicle_type'],
            'cost_id' => $dataPost['cost_code'],
            'total' => str_replace('.', '', $dataPost['Total']),
            'estimated_time_receipt' => str_replace('.', '', $dataPost['estimated_time_receipt']),
            'effective_date' => date('Y-m-d', strtotime($dataPost['effective_date'])),
            //'fare_trip_no' => $dataPost['destination_from_code'] . '-' . $dataPost['destination_to_code'],
            'fare_trip_cd' => $dataPost['destination_from_code'] . '-' . $dataPost['destination_to_code'],
            'user_modified' => $this->session->userdata('user_id'),
            'date_modified' => date('Y-m-d'),
            'time_modified' => date('H:i:s'));
        $this->db->where('rowID', $dataPost['rowID']);
        $this->db->update('sa_fare_trip_hdr', $data_fare_trip);
        return $this->db->affected_rows();
    }

    function delete_data_detail_fare_trip($dataPost)
    {
        $data_fare_trip = array(
            'deleted' => 1,
            'user_deleted' => $this->session->userdata('user_id'),
            'date_deleted' => date('Y-m-d'),
            'time_deleted' => date('H:i:s')
        );
        $this->db->where('deleted', 0);
        $this->db->where('fare_trip_hdr_rowID', $dataPost['rowID']);
        $this->db->update('sa_fare_trip_dtl', $data_fare_trip);
        return $this->db->affected_rows();
    }


    function delete_detail($id, $dataPost)
    {
        $this->db->where('fare_trip_hdr_rowID', $id);
        $this->db->delete('sa_fare_trip_dtl');
    }

    function save_data_detail($id, $x, $dataPost, $detail = array())
    {
        $data_fare_trip = array(
            'row_no' => $x,
            'fare_trip_hdr_rowID' => $id,
            //'cost_rowID' => $detail['cost_rowID'],
            //'vehicle_type_rowID' => $detail['vehicle_type_rowID'],
            'reference_id' => $detail['reference_rowID'],
            'fare_trip_amt' => str_replace('.', '', $detail['fare_trip_amt']),
            'effective_date' => date('Y-m-d', strtotime($dataPost['effective_date'])),
            'user_created' => $this->session->userdata('user_id'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s'));
        $this->db->insert('sa_fare_trip_dtl', $data_fare_trip);
    }
    
    function update_data_detail($id, $x, $dataPost, $detail = array(), $get_data)
    {
        $data_fare_trip = array(
            'row_no' => $x,
            'fare_trip_hdr_rowID' => $id,
            //'cost_rowID' => $detail['cost_rowID'],
            //'vehicle_type_rowID' => $detail['vehicle_type_rowID'],
            'reference_id' => $detail['reference_rowID'],
            'fare_trip_amt' => str_replace('.', '', $detail['fare_trip_amt']),
            'effective_date' => date('Y-m-d', strtotime($dataPost['effective_date'])),
            'user_created'=>$get_data->user_created,
            'date_created'=>$get_data->date_created,
            'time_created'=>$get_data->time_created,
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
        $this->db->insert('sa_fare_trip_dtl', $data_fare_trip);
    }

    function save_header_histories($dataHistorisHeader)
    {
        $dataArray = json_decode($dataHistorisHeader, true);
        foreach ($dataArray as $key => $val)
        {
            $data_header = array(
                //'rowID' => $val['rowID'],
                'destination_from_rowID' => $val['destination_from_rowID'],
                'destination_to_rowID' => $val['destination_to_rowID'],
                'fare_trip_no' => $val['fare_trip_no'],
                'distance' => $val['distance'],
                'deleted' => 1,
                'user_created' => $val['user_created'],
                'date_created' => $val['date_created'],
                'time_created' => $val['time_created'],
                'user_modified' => $val['user_modified'],
                'date_modified' => $val['date_modified'],
                'time_modified' => $val['time_modified'],

                );
            $this->db->insert('sa_fare_trip_hdr', $data_header);

        }
    }

    function save_detail_histories($dataHistorisDetail)
    {
        $dataArray = json_decode($dataHistorisDetail, true);
        foreach ($dataArray as $key => $val)
        {

            $data_detail = array(
                //'rowID' => $val['rowID'],
                'fare_trip_hdr_rowID' => $val['fare_trip_hdr_rowID'],
                'vehicle_type_rowID' => $val['vehicle_type_rowID'],
                'row_no' => $val['row_no'],
                'cost_rowID' => $val['cost_rowID'],
                'fare_trip_amt' => $val['fare_trip_amt'],
                'effective_date' => $val['effective_date'],
                'deleted' => 1,
                'user_created' => $val['user_created'],
                'date_created' => $val['date_created'],
                'time_created' => $val['time_created'],
                'user_modified' => $val['user_modified'],
                'date_modified' => $val['date_modified'],
                'time_modified' => $val['time_modified'],

                );
            $this->db->insert('sa_fare_trip_dtl', $data_detail);

        }
    }

    function delete_header($id, $tabel)
    {
        $this->db->where('rowID', $id);
        $this->db->delete($tabel);
    }

    function get_all_fare_trip()
    {
        $this->db->select('a.*,		
							b.destination_no as destination_from_no,
							b.destination_name as destination_from_name,
							c.destination_no as destination_to_no,
							c.destination_name as destination_to_name');
        $this->db->from('sa_fare_trip_hdr AS a');
        $this->db->join('sa_destination AS b', 'b.rowID=a.destination_from_rowID',
            'LEFT');
        $this->db->join('sa_destination AS c', 'c.rowID=a.destination_to_rowID', 'LEFT');
        $this->db->where('a.deleted', '0');
        $this->db->order_by('a.rowID', 'ASC');
        return $this->db->get()->result();
    }

    function get_all_fare_trip_cost()
    {
        $this->db->select('a.*,		
							b.destination_no as destination_from_no,
							b.destination_name as destination_from_name,
							c.destination_no as destination_to_no,
							c.destination_name as destination_to_name,
							d.vehicle_type_rowID as vehicle_type_rowID,
							e.type_name as type_name');
        $this->db->from('sa_fare_trip_hdr AS a');
        $this->db->join('sa_destination AS b', 'b.rowID=a.destination_from_rowID',
            'LEFT');
        $this->db->join('sa_destination AS c', 'c.rowID=a.destination_to_rowID', 'LEFT');
        $this->db->from('sa_fare_trip_dtl AS d', 'd.fare_trip_hdr_rowID=a.rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS e', 'e.rowID = d.vehicle_type_rowID', 'LEFT');
        $this->db->where('a.deleted', '0');
        $this->db->group_by('a.rowID,d.vehicle_type_rowID');
        $this->db->order_by('a.rowID', 'ASC');
        return $this->db->get()->result();
    }


    function get_all_records_list($select, $where, $join_table1, $join_table2, $join_table3,
        $join_criteria1, $join_criteria2, $join_criteria3, $order, $sort)
    {
        $this->db->select($select . '.*,
								' . $join_table1 . '.type_cd AS vehicle_type_code,
								' . $join_table1 . '.type_name AS vehicle_type_name,
								' . $join_table2 . '.from_cd AS destination_from_code,
								' . $join_table2 . '.decs AS destination_from_name,
								' . $join_table3 . '.to_cd AS destination_to_code,
								' . $join_table3 . '.descs AS destination_to_name');
        $this->db->from($select);
        $this->db->where($where);

        if ($join_table1)
        {
            $this->db->join($join_table1, $join_criteria1, 'LEFT');
        }

        if ($join_table2)
        {
            $this->db->join($join_table2, $join_criteria2, 'LEFT');
        }

        if ($join_table3)
        {
            $this->db->join($join_table3, $join_criteria3, 'LEFT');
        }

        $query = $this->db->order_by($order, $sort)->get();
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }

    function get_by_id($id)
    {
        $this->db->select('a.*,b.destination_no as destination_from_code,c.destination_no as destination_to_code,d.*');
        $this->db->from('sa_fare_trip_hdr as a');
        $this->db->join('sa_destination as b', 'b.rowID=a.destination_from_rowID',
            'left');
        $this->db->join('sa_destination as c', 'c.rowID=a.destination_to_rowID', 'left');
        $this->db->join('sa_fare_trip_dtl as d', 'd.fare_trip_hdr_rowID=a.rowID', 'left');
        $this->db->where('a.rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function delete_data($tabel, $id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }

    function delete_data_detail($tabel, $id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('fare_trip_hdr_rowID', $id);
        return $this->db->update($tabel);

    }

    function get_all_record_data()
    {

        $this->db->select("a.*,
                CONCAT(c.destination_no,' - ',c.destination_name) AS destination_from,
                CONCAT(c.destination_name,', ',c.address1,', ',c.address2,', ',c.address3,', ',c.post_cd) AS origin,
                CONCAT(d.destination_no,' - ',d.destination_name) as destination_to ,
                CONCAT(d.destination_name,', ',d.address1,', ',d.address2,', ',d.address3,', ',d.post_cd) AS destination
        ", false);
        $this->db->from('sa_fare_trip_hdr as a');
        $this->db->join('sa_destination as c', 'c.rowID = a.destination_from_rowID',
            'left');
        $this->db->join('sa_destination as d', 'd.rowID = a.destination_to_rowID',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.status desc, a.fare_trip_cd asc, a.rowID asc', '');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }

    function get_all_record_data_active()
    {

        $this->db->select("a.*,
                CONCAT(c.destination_no,' - ',c.destination_name) AS destination_from,
                CONCAT(d.destination_no,' - ',d.destination_name) as destination_to,
                CONCAT(e.latitude,',',e.longitude) as origin,
                CONCAT(f.latitude,',',f.longitude) as destination
        ", false);
        $this->db->from('sa_fare_trip_hdr as a');
        $this->db->join('sa_destination as c', 'c.rowID = a.destination_from_rowID',
            'left');
        $this->db->join('sa_destination as d', 'd.rowID = a.destination_to_rowID',
            'left');
        $this->db->join('sa_koordinat_poi as e', 'e.rowID = c.coordinate_rowID',
            'left');
        $this->db->join('sa_koordinat_poi as f', 'f.rowID = d.coordinate_rowID',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.status', 1);
        $this->db->order_by('a.fare_trip_cd asc, a.rowID desc', '');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }

    function get_all_record_data_not_active()
    {

        $this->db->select("a.*,
                CONCAT(c.destination_no,' - ',c.destination_name) AS destination_from,
                CONCAT(d.destination_no,' - ',d.destination_name) as destination_to,
                CONCAT(e.latitude,',',e.longitude) as origin,
                CONCAT(f.latitude,',',f.longitude) as destination
        ", false);
        $this->db->from('sa_fare_trip_hdr as a');
        $this->db->join('sa_destination as c', 'c.rowID = a.destination_from_rowID',
            'left');
        $this->db->join('sa_destination as d', 'd.rowID = a.destination_to_rowID',
            'left');
        $this->db->join('sa_koordinat_poi as e', 'e.rowID = c.coordinate_rowID',
            'left');
        $this->db->join('sa_koordinat_poi as f', 'f.rowID = d.coordinate_rowID',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.status', 0);
        $this->db->order_by('a.fare_trip_cd asc, a.rowID desc', '');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }

    function get_all_records($table, $where, $join_table, $join_criteria, $order, $sort)
    {
        $this->db->where($where);
        if ($join_table)
        {
            $this->db->join($join_table, $join_criteria);
        }
        $query = $this->db->order_by($order, $sort)->get($table);
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }

    function get_fare_trip_dtl($fare_trip_rowID)
    {
        $this->db->select('a.*,	
							b.destination_no as destination_from_no,
							b.destination_name as destination_from_name,
							c.destination_no as destination_to_no,
							c.destination_name as destination_to_name,
                            d.type_name'
                        );
        $this->db->from('sa_fare_trip_hdr AS a');
        $this->db->join('sa_destination AS b', 'b.rowID=a.destination_from_rowID',
            'LEFT');
        $this->db->join('sa_destination AS c', 'c.rowID=a.destination_to_rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS d', 'd.rowID=a.vehicle_id', 'LEFT');
        $this->db->where('a.deleted', '0');
        $this->db->where('a.rowID', $fare_trip_rowID);
        $this->db->order_by('a.rowID', 'ASC');
        return $this->db->get()->result();
    }

    function get_fare_trip_amount($fare_trip_hdr_rowID, $vehicle_type_rowID)
    {

        $this->db->select_sum('b.fare_trip_amt');
        $this->db->from('sa_fare_trip_hdr AS a');
        $this->db->join('sa_fare_trip_dtl AS b', 'a.rowID = b.fare_trip_hdr_rowID');
        $this->db->where('a.vehicle_id', $vehicle_type_rowID);
        $this->db->where('b.fare_trip_hdr_rowID', $fare_trip_hdr_rowID);
        $query = $this->db->get();
        foreach ($query->result() as $row)
        {
            $fare_trip_amt = $row->fare_trip_amt ? $row->fare_trip_amt : 0;
            return round($fare_trip_amt);
        }

    }
    
   	function get_table_by_id($tabel,$rowID)
	{
		$this->db->from($tabel);
		$this->db->where('rowID',$rowID);
		$query = $this->db->get();
		return $query->row();
	}

    /* 	function fare_trip_details($fare_trip)
    {
    $this->db->select('a.*,
    b.type_cd as vehicle_type_code, 
    b.type_name as vehicle_type_name, 
    c.from_cd as destination_from_code,
    c.decs as destination_from_name,
    d.to_cd as destination_to_code,
    d.descs as destination_to_name');
    $this->db->from('sa_fare_trip AS a');
    $this->db->join('sa_vehicle_type AS b','a.vehicle_type_rowID = b.rowID', 'LEFT');
    $this->db->join('sa_destination_from AS c','a.destination_from_rowID=c.rowID', 'LEFT');
    $this->db->join('sa_destination_to AS d','a.destination_to_rowID=d.rowID', 'LEFT');
    $this->db->where('a.rowID',$fare_trip);
    return $this->db->get()->result_array(); 
    } */


}

/* End of file model.php */
