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

class Projects_model extends CI_Model
{

    var $column_order = array('projects.status', 'projects.name', 'projects.edate', 'projects.worth', null);
    var $column_search = array('projects.name', 'projects.edate', 'projects.status');
    var $tcolumn_order = array('status', 'name', 'duedate', 'start', null, null);
    var $tcolumn_search = array('name', 'edate', 'status');
    var $order = array('id' => 'desc');

    //Get Details for explore page
    public function explore($id)
    {
        //project
        $this->db->select('projects.*,customers.name AS customer,customers.email');
        $this->db->from('projects');
        $this->db->where('projects.id', $id);
        $this->db->join('customers', 'projects.cid = customers.id', 'left');
        $query = $this->db->get();
        $project = $query->row_array();
        //employee
        $this->db->select('employee_profile.name');
        $this->db->from('project_meta');
        $this->db->where('project_meta.pid', $id);
        $this->db->where('project_meta.meta_key', 6);
        $this->db->join('employee_profile', 'project_meta.meta_data = employee_profile.id', 'left');
        $query = $this->db->get();
        $employee = $query->result_array();
        //invoices
        $this->db->select('invoices.*');
        $this->db->from('project_meta');
        $this->db->where('project_meta.pid', $id);
        $this->db->where('project_meta.meta_key', 11);
        $this->db->join('invoices', 'project_meta.meta_data = invoices.tid', 'left');
        $query = $this->db->get();
        $invoices = $query->result_array();

        return array('project' => $project, 'employee' => $employee, 'invoices' => $invoices);

    }

    //Get project details
    public function details($id)
    {
//project
        $this->db->select('projects.*,projects.id AS prj, customers.name AS customer,project_meta.*');
        $this->db->from('projects');
        $this->db->where('projects.id', $id);
        $this->db->where('project_meta.meta_key', 2);
        $this->db->join('customers', 'projects.cid = customers.id', 'left');
        $this->db->join('project_meta', 'project_meta.pid = projects.id', 'left');

        $query = $this->db->get();
        return $query->row_array();
    }

    //Get Projec details
    private function _project_datatables_query($cday = '')
    {
        $this->db->select("projects.*,customers.name AS customer");
        $this->db->from('projects');
        $this->db->join('customers', 'projects.cid = customers.id', 'left');

        if ($cday) {
            $this->db->where('DATE(projects.edate)=', $cday);
        }


        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->column_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    //Get project details for datatables 
    function project_datatables($cday = '')
    {


        $this->_project_datatables_query($cday);

        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

     //Get project details for datatables 
    function project_count_filtered($cday = '')
    {
        $this->_project_datatables_query($cday);
        $query = $this->db->get();
        return $query->num_rows();
    }
     //count project details for datatables 
    public function project_count_all($cday = '')
    {
        $this->_project_datatables_query($cday);
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	//count all details for specific table 
    public function count_all($table,$status)
    {
        $this->db->select('*');
        $this->db->from($table);
		if($status != ''){
         $this->db->where('show_status', $status);
		}
        $query = $this->db->get();
        return $query->num_rows();
    }
    //Add project
    public function addproject($classification,$name, $status, $quota,$budget,$employee, $sdate,$setupdate, $setuptime,$note,$hourlyrate,$tlcomission,$default_warehouse,$shipping_option,$tag,$task_communication,$location)
    {
        if($classification=="kiosk" || $classification=="Kiosk"){
             
        }else{
            $location="";
        }
        $data = array('name' => $name,
            'classification'=>$classification,
            'status' => $status,
            'quota'=>$quota,
            'budget'=>$budget,
            'employee_id'=>$employee,
            'sdate' => $sdate,
            'setupdate'=>$setupdate,
            'setuptime'=>$setuptime,
            'note' => $note,
            'hourlyrate'=>$hourlyrate,
            'tlcomission'=>$tlcomission,
            'default_warehouse'=>$default_warehouse,
            'shipping_option'=>$shipping_option,
            'task_communication'=>$task_communication,
            'location'=>$location,
            'tag'=>$tag);

        $this->db->insert('projects', $data);

        $last = $this->db->insert_id();
        
        $title = '[Project Created] ';
        $this->add_activity($title, $last);
        $data = array('pid' => $last, 'meta_key' => 2, 'meta_data' => $customerview, 'value' => $customer_comment);
        $this->db->insert('project_meta', $data);

        if ($employee) {
            foreach ($employee as $key => $value) {

                $data = array('pid' => $last, 'meta_key' => 19, 'meta_data' => $value);
                $this->db->insert('project_meta', $data);
            }
        } else {
            $data = array('pid' => $last, 'meta_key' => 19, 'meta_data' => $this->aauth->get_user()->id);
            $this->db->insert('project_meta', $data);
        }


        if ($link_to_cal > 0) {
            if ($link_to_cal == 1) {
                $sdate = $edate;
            }
            $data = array(
                'title' => '[Project] ' . $name,
                'start' => $sdate,
                'end' => $edate,
                'description' => $priority . ' priority. Start date: ' . $sdate . ' End Date: ' . $edate, 'color' => $color,
                'rel' => 1,
                'rid' => $last
            );
            $this->db->insert('events', $data);
        }

       return $last;
       
    }

    //Edit project
    public function editproject($pid,$classification,$name, $status, $quota, $budget,$employee, $sdate, $setupdate,$setuptime,$note,$hourly_rate, $tag,$tl_commission,$default_warehouse,$shipping_option,$location)
    {
        $title = '[Project Edited] ';
        $this->add_activity($title, $pid);
        if($classification=="kiosk" ||$classification=="Kiosk"){
           
        }else{
            $location="";
        }
        $data = array('classification'=>$classification,'name' => $name, 'status' => $status,'quota'=>$quota,'budget'=>$budget ,'employee_id'=>$employee,'sdate' => $sdate, 'setupdate' => $setupdate,'setuptime'=>$setuptime,'note' => $note,'hourlyrate'=>$hourly_rate ,'tag' => $tag, 'tlcomission'=>$tl_commission,'default_warehouse'=>$default_warehouse,'shipping_option'=>$shipping_option,'location'=>$location);
        $this->db->set($data);
        $this->db->where('id', $pid);
        $out = $this->db->update('projects');  

        $this->db->delete('events', array('rel' => 1, 'rid' => $pid));

        $data1 = array('meta_data' => $customerview, 'value' => $customer_comment);
        $this->db->set($data1);
        $this->db->where('pid', $pid);
        $this->db->where('meta_key', 2);

        return $this->db->update('project_meta');
    }


    //Add tasks
    public function addtask($name, $status, $priority, $stdate, $tdate, $employee, $assign, $content, $prid, $milestone)
    {

        $data = array('tdate' => date('Y-m-d H:i:s'), 'name' => $name, 'status' => $status, 'start' => $stdate, 'duedate' => $tdate, 'description' => $content, 'eid' => $employee, 'aid' => $assign, 'related' => 1, 'priority' => $priority, 'rid' => $prid);
        if ($prid) {

            $this->db->insert('todolist', $data);
            $last = $this->db->insert_id();

            if ($milestone) {
                $this->meta_insert($prid, 8, $milestone, $last);
            }

            $out = $this->communication($prid, $name);

            return 1;
        } else {
            return 0;
        }
    }

    //Add Milestones
    public function add_milestone($name, $stdate, $tdate, $content, $color, $prid)
    {

        $data = array('pid' => $prid, 'name' => $name, 'sdate' => $stdate, 'edate' => $tdate, 'color' => $color, 'exp' => $content);
        if ($prid) {

            $title = '[Milestone] ' . $name;
            $this->add_activity($title, $prid);

            return $this->db->insert('milestones', $data);

        } else {
            return 0;
        }
    }

    //Edit Tasks
    public function edittask($id, $name, $status, $priority, $stdate, $tdate, $employee, $content)
    {

        $data = array('tdate' => date('Y-m-d H:i:s'), 'name' => $name, 'status' => $status, 'start' => $stdate, 'duedate' => $tdate, 'description' => $content, 'eid' => $employee, 'related' => 0, 'priority' => $priority, 'rid' => 0);
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('todolist');
        //return $this->db->insert('todolist', $data);
    }

    //Set Tasks
    public function settask($id, $stat)
    {

        $data = array('status' => $stat);
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('todolist');
    }

    //Set notes
    public function setnote($id, $stat)
    {

        $data = array('note' => $stat);
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('projects');
    }

    //Delete Tasks
    public function deletetask($id)
    {

        return $this->db->delete('todolist', array('id' => $id));
    }

    //Delete projects
    public function deleteproject($id)
    {
        $this->db->delete('todolist', array('related' => 1, 'rid' => $id));

        return $this->db->delete('projects', array('id' => $id));
         //$this->db->delete('projects', array('id' => $id));

        
    }

    //View tasks
    public function viewtask($id)
    {

        $this->db->select('todolist.*,employee_profile.name AS emp, assi.name AS assign');
        $this->db->from('todolist');
        $this->db->where('todolist.id', $id);
        $this->db->join('employee_profile', 'employee_profile.id = todolist.eid', 'left');
        $this->db->join('employee_profile AS assi', 'assi.id = todolist.aid', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    //Get Project by states
    public function project_stats($project)
    {

        $query = $this->db->query("SELECT
				COUNT(IF( status = 'Waiting', id, NULL)) AS Waiting,
				COUNT(IF( status = 'Progress', id, NULL)) AS Progress,
				COUNT(IF( status = 'Finished', id, NULL)) AS Finished			
				FROM projects");

        echo json_encode($query->result_array());

    }

    //project tasks

    private function _task_datatables_query($cday = '')
    {

        $this->db->from('todolist');
        $this->db->where('related', 1);
        if ($cday) {

            $this->db->where('rid=', $cday);
        }


        $i = 0;

        foreach ($this->tcolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->tcolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->tcolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    //Get tasks details for data table
    function task_datatables($cday = '')
    {


        $this->_task_datatables_query($cday);

        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $this->db->where('related', 1);
        $this->db->where('rid=', $cday);
        $query = $this->db->get();
        return $query->result();
    }

    //filers tasks details for data table
    function task_count_filtered($cday = '')
    {
        $this->_task_datatables_query($cday);
        $this->db->where('related', 1);
        $this->db->where('rid=', $cday);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Get tasks details 
    public function task_count_all($cday = '')
    {
        $this->_task_datatables_query($cday);
        $this->db->where('related', 1);
        $this->db->where('rid=', $cday);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //thread task
    public function task_thread($id)
    {

        $this->db->select('todolist.*, employee_profile.name AS emp');
        $this->db->from('todolist');
        $this->db->where('todolist.related', 1);
        $this->db->where('todolist.rid', $id);
        $this->db->join('employee_profile', 'todolist.eid = employee_profile.id', 'left');
        $this->db->order_by('todolist.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Get Milestones
    public function milestones($id)
    {

        $this->db->select('*');
        $this->db->from('milestones');
        $this->db->where('pid', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Get Milestone list
    public function milestones_list($id)
    {

        $query = $this->db->query('SELECT milestones.*,todolist.name as task FROM milestones LEFT JOIN project_meta ON project_meta.meta_data=milestones.id AND project_meta.meta_key=8 LEFT JOIN todolist ON project_meta.value=todolist.id WHERE milestones.pid=' . $id . ' ORDER BY milestones.id DESC;');
        return $query->result_array();


    }

    //Get Activities
    public function activities($id)
    {

        $this->db->select('project_meta.value');
        $this->db->from('project_meta');
        $this->db->where('pid', $id);
        $this->db->where('meta_key', 12);
        $query = $this->db->get();
        return $query->result_array();
    }

      //Get project files
    public function p_files($id)
    {

        $this->db->select('*');
        $this->db->from('project_meta');
        $this->db->where('pid', $id);
        $this->db->where('meta_key', 9);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Add Activities
    public function add_activity($name, $prid)
    {

        $data = array('pid' => $prid, 'meta_key' => 12, 'value' => $name . ' @' . date('Y-m-d H:i:s'));
        if ($prid) {
            return $this->db->insert('project_meta', $data);
        } else {
            return 0;
        }
    }

    //Add Metadata for projects
    public function meta_insert($prid, $meta_key, $meta_data, $value)
    {

        $data = array('pid' => $prid, 'meta_key' => $meta_key, 'meta_data' => $meta_data, 'value' => $value);
        if ($prid) {
            return $this->db->insert('project_meta', $data);
        } else {
            return 0;
        }
    }   

    //Delete file
    public function deletefile($pid, $mid)
    {

        $this->db->select('value');
        $this->db->from('project_meta');
        $this->db->where('pid', $pid);
        $this->db->where('meta_key', 9);
        $this->db->where('meta_data', $mid);
        $query = $this->db->get();
        $result = $query->row_array();
        unlink(FCPATH . 'userfiles/project/' . $result['value']);
        $this->db->delete('project_meta', array('pid' => $pid, 'meta_key' => 9, 'meta_data' => $mid));
    }

    //Delete Milestones for Store
    public function deletemilestone($mid)
    {
        $this->db->delete('milestones', array('id' => $mid));
    }

   

    //comments
    public function comments_thread($id)
    {

        $this->db->select('project_meta.value, project_meta.key3,employee_profile.name AS employee, customers.name AS customer');
        $this->db->from('project_meta');
        $this->db->where('project_meta.pid', $id);
        $this->db->where('project_meta.meta_key', 13);
        $this->db->join('employee_profile', 'project_meta.meta_data = employee_profile.id', 'left');
        $this->db->join('customers', 'project_meta.key3 = customers.id', 'left');
        $this->db->order_by('project_meta.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Add Comments
    public function add_comment($comment, $prid, $emp)
    {

        $data = array('pid' => $prid, 'meta_key' => 13, 'meta_data' => $emp, 'value' => $comment . '<br><small>@' . date('Y-m-d H:i:s') . '</small>');
        if ($prid) {
            return $this->db->insert('project_meta', $data);
        } else {
            return 0;
        }
    }

    //Updates Progress for project
    public function progress($id, $val)
    {
        if ($val == 100) $stat = 'Finished'; else $stat = 'Progress';
        $data = array('status' => $stat, 'progress' => $val);
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('projects');
    }


    //Get Tasks states
    public function task_stats($id)
    {
        $query = $this->db->query("SELECT
				COUNT(IF( status = 'Due', id, NULL)) AS Due,
				COUNT(IF( status = 'Progress', id, NULL)) AS Progress,
				COUNT(IF( status = 'Done', id, NULL)) AS Done
				FROM todolist WHERE related=1 AND rid=$id");

        echo json_encode($query->result_array());

    }

    //Get list of employee
    public function list_project_employee($id)
    {
        $this->db->select('employee_profile.*');
        $this->db->from('project_meta');
        $this->db->where('project_meta.pid', $id);
        $this->db->where('project_meta.meta_key', 19);
        $this->db->join('employee_profile', 'employee_profile.id = project_meta.meta_data', 'left');
        $this->db->join('aauth_users', 'employee_profile.id = aauth_users.id', 'left');
        $this->db->order_by('aauth_users.roleid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    } 
	
	//Get list of employee
    public function list_store_employee($id)
    {
		$this->db->select('*');
        $this->db->from('projects');
        $this->db->where('projects.id',$id);
        $query=$this->db->get()->row();

        $salesperson_id=$query->employee_id;

      
        return $salesperson_id;
        
    }

    //Get loggedin user details
    public function getUSerDetails()
    {
        $this->db->select('aauth_users.*');
        $this->db->from('aauth_users');
        $this->db->where('aauth_users.id',$this->session->userdata('id'));
        $query=$this->db->get();

        return $query->result_array();

    }

    //Add Tasks by communication
    private function communication($id, $sub)
    {

        $this->db->select('projects.name as pname,projects.ptype,customers.name as cust,customers.email');
        $this->db->from('projects');
        $this->db->where('projects.id', $id);
        $this->db->join('customers', "customers.id = projects.cid", 'left');
        $query = $this->db->get();
        $result = $query->row_array();

        if ($result['ptype'] == '1') {
            $this->db->select('aauth_users.email,aauth_users.username');
            $this->db->from('project_meta');
            $this->db->where('project_meta.pid', $id);
            $this->db->where('project_meta.meta_key', 19);
            $this->db->join('aauth_users', "project_meta.meta_data = aauth_users.id", 'left');
            $query = $this->db->get();
            $result_c = $query->result_array();
            $message = '<h3>Dear Project Participant,</h3>
                        <p>This is an update mail regarding your project ' . $result['pname'] . '</p> <p>A new task has been added ' . $sub . '</p><p>With Reagrds,<br>Project Communication Manager';
            foreach ($result_c as $row) {
                $this->send_email($row['email'], $row['username'], '[Task Added]' . $sub, $message);
            }


        } else if ($result['ptype'] == '2') {

            $this->db->select('aauth_users.email,aauth_users.username');
            $this->db->from('project_meta');
            $this->db->where('project_meta.pid', $id);
            $this->db->where('project_meta.meta_key', 19);
            $this->db->join('aauth_users', "project_meta.meta_data = aauth_users.id", 'left');
            $query = $this->db->get();
            $result_c = $query->result_array();
            $message = '<h3>Dear Project Participant,</h3>
                        <p>This is an update mail regarding your project ' . $result['pname'] . '</p> <p>A new task has been added <strong>' . $sub . '</strong></p><p>With Regards,<br>Project Communication Manager</p>';
            foreach ($result_c as $row) {
                $this->send_email($row['email'], $row['username'], '[Task Added] ' . $sub, $message);
            }

            $message = '<h3>Dear Customer,</h3>
                        <p>This is an update mail regarding your project ' . $result['pname'] . '</p> <p>A new task has been added <strong>' . $sub . '</strong></p><p>With Warm Regards,<br>Project Communication Manager</p>';

            $this->send_email($result['email'], $result['cust'], '[Task Added] ' . $sub, $message);

        }

    }


    //Send Email
    private function send_email($mailto, $mailtotitle, $subject, $message, $attachmenttrue = false, $attachment = '')
    {
        $this->load->library('ultimatemailer');
        $this->db->select('host,port,auth,username,password,sender');
        $this->db->from('sys_smtp');
        $query = $this->db->get();
        $smtpresult = $query->row_array();
        $host = $smtpresult['host'];
        $port = $smtpresult['port'];
        $auth = $smtpresult['auth'];
        $username = $smtpresult['username'];;
        $password = $smtpresult['password'];
        $mailfrom = $smtpresult['sender'];
        $mailfromtilte = $this->config->item('ctitle');

        $this->ultimatemailer->bin_send($host, $port, $auth, $username, $password, $mailfrom, $mailfromtilte, $mailto, $mailtotitle, $subject, $message, $attachmenttrue, $attachment);

    }

    //Add Booths
    public function addbooth($prid,$size,$cost,$description, $product,$teamleader)
    {
      
        $data = array('prid' => $prid,'size'=>$size,'cost'=>$cost,'description'=>$description,'product_id'=>$product,'teamleader_id'=>$teamleader,'user_id'=>$this->session->userdata('id'));
       // $this->db->insert('storebooth', $data);

        if($this->db->insert('storebooth', $data))
        {
            return 1;
        }
        else
        {
            return 0;
        }
       
    }

    public function applyTeamLeader($teamleaderid,$projectid)
    {
        $data=array('project_id' => $projectid,'TeamLeader_id'=>$teamleaderid );

        if($this->db->insert('teamleader_apply_show',$data))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    //Get Booth List Belongs to Store ID
   public function getBoothbyid($id)
   {
     
         $this->db->select('*');

        $this->db->from('storebooth');

        $this->db->join('products','products.pid=storebooth.product_id','left');

       // $this->db->join('employee_profile.id=storebooth.teamleader_id','left');

        $this->db->where('prid=',$id);

        $query = $this->db->get();

        return $query->result_array();



   }
  


}