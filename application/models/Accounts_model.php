<?php
/**
 * Neo Billing -  Accounting,  Invoicing  and CRM Software
 * Copyright (c) Rajesh Dukiya. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@ultimatekode.com
 *  Website: https://www.ultimatekode.com
 *
 *  ************************************************************************
 *  * This software is furnished under a license and may be used and copied
 *  * only  in  accordance  with  the  terms  of such  license and with the
 *  * inclusion of the above copyright notice.
 *  * If you Purchased from Codecanyon, Please read the full License from
 *  * here- http://codecanyon.net/licenses/standard/
 * ***********************************************************************
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Accounts_model extends CI_Model
{
    var $table = 'accounts';

    public function __construct()
    {
        parent::__construct();
    }

    public function accountslist()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function details($acid)
    {

        $this->db->select('*');
        $this->db->from('accounts');
        $this->db->where('id', $acid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function addnew($accno, $holder, $intbal, $acode)
    {
        $data = array(
            'acn' => $accno,
            'holder' => $holder,
            'lastbal' => $intbal,
            'code' => $acode
        );

        if ($this->db->insert('accounts', $data)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }

    }

    public function edit($acid, $accno, $holder, $acode)
    {
        $data = array(
            'acn' => $accno,
            'holder' => $holder,
            'code' => $acode
        );


        $this->db->set($data);
        $this->db->where('id', $acid);

        if ($this->db->update('accounts')) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }

    }

    public function account_stats()
    {

        $query = $this->db->query("SELECT SUM(lastbal) AS balance,COUNT(id) AS count_a FROM accounts");


        echo json_encode($query->result_array());

    }
    public function getTeamLeaderIdsToNotify(){
        $ret_array = array();
        $limit = 500;
        $ret = $this->db->select('employee_profile.id,employee_profile.name')
        ->from('employee_profile')
        ->join('accounts','accounts.acn=employee_profile.ac_num','inner')
        ->where('accounts.lastbal >','500')
        ->get()
        ->result_array();
        foreach ($ret as $r) {
            $salesid = $r['id'];
            // $salesname= $r['name'];
            $shows = $this->db->select('shows.*')
            ->from('shows')
            ->where("(show_assign_to like '%,$salesid,%' or show_assign_to like '$salesid,%' or show_assign_to like '%,$salesid' or show_assign_to = '$salesid') and show_start_date <= NOW() and show_end_date >= NOW()")
            ->get()
            ->result_array();
            foreach ($shows as $show) {
            //     array_push($ret_array,array("sales_id"=>$r['id'],
            //     "sales_name"=>$r['name'],
            //     "show_id"=>$show['id'],
            //     "show_name"=>$show['show_name'],
            //     // "team_lead_id"=>$team['id'],
            //     // "team_lead_name"=>$team['name']
            // ));
                $temls = $this->db->select('employee_profile.id,employee_profile.name,aauth_users.device_token')
        ->from('employee_profile')
        ->join('show_request','show_request.teamleader_id= employee_profile.id')
        ->join('aauth_users','aauth_users.id= employee_profile.id')
        ->where('show_request.show_id',$show['id'])
        ->where('show_request.status','1')
        ->where('show_request.delete_flag','0')->get()
        ->result_array();
        foreach($temls as $team){
            array_push($ret_array,array("sales_id"=>$r['id'],
                "sales_name"=>$r['name'],
                "show_id"=>$show['id'],
                "show_name"=>$show['show_name'],
                "team_lead_id"=>$team['id'],
                "team_lead_name"=>$team['name'],
                "team_lead_device_token"=>$team['device_token']
            ));
        }
                
            }
            
        }
        return $ret_array;
    }

}