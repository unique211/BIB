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
defined('BASEPATH') or exit('No direct script access allowed');
class Projects extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->load->library("Aauth");
        $this->load->model('projects_model', 'projects');
        $this->load->model('shows_model', 'shows');
        $this->load->model('tools_model', 'tools');
        $this->load->model('products_model', 'products');
        $this->load->model('Invoices_model', 'invoice');
        $this->load->model('Accounts_model', 'account');
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if ($this->aauth->get_user()->roleid != -1 and $this->aauth->get_user()->roleid < 1) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
    }

    //     //todo section
    public function index()
    {
        $this->session->set_userdata('favourite_website', $this->aauth->get_user()->roleid);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Project List';
        $data['totalt'] = $this->projects->project_count_all();
        $this->load->model('Projects_model', 'getUSerDetails');
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/index', $data);
        $this->load->view('fixed/footer');
    }
    public function explore()
    {
       //change by sagar -for salesperson--01-01-2020--strat
       if($this->aauth->get_user()->roleid ==2){//change by sagar for salesperson --01-01-2020
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Store Overview';
        $data['totalt'] = $this->projects->task_count_all($id);
        $explore = $this->projects->explore($id);
        $data['thread_list'] = $this->projects->task_thread($id);
        $data['milestones'] = $this->projects->milestones_list($id);
        $data['activities'] = $this->projects->activities($id);
        $data['p_files'] = $this->projects->p_files($id);
        $data['comments_list'] = $this->projects->comments_thread($id);
        $data['emp'] = $this->projects->list_project_employee($id);
        $data['project'] = $explore['project'];
        $data['invoices'] = $explore['invoices'];
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/explore1', $data);
        $this->load->view('fixed/footer');

        //change by sagar -for salesperson--01-01-2020--End

       }else{
       
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Store Overview';
        $data['totalt'] = $this->projects->task_count_all($id);
        $explore = $this->projects->explore($id);
        $data['thread_list'] = $this->projects->task_thread($id);
        $data['milestones'] = $this->projects->milestones_list($id);
        $data['activities'] = $this->projects->activities($id);
        $data['p_files'] = $this->projects->p_files($id);
        $data['comments_list'] = $this->projects->comments_thread($id);
        $data['emp'] = $this->projects->list_project_employee($id);
        $data['project'] = $explore['project'];
        $data['invoices'] = $explore['invoices'];
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/explore', $data);
        $this->load->view('fixed/footer');
       }
    }
    public function addstore()
    {
        if ($this->aauth->get_user()->roleid !=  5) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        if ($this->input->post()) {

           // $classification = 'store';
			 $classification = $this->input->post('project_type1');
           $name = $this->input->post('project_type1');
            $name = $this->input->post('name');
            $status = $this->input->post('status');
            $quota = $this->input->post('quota');
            $budget = $this->input->post('budget');
            $employee_array = $this->input->post('employee');
            $employee='';
            if(isset($employee_array)){
                $employee = implode(',', $employee_array);
            }

           
            $startdate = $this->input->post('sdate');
            $sdate = datefordatabase($startdate);
            $setdate = $this->input->post('setupdate');
            $setupdate = datefordatabase($setdate);
            $setuptime = $this->input->post('setuptime');
            $note = $this->input->post('note');
            $hourlyrate = $this->input->post('hourly_rate');
            $tlcomission = $this->input->post('tl_commission');
            $default_warehouse = $this->input->post('default_warehouse');
            $shipping_option = $this->input->post('shiptype');
            $tag = $this->input->post('tags');
            $task_communication = $this->input->post('task_communication');
            $location = $this->input->post('location');//add by sagar
            if ($this->projects->addproject($classification, $name, $status, $quota, $budget, $employee, $sdate, $setupdate, $setuptime, $note, $hourlyrate, $tlcomission, $default_warehouse, $shipping_option, $tag, $task_communication,$location)) {
                echo json_encode(array('status' => 'Success', 'message' => '[Project] ' . $this->lang->line('ADDED')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR').$sdate."".$setupdate));
            }
        } else {
            $this->load->model('employee_model', 'employee');
            $this->load->model('Categories_model', 'warehouse');
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['emp'] = $this->employee->list_employee();
            $data['locations'] = $this->getLocationsAPI();
            $data['warehouse'] = $this->warehouse->warehouselistwithouttl();
            $head['title'] = 'Add Project';
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/addproject', $data);
            $this->load->view('fixed/footer');
        }
    }
    //     //edit project
    public function edit()
    {
        if ($this->input->post()) {
            $pid = $this->input->post('project_id');
            $classification = $this->input->post('classification_type');
            $name = $this->input->post('name');
            $status = $this->input->post('status');
            $quota = $this->input->post('quota');
            $budget = $this->input->post('budget');
           $employee='';
            $employee_array = $this->input->post('employee');
            if(isset($employee_array)){
                $employee = implode(',', $employee_array);
            }
            $startdate = $this->input->post('sdate');
            $sdate = datefordatabase($startdate);
            $setdate = $this->input->post('setupdate');
            $setupdate = datefordatabase($setdate);
            $setuptime = $this->input->post('setuptime');
            $note = $this->input->post('note');
            $hourly_rate = $this->input->post('hourly_rate');
            $tl_commission = $this->input->post('tl_commission');
            $default_warehouse = $this->input->post('default_warehouse');
            $shipping_option = $this->input->post('shiptype');
            $tag = $this->input->post('tags');
            $location = $this->input->post('location');//add by sagar

           
            if ($this->projects->editproject($pid, $classification, $name, $status, $quota, $budget, $employee, $sdate, $setupdate, $setuptime, $note, $hourly_rate, $tag, $tl_commission, $default_warehouse, $shipping_option,$location)) {
                echo json_encode(array('status' => 'Success', 'message' => '[Project] ' . $this->lang->line('UPDATED')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $id = $this->input->get('id');
            $this->load->model('Categories_model', 'warehouse');
            $data['warehouse'] = $this->warehouse->warehouselistwithouttl();
            $this->load->model('employee_model', 'employee');
            $data['project'] = $this->projects->details($id);
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['emp'] = $this->employee->list_employee();
            $data['emp2'] = $this->projects->list_store_employee($id);
            $data['locations'] = $this->getLocationsAPI();
            $head['title'] = 'Edit Project';
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/editproject', $data);
            $this->load->view('fixed/footer');
        }
    }
    //     //tasks section
    public function addtask()
    {
        $id = $this->input->get('id');
        $data['project'] = $this->projects->details($id);
        $this->load->model('employee_model', 'employee');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Task';
        $data['prid'] = $this->input->get('id');
        $data['milestones'] = $this->projects->milestones($data['prid']);
        $data['emp'] = $this->employee->list_project_employee($data['prid']);
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/addtask', $data);
        $this->load->view('fixed/footer');
    }
    public function addmilestone()
    {
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $stdate = $this->input->post('staskdate');
            $tdate = $this->input->post('taskdate');
            $content = $this->input->post('content');
            $color = $this->input->post('color');
            $prid = $this->input->post('project');
            $stdate = datefordatabase($stdate);
            $tdate = datefordatabase($tdate);
            if ($this->projects->add_milestone($name, $stdate, $tdate, $content, $color, $prid)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp; Return to show <a href="' . base_url("projects/explore?id=" . $prid) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $this->load->model('employee_model', 'employee');
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['emp'] = $this->employee->list_employee();
            $head['title'] = 'Add milestone';
            $data['prid'] = $this->input->get('id');
            $id = $this->input->get('id');
            $data['project'] = $this->projects->details($id);
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/addmilestone', $data);
            $this->load->view('fixed/footer');
        }
    }
    public function addactivity()
    {
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $prid = $this->input->post('project');
            if ($this->projects->add_activity($name, $prid)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp; Return to project <a href="' . base_url("projects/explore?id=" . $prid) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $this->load->model('employee_model', 'employee');
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['emp'] = $this->employee->list_employee();
            $head['title'] = 'Add activity';
            $data['prid'] = $this->input->get('id');
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/addactivity', $data);
            $this->load->view('fixed/footer');
        }
    }
    public function edittask()
    {
        if ($this->input->post()) {
            $id = $this->input->post('project');
            $name = $this->input->post('name');
            $status = $this->input->post('status');
            $priority = $this->input->post('priority');
            $milestone = $this->input->post('milestone');
            $stdate = $this->input->post('staskdate');
            $tdate = $this->input->post('taskdate');
            $employee = $this->input->post('employee');
            $content = $this->input->post('content');
            $stdate = datefordatabase($stdate);
            $tdate = datefordatabase($tdate);
            if ($this->shows->edittask($id, $name, $status, $priority, $milestone, $stdate, $tdate, $employee, $content)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $this->load->model('employee_model', 'employee');
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Edit Task';
            $id = $this->input->get('id');
            $data['task'] = $this->shows->viewtask($id);
            $data['emp'] = $this->employee->getAllTeamLeaderwithoutlogin($data['task']->sid);
            $data['sales'] = $this->shows->getSalesPersonByShowAssignedOnly($data['task']->sid);
            $data['milestones'] = $this->shows->milestones_list($data['task']->sid);
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/edittaskforshow', $data);
            $this->load->view('fixed/footer');
        }
    }
    public function save_addtask()
    {
        $name = $this->input->post('name');
        $status = $this->input->post('status');
        $priority = $this->input->post('priority');
        $stdate = $this->input->post('staskdate');
        $tdate = $this->input->post('taskdate');
        $employee = $this->input->post('employee');
        $content = $this->input->post('content');
        $prid = $this->input->post('project');
        $milestone = $this->input->post('milestone');
        $assign = $this->aauth->get_user()->id;
        $stdate = datefordatabase($stdate);
        $tdate = datefordatabase($tdate);

        if ($this->projects->addtask($name, $status, $priority, $stdate, $tdate, $employee, $assign, $content, $prid, $milestone)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('New Task Added') . '&nbsp; Return to project <a href="' . base_url("projects/explore?id=" . $prid) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    public function set_task()
    {
        $id = $this->input->post('tid');
        $stat = $this->input->post('stat');
        $this->tools->settask($id, $stat);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED'), 'pstatus' => 'Success'));
    }
    public function view_task()
    {
        $id = $this->input->post('tid');
        $task = $this->tools->viewtask($id);
        echo json_encode(array('name' => $task['name'], 'description' => $task['description'], 'employee' => $task['emp'], 'assign' => $task['assign'], 'priority' => $task['priority']));
    }
    public function projects_stats()
    {
        $project = $this->input->get('id');
        $this->projects->project_stats($project);
    }
    public function delete_i($id)
    { 
      
        if ($this->projects->deleteproject($id)) {

            
         echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        
        } else {
           
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    public function project_load_list()
    {
        $cday = $this->input->get('cday');
        $list = $this->projects->project_datatables($cday);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $project) {
            $no++;
            $name = '<a href="' . base_url() . 'projects/explore?id=' . $project->id . '">' . $project->name . '</a>';
            $classification = $project->classification;
            $status = $project->status;
            $sdate = $project->sdate;
            $satupdate = $project->setupdate;
            $row = array();
            $row[] = $no;
            $row[] = $name;
            $row[] = $classification;
            $row[] = '<span class="project_' . $project->status . '">' . $this->lang->line($project->status) . '</span>';
            $row[] = $sdate;
            $row[] = dateformat($project->satupdate);
            $row[] = $project->quota;
            $row[] = $project->budget;

            if ($this->aauth->get_user()->roleid == 3) {
                $row[] = '<a href="' . base_url() . 'projects/explore?id=' . $project->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $project->id . '" data-stat="0"> ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'projects/explore?id=' . $project->id . '" class="btn btn-success btn-sm rounded apply" data-id="' . $project->id . '" data-stat="0"> ' . $this->lang->line('Apply') . '</a>';
            } elseif ($this->aauth->get_user()->roleid == 5) {
                $row[] = '<a href="' . base_url() . 'projects/explore?id=' . $project->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $project->id . '" data-stat="0"> <i class="icon-eye"></i> </a> <a class="btn btn-info btn-sm" href="' . base_url() . 'projects/edit?id=' . $project->id . '" data-object-id="' . $project->id . '"> <i class="icon-pencil"></i> </a>&nbsp;<a class="btn-brown btn-sm delete-custom" data-did="3" href="#"  data-object-id="' . $project->id . '"> <i class="icon-trash-o"></i> </a>';
            }elseif ($this->aauth->get_user()->roleid == 2) {// change by sagar--1-1-2020 for salesperson
                $row[] =  '<a href="' . base_url() . 'projects/explore?id=' . $project->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $project->id . '" data-stat="0"> <i class="icon-eye"></i> </a>';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->projects->project_count_all($cday),
            "recordsFiltered" => $this->projects->project_count_filtered($cday),
            "data" => $data,
        );
        echo json_encode($output);
    }
    //all show list
    public function show_load_list()
    {
        $list = $this->shows->show_list();
        $data = array();
        $no = 0;
        foreach ($list as $show) {
            $no++;
            $name = $show->show_name;
            $row = array();
            $row[] = $show->show_id;
            $row[] = $name;
            $row[] = '<span class="project_' . $show->show_status . '">' . $this->lang->line($show->show_status) . '</span>';
            $row[] = dateformat($show->show_start_date);
            $row[] = dateformat($show->show_end_date);
            $row[] = $show->show_tag;
            $row[] = $show->show_quota;
            $row[] = $show->show_budget;
            if ($this->aauth->get_user()->roleid == 3) {
                if ($show->show_status != "Finished") {
                    $data1 = $this->shows->check_teamleader_request($show->id);
                    if ($data1 != null) {
                        foreach ($data1 as $f1) {
                            if ($f1['status'] == 0) {
                                $row[] = '<a href="' . base_url() . 'projects/exploreshow?id=' . $show->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $show->id . '" data-stat="0"> <i class="icon-eye"></i></a> <button  disabled="true" style="color:white" class="btn btn-success btn-sm rounded "  data-object-id="' . $show->id . '" > Applied </button>';
                            } elseif ($f1['status'] == 1) {
                                $row[] = '<a href="' . base_url() . 'projects/exploreshow?id=' . $show->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $show->id . '" data-stat="0"> <i class="icon-eye"></i></a> <button  disabled="true" style="color:white" class="btn btn-success btn-sm rounded "  data-object-id="' . $show->id . '" > Approved </button>';
                            } else {
                                $row[] = '<a href="' . base_url() . 'projects/exploreshow?id=' . $show->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $show->id . '" data-stat="0"> <i class="icon-eye"></i></a> <a class="btn btn-success btn-sm rounded delete-custom" data-did="1" data-object-id="' . $show->id . '" href="#"> ' . $this->lang->line('Apply') . '</a>';
                            }
                        }
                    } else {
                        $row[] = '<a href="' . base_url() . 'projects/exploreshow?id=' . $show->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $show->id . '" data-stat="0"> <i class="icon-eye"></i></a> <a class="btn btn-success btn-sm rounded delete-custom" data-did="1" data-object-id="' . $show->id . '" href="#"> ' . $this->lang->line('Apply') . '</a>';
                    }
                } else {
                    $row[] = '<a href="' . base_url() . 'projects/exploreshow?id=' . $show->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $show->id . '" data-stat="0"> <i class="icon-eye"></i></a>';
                }
            } elseif ($this->aauth->get_user()->roleid == 5) {
                $row[] = '<a href="' . base_url() . 'projects/exploreshow?id=' . $show->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $show->id . '" data-stat="0"> <i class="icon-eye"></i>  </a> <a class="btn btn-info btn-sm" href="' . base_url() . 'projects/editshow?id=' . $show->id . '" data-object-id="' . $show->id . '"> <i class="icon-pencil"></i> </a>&nbsp;<a class="btn btn-brown btn-sm delete-custom" data-did="15" href="#" data-object-id="' . $show->id . '"> <i class="icon-trash-o"></i> </a>';
            }elseif($this->aauth->get_user()->roleid == 2){
                $row[] = '<a href="' . base_url() . 'projects/exploreshow?id=' . $show->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $show->id . '" data-stat="0"> <i class="icon-eye"></i>  </a>';  
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data,
        );
        echo json_encode($output);
    }
    //Get last 10 show list before current date
    public function show_load_list1()
    {

        $list = $this->shows->show_list1();

        $data = array();

        foreach ($list as $show) {
            $row = array();
            $row[] = $show->id;
         
            $row[] = $show->show_name;
            $row[] = $show->show_status;
            $row[] = dateformat($show->show_start_date);
            $row[] = $show->show_id;
            $data[] = $row;
        }
        echo json_encode($data);
    }

    //Get last 10 show list after current date
    public function show_load_list2()
    {
        $list = $this->shows->show_list2();
        $data = array();

        foreach ($list as $show) {
            $row = array();
            $row[] = $show->id;
            $row[] = $show->show_name;
            $row[] = $show->show_status;
            $row[] = dateformat($show->show_start_date);
            $row[] = $show->show_id;//add by sagar
            $data[] = $row;
        }
        echo json_encode($data);
    }
    //Display List of all show which has
    public function req_show()
    {
        $show = $this->input->get('id');
        $list = $this->shows->req_show_list($show);
        $data = array();
        $no = 0;
        foreach ($list as $show) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $show['name'];
            $row[] = $show['requested_at'];
            if ($show['status'] != 0) {
                $row[] = '<a href="#"  class="btn btn-danger btn-sm rounded delete-team-leader" data-did="1" data-object-id="' . $show['reqid'] . '">Delete</a>';
            } else {
                $row[] = '<a href="#" class="btn btn-success btn-sm rounded delete-custom" data-did="11" data-object-id="' . $show['reqid'] . '">Accept</a> <a class="btn btn-danger btn-sm rounded delete-custom" href="#" data-did="12" data-object-id="' . $show['reqid'] . '">Reject</a>';
            }
            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function applyforshow()
    {
        $pid = $this->input->get('id');
        $teamleaderid = $this->aauth->get_user()->id;
        if ($this->projects->applyTeamLeader($teamleaderid, $pid)) {
            $this->session->set_userdata('favourite_website', $this->aauth->get_user()->roleid);

            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Shows List for Request';
            $data['totalt'] = $this->projects->project_count_all();
            $this->load->model('Projects_model', 'getUSerDetails');
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/shows', $data);
            $this->load->view('fixed/footer');
        }
    }
    public function pendingtasks()
    {
        $tasks = $this->projects->pending_tasks();
        $tlist = '';
        $tc = 0;
        foreach ($tasks as $row) {
            $tlist .= '<a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-bullhorn2 icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">' . $row['name'] . '</h6>
                          <p class="notification-text font-small-2 text-muted">Due date is ' . $row['duedate'] . '.</p><small>
                            Start <time  class="media-meta text-muted">' . $row['start'] . '</time></small>
                        </div>
                      </div></a>';
            $tc++;
        }
        echo json_encode(array('tasks' => $tlist, 'tcount' => $tc));
    }
    //Booth Store
    public function getboothlist()
    {
        $pid = $this->input->get('id');
        $list = $this->projects->getBoothbyid($pid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $booth) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $booth['size'];
            $row[] = $booth['cost'];
            $row[] = $booth['description'];
            $row[] = $booth['product_name'];
            $row[] = $booth['teamleader_id'];
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data,
        );
        echo json_encode($output);
    }
    //Booth Show
    public function getboothlistshow()
    {
        $pid = $this->input->get('id');
        $list = $this->shows->getBoothbyid($pid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $booth) {
            $teamleader = array();
            if ($booth['teamleader_id'] !== '' && $booth['teamleader_id'] !== 'null') {
                $teamleader = explode(',', $booth['teamleader_id']);
            }
            $tl = "";
            if (!empty($teamleader)) {
                foreach ($teamleader as $t) {
                    $this->db->select('employee_profile.name');
                    $this->db->from('employee_profile');
                    $this->db->where('id=' . $t);
                    $q1 = $this->db->get();
                    $req = $q1->row();
                    $tl .= $req->name . " ";
                }
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $booth['size'];
            $row[] = $booth['cost'];
            $row[] = $booth['description'];
            $row[] = $booth['title'];
            $row[] = $tl;
            if ($this->aauth->get_user()->roleid == 5) {
                $row[] = '<a class="btn btn-info btn-sm" href="' . base_url() . 'projects/editbooth?id=' . $booth['boothid'] . '" data-object-id="' . $booth['boothid'] . '"> <i class="icon-pencil"></i> </a>&nbsp;<a class="btn btn-brown btn-sm delete-custom" data-object-id="' . $booth['boothid'] . '" data-did="6"> <i class="icon-trash-o"></i> </a>';
            }else if($this->aauth->get_user()->roleid == 2){
                $row[] ="-";
            } else {
                $row[] = '<a class="btn btn-info btn-sm" href="' . base_url() . 'projects/editbooth?id=' . $booth['boothid'] . '" data-object-id="' . $booth['boothid'] . '"> <i class="icon-pencil"></i> </a>';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data,
        );
        echo json_encode($output);
    }
    //tasks
    public function todo_load_list()
    {
        $pid = $this->input->post('pid');
        $list = $this->projects->task_datatables($pid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $task) {
            $no++;
            $name = '<a class="check text-default" data-id="' . $task->id . '" data-stat="Due"> <i class="icon-check"></i> </a><a href="#" data-id="' . $task->id . '" class="view_task">' . $task->name . '</a>';
            if ($task->status == 'Done') {
                $name = '<a class="check text-success" data-id="' . $task->id . '" data-stat="Done"> <i class="icon-check"></i> </a><a href="#" data-id="' . $task->id . '" class="view_task">' . $task->name . '</a>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<a href="#" class="btn btn-primary btn-sm rounded set-task" data-id="' . $task->id . '" data-stat="0"> SET </a>' . $name;
            $row[] = dateformat($task->duedate);
            $row[] = dateformat($task->start);
            $row[] = '<span class="task_' . $task->status . '">' . $this->lang->line($task->status) . '</span>';
            $row[] = '<a class="btn-info btn-sm" href="' . base_url('projects') . '/edittask?id=' . $task->id . '" data-object-id="' . $task->id . '"> <i class="icon-pencil"></i> </a>&nbsp;<a class="btn-brown btn-sm delete-custom" data-did="3" href="#"  data-object-id="' . $task->id . '"> <i class="icon-trash-o"></i> </a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->projects->task_count_all($pid),
            "recordsFiltered" => $this->projects->task_count_filtered($pid),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function showtodo_load_list()
    {
        $id = $this->input->get('id');

        $list = $this->shows->task_datatables($id);



        $tlckeck = $this->shows->checkTLApprovedorNot($id);


        $data = array();

        $i = 0;
        foreach ($list as $todo) {
            $i++;

            if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) {

                $name = '<a class="check text-default" data-id="' . $todo->id . '" data-stat="Due"> <i class="icon-check"></i> </a><a href="#" data-id="' . $todo->id . '" class="view_task">' . $todo->showtaskname . '</a>';
                if ($todo->showtaskstart == 'Done') {
                    $name = '<a class="check text-success" data-id="' . $todo->id . '" data-stat="Done"> <i class="icon-check"></i> </a><a href="#" data-id="' . $todo->id . '" class="view_task">' . $todo->showtaskname . '</a>';
                }
            } else {
                $name = '<a href="#" data-id="' . $todo->id . '" class="view_task">' . $todo->showtaskname . '</a>';
            }


            $row = array();

            $row[] = $i;
            if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) {
                $row[] = '<a href="#" class="btn btn-primary btn-sm rounded set-task" data-id="' . $todo->id . '" data-stat="0"> SET </a>' . $name;
            } else {
                $row[] = $name;
            }
            $row[] = $todo->showtaskdue;
            $row[] = $todo->showtaskstart;
            $row[] = "<span  class='task_" . $todo->showtaskstatus . "'>" . $todo->showtaskstatus . "</span>";

            if (($this->aauth->get_user()->roleid == 3 and !empty($tlckeck)) or ($this->aauth->get_user()->roleid == 5)) {

                $row[] = '<a class="btn-info btn-sm" href="' . base_url('projects') . '/edittask?id=' . $todo->id . '" data-object-id="' . $todo->id . '"> <i class="icon-pencil"></i> </a>&nbsp;<a class="btn-brown btn-sm delete-custom" data-did="3" href="#"  data-object-id="' . $todo->id . '"> <i class="icon-trash-o"></i> </a>';
            } else {
                $row[] = 'Not Allow';
            }


            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function file_handling()
    {
        $id = $this->input->get('id');
        $this->load->library("Uploadhandler_generic", array(
            'accept_file_types' => '/\.(gif|jpe?g|png|docx|docs|txt|pdf|xls)$/i', 'upload_dir' => FCPATH . 'userfiles/project/', 'upload_url' => base_url() . 'userfiles/project/'
        ));
        $files = (string) $this->uploadhandler_generic->filenaam();
        if ($files != '') {
            $fid = rand(100, 9999);
            $this->projects->meta_insert($id, 9, $fid, $files);
        }
    }
    public function file_show_handling()
    {
        $id = $this->input->get('id');
        $this->load->library("Uploadhandler_generic", array(
            'accept_file_types' => '/\.(gif|jpe?g|png|docx|docs|txt|pdf|xls)$/i', 'upload_dir' => FCPATH . 'userfiles/project/', 'upload_url' => base_url() . 'userfiles/project/'
        ));
        $files = (string) $this->uploadhandler_generic->filenaam();
        if ($files != '') {
            $fid = rand(100, 9999);
            $this->shows->meta_insert($id, 9, $fid, $files);
        }
    }
    public function set_note()
    {
        $id = $this->input->post('nid');
        $stat = $this->input->post('content');
        $this->projects->setnote($id, $stat);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED'), 'pstatus' => 'Success'));
    }
    // Add Notes for Shows.
    public function set_note_show()
    {
        $id = $this->input->post('nid');
        $stat = $this->input->post('content');
        $this->shows->setnote($id, $stat);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED'), 'pstatus' => 'Success'));
    }
    public function delete_file()
    {
        $fileid = $this->input->post('object_id');
        $pid = $this->input->post('project_id');
        $this->projects->deletefile($pid, $fileid);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
    }
    public function delete_file_show()
    {
        $fileid = $this->input->post('object_id');
        $pid = $this->input->post('project_id');
        $this->shows->deletefile($pid, $fileid);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
    }
    public function delete_milestone()
    {
        $mid = $this->input->post('object_id');
        $this->projects->deletemilestone($mid);

        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
    }
    //delete milestone for show
    public function delete_milestone_show()
    {
        $mid = $this->input->post('object_id');
        $this->shows->deletemilestone($mid);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
    }
    //comm section
    public function addcomment()
    {
        $comment = $this->input->post('content');
        $pid = $this->input->post('nid');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Comment';
        if ($this->projects->add_comment($comment, $pid, $this->aauth->get_user()->id)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    //Add Comment for Show
    public function addcommentshow()
    {
        $comment = $this->input->post('content');
        $pid = $this->input->post('nid');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Comment';
        if ($this->shows->add_comment($comment, $pid, $this->aauth->get_user()->id)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    public function progress()
    {
        $pid = $this->input->post('pid');
        $val = $this->input->post('val');
        $this->projects->progress($pid, $val);
    }
    public function task_stats()
    {
        $id = $this->input->get('id');
        $this->projects->task_stats(intval($id));
    }

    //Set Break Time for Show side.
    public function setbreaktime()
    {
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Set Break Time';
        $data['totalt'] = $this->projects->project_count_all();
        $data['emp'] = $this->shows->getSalesPersonByShowAssignedOnly($id);

        $explore = $this->shows->explore($id);
        $data['project'] = $explore['project'];
        $data['date'] = $this->shows->getShowDate($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/setbreacktime', $data);
        $this->load->view('fixed/footer');
    }
    //Add Booth for Store page
    public function addbooth()
    {
        $id = $this->input->get('id');
        $this->load->model('employee_model', 'employee');

        $data['emp'] = $this->employee->getAllTeamLeader();
        $data['products'] = $this->products->products_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Booth';
        $data['project'] = $this->projects->details($id);
        $data['totalt'] = $this->projects->project_count_all();
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/BoothAdd', $data);
        $this->load->view('fixed/footer');
    }
    public function approveteamleader()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Approve Team Leader';
        $data['totalt'] = $this->projects->project_count_all();
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/approveprojectleader', $data);
        $this->load->view('fixed/footer');
    }
    public function showproject()
    {
        if ($this->aauth->get_user()->roleid !=  5) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        if ($this->input->post()) {

            $store_id = $this->input->post('show_id');
            $name = $this->input->post('name');
            $status = $this->input->post('status');
            $atendance = $this->input->post('attendance');
            $budget = $this->input->post('budget');
            $quota = $this->input->post('quota');
            $employee_array = $this->input->post('employee');
            $employee = implode(',', $employee_array);
            $location = $this->input->post('location');
            $startdate = $this->input->post('sdate');
            $sdate = datefordatabase($startdate);
            $setdate = $this->input->post('setupdate');
            $setupdate = datefordatabase($setdate);
            $enddate = $this->input->post('edate');
            $eddate = datefordatabase($enddate);
            $setuptime = $this->input->post('setuptime');
            $hourlyrate = $this->input->post('hourly_wage');
            $tlcomission = $this->input->post('tl_commission'); //
            $default_warehouse = $this->input->post('warehouse'); //
            $shipping_option = $this->input->post('shiptype');
            $note = $this->input->post('note'); //
            $tag = $this->input->post('tags');
            $shipping_carrier = $this->input->post('shipping_carrier');
            $task_communication = $this->input->post('task_communication');
            if ($this->shows->addshow($store_id, $name, $status, $atendance, $budget, $quota, $employee, $sdate, $setupdate, $eddate, $setuptime, $note, $hourlyrate, $tlcomission, $default_warehouse, $shipping_option, $tag, $task_communication, $location, $shipping_carrier)) {
                echo json_encode(array('status' => 'Success', 'message' => '[Show] ' . $this->lang->line('ADDED')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $this->load->model('employee_model', 'employee');
            $this->load->model('Categories_model', 'warehouse');
            $data['warehouse'] = $this->warehouse->warehouselistwithouttl();
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['emp'] = $this->shows->getSalesperson();
            $data['locations'] = $this->getLocationsAPI();
            $head['title'] = 'Add Project';
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/showproject', $data);
            $this->load->view('fixed/footer');
        }
    }
    public function addactivityforshow()
    {
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $prid = $this->input->post('pr_id');
            if ($this->shows->add_activity($name, $prid)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp; Return to show <a href="' . base_url("projects/exploreshow?id=" . $prid) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $this->load->model('employee_model', 'employee');
            $id = $this->input->get('id');
            $data['project'] = $this->shows->details($id);
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['emp'] = $this->shows->getSalesperson();
            $head['title'] = 'Add activity';
            $data['prid'] = $this->input->get('id');
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/addActivityforshow', $data);
            $this->load->view('fixed/footer');
        }
    }
    public function addtaskforshow()
    {
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $status = $this->input->post('status');
            $priority = $this->input->post('priority');
            $stdate = $this->input->post('staskdate');
            $tdate = $this->input->post('taskdate');
            $employee = $this->input->post('employee');
            $content = $this->input->post('content');
            $prid = $this->input->post('project');
            $milestone = $this->input->post('milestone');
            $assign = $this->aauth->get_user()->id;
            $stdate = datefordatabase($stdate);
            $tdate = datefordatabase($tdate);

            if ($this->shows->addtask($name, $status, $priority, $stdate, $tdate, $employee, $assign, $content, $prid, $milestone)) {
                $ret = $this->shows->getTokens($employee);

                $this->sendNotification($ret, 'Task Assigned to you', 'Task assigned to you. Please click to view it');
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('New Task Added') . '&nbsp; Return to show <a href="' . base_url("projects/exploreshow?id=" . $prid) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $id = $this->input->get('id');
            $data['project'] = $this->shows->details($id);
            $this->load->model('employee_model', 'employee');
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Add Task';
            $data['prid'] = $this->input->get('id');
            $data['milestones'] = $this->shows->milestones_list($data['prid']);
            $data['emp'] = $this->employee->getAllTeamLeaderwithoutlogin($id);
            $data['sales'] = $this->shows->getSalesPersonByShowAssignedOnly($data['prid']);

            $this->load->view('fixed/header', $head);
            $this->load->view('projects/addtaskforshow', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function addlocationforshow()
    {
        $show_id = $this->input->post('nid');
        $user_id  = $this->aauth->get_user()->id;
        $contact_person = $this->input->post('contact_person');
        $contact_number = $this->input->post('contact_number');
        $extension = $this->input->post('extension');
        $indoor_outdoor = $this->input->post('indoor_outdoor');
        $address = $this->input->post('address');
        $required = $this->input->post('required');
        $electricity = $this->input->post('electricity');
        $website = $this->input->post('website');
        $location = $this->input->post('file_attachother');
        $contact_email = $this->input->post('contact_email');
        $data = array(

            'show_id' => $show_id,

            'user_id' => $user_id,

            'contact_person' => $contact_person,

            'contact_number' => $contact_number,

            'extension ' => $extension,

            'type' => $indoor_outdoor,

            'address' => $address,

            'location' => $location,

            'flooring' => $required,

            'electricity' => $electricity,

            'website' => $website,

            'contact_email'=>$contact_email

        );

        $cnt = $this->shows->location_show_count($show_id);

        if ($cnt == 0) {
            if ($this->shows->data_insert($data)) {
                // echo json_encode(array('status' => 'Success', 'message' => '[Show] ' . $this->lang->line('ADDED')));
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp; Return to show <a href="' . base_url("projects/exploreshow?id=" . $show_id) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            if ($this->shows->data_update($data, $show_id)) {
                // echo json_encode(array('status' => 'Success', 'message' => '[Show] ' . $this->lang->line('ADDED')));
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp; Return to show <a href="' . base_url("projects/exploreshow?id=" . $show_id) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        }
    }
    public function setbreacktimeforsotre()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Set Break Time';
        $data['totalt'] = $this->projects->project_count_all();
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/setbreacktimeforsotre', $data);
        $this->load->view('fixed/footer');
    }
    public function addshowbooth()
    {
        $id = $this->input->get('id');
        $this->load->model('employee_model', 'employee');
        $data['emp'] = $this->employee->getAllTeamLeaderwithoutlogin($id);
        $data['sales'] = $this->shows->getSalesPersonByShowAssignedOnly($id);

        $data['products'] = $this->shows->get_product_cat();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Booth';
        $data['project'] = $this->shows->details($id);
        $data['totalt'] = $this->projects->project_count_all();
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/BoothAddShow', $data);
        $this->load->view('fixed/footer');
    }
    public function approveteamleaderforstore()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Approve Team Leader';
        $data['totalt'] = $this->projects->project_count_all();
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/approveteamleaderforstore', $data);
        $this->load->view('fixed/footer');
    }
    //Add Milestones for shows.
    public function addmilestoneforshow()
    {
        if ($this->input->post()) {

            $start_milestone_date = $this->input->post('start_date');
            $end_milestone_date = $this->input->post('end_date');

            $name = $this->input->post('name');
            $stdate1 = $this->input->post('staskdate');
            $tdate1 = $this->input->post('taskdate');
            $content = $this->input->post('content');
            $color = $this->input->post('color');
            $id = $this->input->get('id');
            $data['project'] = $this->shows->details($id);
            $prid = $this->input->post('project');
            $stdate = datefordatabase($stdate1);
            $tdate = datefordatabase($tdate1);
            $getsDate = explode("/", $stdate1);
            $geteDate1 = explode("/", $tdate1);
            $sdat = $getsDate[2] . '-' . $getsDate[0] . '-' . $getsDate[1];
            $edat = $geteDate1[2] . '-' . $geteDate1[0] . '-' . $geteDate1[1];
            $poststartdate1 = DateTime::createFromFormat('Y-m-d', $sdat);

            $postenddate1 = DateTime::createFromFormat('Y-m-d', $edat);
            $check = 0;
            for ($i = 0; $i < count($start_milestone_date); $i++) {
                $sdat1 = DateTime::createFromFormat('Y-m-d', $start_milestone_date[$i]);
                $edat1 = DateTime::createFromFormat('Y-m-d', $end_milestone_date[$i]);
                if ($sdat1->getTimestamp() == $poststartdate1->getTimestamp() ||  $sdat1->getTimestamp() == $postenddate1->getTimestamp()) {
                    $check++;
                }
                if (($sdat1->getTimestamp() > $poststartdate1->getTimestamp()) and ($edat1->getTimestamp() < $poststartdate1->getTimestamp())) {
                    $check++;
                }
                if (($sdat1->getTimestamp() >= $postenddate1->getTimestamp()) and ($edat1->getTimestamp() <= $postenddate1->getTimestamp())) {
                    $check++;
                }
            }
            if ($check == 0) {
                if ($this->shows->add_milestone($name, $stdate, $tdate, $content, $color, $prid)) {
                    echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp; Return to project <a href="' . base_url("projects/exploreshow?id=" . $prid) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
                } else {
                    echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
                }
            } else {
                echo json_encode(array('status' => 'Warning', 'message' => ' This date is already used in another milestone. Please Select Differnt Date.'));
            }
        } else {
            $this->load->model('employee_model', 'employee');
            $id = $this->input->get('id');
            $data['project'] = $this->shows->details($id);
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['emp'] = $this->employee->list_employee();
            $head['title'] = 'Add milestone';
            $data['prid'] = $this->input->get('id');
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/addmilestoneforshow', $data);
            $this->load->view('fixed/footer');
        }
    }
    //Display Store Lists
    public function stores()
    {
        $this->session->set_userdata('favourite_website', $this->aauth->get_user()->roleid);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Project List';
        $data['totalt'] = $this->projects->project_count_all();
        $this->load->model('Projects_model', 'getUSerDetails');
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/stores', $data);
        $this->load->view('fixed/footer');
    }
    //Display Show Lists
    public function shows()
    {
       
        $this->session->set_userdata('favourite_website', $this->aauth->get_user()->roleid);

      
            // if($this->aauth->get_user()->roleid ==2){
            //     // $id=$this->input->get('id');
            //     // if( !=)
            //     // {
            //     //       exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
            //     // }
            //     $id= $this->session->userdata('salesperson_show_id');
              
            //     $data['items'] = $this->products->getItemList();
            //     $data['getProductBynotColor']=$this->shows->getProductBynotColorsl($id);
        
            //     $data['getProductByColor']=$this->shows->getProductByColorsl($id);
        
            //     $data['teamleader'] = $this->shows->teamleaderlistforproductrequestsl($id);
        
            //     $data['project'] = $this->shows->details($id);
        
            //     $head['usernm'] = $this->aauth->get_user()->username;
        
            //     $head['title'] = 'Sales Person Dashboard';
        
            //     $this->load->view('fixed/header', $head);
        
            //     $this->load->view('SalesPerson/explore',$data);
        
            //     $this->load->view('fixed/footer');
            // }else{

            
        

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Shows List';
        // $data['totalt'] = $this->projects->project_count_all();
        $data['totalt'] = $this->projects->count_all('shows', '');
        $data['waiting'] = $this->projects->count_all('shows', 'Waiting');
        $data['progress'] = $this->projects->count_all('shows', 'Progress');
        $data['finished'] = $this->projects->count_all('shows', 'Finished');
        $data['pending'] = $this->projects->count_all('shows', 'Pending');
        $this->load->model('Projects_model', 'getUSerDetails');
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/shows', $data);
        $this->load->view('fixed/footer');
   // }
    
    }
    // public function showsdemo()
    // {
    // $data = $this->projects->count_all('shows','');
    // echo 'Total:'.$data;
    // $data = $this->projects->count_all('shows','Waiting');
    // echo 'Waiting:'.$data;
    // $data = $this->projects->count_all('shows','Finished');
    // echo 'Finished:'.$data;
    // $data = $this->projects->count_all('shows','Pending');
    // echo 'Pending:'.$data;
    // }

    //Edit Show Details
    public function editshow()
    {
        if ($this->input->post()) {
            $id = $this->input->post('show_main_id');
            $store_id = $this->input->post('show_id');
            $name = $this->input->post('name');
            $status = $this->input->post('status');
            $atendance = $this->input->post('attendance');
            $budget = $this->input->post('budget');
            $quota = $this->input->post('quota');
            $employee_array = $this->input->post('employee');
            $employee = implode(',', $employee_array);
            $startdate = $this->input->post('sdate');
            $sdate = datefordatabase($startdate);
            $setdate = $this->input->post('setupdate');
            $setupdate = datefordatabase($setdate);
            $enddate = $this->input->post('edate');
            $eddate = datefordatabase($enddate);
            $setuptime = $this->input->post('setuptime');
            $hourlyrate = $this->input->post('hourly_wage');
            $tlcomission = $this->input->post('tl_commission');
            $default_warehouse = $this->input->post('warehouse');
            $shipping_option = $this->input->post('shiptype');
            $note = $this->input->post('note');
            $tag = $this->input->post('tags');
            $location = $this->input->post('location');
            $task_communication = $this->input->post('task_communication');
            $shipping_carrier = $this->input->post('shipping_carrier');


          
            if ( $data=$this->shows->editshow($id, $store_id, $name, $status, $atendance, $budget, $quota, $employee, $sdate, $setupdate, $eddate, $setuptime, $note, $hourlyrate, $tlcomission, $default_warehouse, $shipping_option, $tag, $task_communication, $location, $shipping_carrier)) {
                
                //echo json_encode($data);
              
                 echo json_encode(array('status' => 'Success', 'message' => '[Show] ' . $this->lang->line('UPDATED') . '&nbsp; Return to Show <a href="' . base_url("projects/exploreshow?id=" . $id) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $id = $this->input->get('id');
            $this->load->model('Categories_model', 'warehouse');
            $data['warehouse'] = $this->warehouse->warehouselistwithouttl();
            $this->load->model('employee_model', 'employee');
            $data['project'] = $this->shows->details($id);
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['emp'] = $this->shows->getSalesperson();
            $data['locations'] = $this->getLocationsAPI($data['project']['location_id']);
            $data['show_emp'] = $this->shows->getshowsalespersononly($id);

            $head['title'] = 'Edit Show';
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/editshow', $data);
            $this->load->view('fixed/footer');
        }
    }
    //Display Show expore page
    // public function exploreshow()
    // {

    //     $id = $this->input->get('id');
    //     $data['getProductBynotColor']=$this->shows->getProductBynotColor($id);
    //     $data['getProductByColor']=$this->shows->getProductByColor($id);
    //     $data['getProductByQuickPick']=$this->shows->getQuickPickproduct($id);
    //     $data['getProductBynotColor1']=$this->shows->getProductBynotColorbytl($id);
    //     $data['getProductByColor1']=$this->shows->getProductByColorbytl($id);
    //     $data['getStckTransferDetailsforColor']=$this->shows->getcolorproductstock($id);
    //     $data['getStckTransferDetailsforNotColor']=$this->shows->getnotcolorproductstock($id);
    //     $head['usernm'] = $this->aauth->get_user()->username;
    //     $head['title'] = 'Show Overview';
    //     $this->load->model('employee_model', 'employee');
    //     $explore = $this->shows->explore($id);
    //     $data['thread_list'] =$this->shows->task_thread($id);
    //     $data['milestones'] = $this->shows->milestones_list_all($id);
    //     $data['activities'] = $this->shows->activities($id);
    //     $data['p_files'] = $this->shows->p_files($id);
    //     $data['comments_list'] = $this->shows->comments_thread($id);
    //     $data['due_task'] = $this->shows->getDuelist($id);
    //     $data['done_task'] = $this->shows->getDonelist($id);
    //     $data['total_task']=$this->shows->gettotalTask($id);
    //     $data['progress_task'] = $this->shows->getProgresslist($id);
    //     $data['emp'] = $this->shows->getSalesPersonByShowAssignedOnly($id);
    //     $data['loggedinusername']=$this->shows->getloginusername($this->aauth->get_user()->id);
    //   $data['loggedin_user_ac_id']=$this->shows->loggedin_user_ac_detail();
    //     $data['getsalespersonfrombreaktime']=$this->shows->getsalespersonfrombreaktime($id);
    //     $data['teamleaderforstocktransfer']=$this->employee->getAllTeamLeaderwithoutlogin($id);

    //     $data['teamleader_warehouse_product']=$this->shows->teamleader_product_details($id);
    //     $data['project'] = $explore['project'];
    //     $data['invoices'] = "";
    //     $data['tlckeck']=$this->shows->checkTLApprovedorNot($id);


    //     $this->load->view('fixed/header', $head);
    //     $this->load->view('projects/exploreshow', $data);
    //     $this->load->view('fixed/footer');
    // }


    public function exploreshow()
    {


        if ($this->aauth->get_user()->roleid == 2) {

            $id=$this->input->get('id');
            if($this->session->userdata('salesperson_show_id') != $id)
            {
                  exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
            }
           
          
            $data['items'] = $this->products->getItemList();
            $data['getProductBynotColor']=$this->shows->getProductBynotColorsl($id);
    
            $data['getProductByColor']=$this->shows->getProductByColorsl($id);
    
            $data['teamleader'] = $this->shows->teamleaderlistforproductrequestsl($id);
    
            $data['project'] = $this->shows->details($id);

            $data['location_details'] = $this->shows->getLocationDetails($id);
    
            $head['usernm'] = $this->aauth->get_user()->username;
    
            $head['title'] = 'Sales Person Dashboard';
    
            $this->load->view('fixed/header', $head);
    
            $this->load->view('SalesPerson/explore',$data);
    
            $this->load->view('fixed/footer');
            //exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }else{


        $id = $this->input->get('id');
        $data['items'] = $this->products->getItemList();
        $data['getProductBynotColor'] = $this->shows->getProductBynotColor($id);
        $data['getProductByColor'] = $this->shows->getProductByColor($id);
        $data['getProductByQuickPick'] = $this->shows->getQuickPickproduct($id);
        $data['getProductBynotColor1'] = $this->shows->getProductBynotColorbytl($id);
        $data['getProductByColor1'] = $this->shows->getProductByColorbytl($id);
        $data['getStckTransferDetailsforColor'] = $this->shows->getcolorproductstock($id);
        $data['getStckTransferDetailsforNotColor'] = $this->shows->getnotcolorproductstock($id);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Show Overview';
        $this->load->model('employee_model', 'employee');
        $explore = $this->shows->explore($id);
        $data['thread_list'] = $this->shows->task_thread($id);
        $data['milestones'] = $this->shows->milestones_list_all($id);
        $data['activities'] = $this->shows->activities($id);
        $data['p_files'] = $this->shows->p_files($id);
        $data['comments_list'] = $this->shows->comments_thread($id);
        $data['due_task'] = $this->shows->getDuelist($id);
        $data['done_task'] = $this->shows->getDonelist($id);
        $data['total_task'] = $this->shows->gettotalTask($id);
        $data['progress_task'] = $this->shows->getProgresslist($id);
        $data['location_details'] = $this->shows->getLocationDetails($id);
        $data['emp'] = $this->shows->getSalesPersonByShowAssignedOnly($id);
       

        $data['getsalespersonfrombreaktime'] = $this->shows->getsalespersonfrombreaktime($id);
        $data['teamleaderforstocktransfer'] = $this->employee->getAllTeamLeaderwithoutlogin($id);

        $data['loggedinusername'] = $this->shows->getloginusername($this->aauth->get_user()->id);
        $data['loggedin_user_ac_id'] = $this->shows->loggedin_user_ac_detail();
        $data['getsalespersonfrombreaktime'] = $this->shows->getsalespersonfrombreaktime($id);
        $data['teamleaderforstocktransfer'] = $this->employee->getAllTeamLeaderwithoutlogin($id);


        // $data['teamleader_warehouse_product']=$this->shows->teamleader_product_details($id);
        $data['project'] = $explore['project'];
        $data['invoices'] =$this->invoice->getOrderDetails($id);
        $data['tlckeck'] = $this->shows->checkTLApprovedorNot($id);
        $data['boothinfo'] = $this->shows->getBoothDetails($id);
       // $data['getteamleaderinfo'] = $this->shows->getteamleadeinfo($id);

       // print_r ($data['booth']);
       // print_r ($data);
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/exploreshow', $data);
        $this->load->view('fixed/footer');
        }
    }

    //get stocktransfer recieve data
    public function getstocktransferrecieveddata()
    {
        $data = $this->input->post();
        $show_id = $data['project'];
        $teamleader_id = $data['tl'];
        if ($teamleader_id == '') {
            echo json_encode(array('status' => 'Warning', 'message' => 'Please Select Team leader '));
        } else {
            $data['confirmtransferstock'] = $this->shows->confirmtransferstock($show_id, $teamleader_id);
            $data['status'] = 1;
            $s['status'] = 1;
            $s['div_value'] = $this->load->view('projects/stocktransferrecieved', $data, true);
            echo json_encode($s);
            die;
        }
    }
    //Save Booth for Store
    public function savebooth()
    {
        $prid = $this->input->post('id');
        $size = $this->input->post('size');
        $cost = $this->input->post('cost');  //remove Cost 
    //    $cost =0;
        $description = $this->input->post('description');
        $product = $this->input->post('product');
        $employee_array = $this->input->post('teamleader');
        $teamleader = implode(',', $employee_array);
        if ($this->projects->addbooth($prid, $size, $cost, $description, $product, $teamleader)) {
            echo json_encode(array('status' => 'Success', 'message' => '[Booth] ' . $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    //Save Booth for Show
    public function saveshowbooth()
    {
        $prid = $this->input->post('id');
        $size = $this->input->post('size');
        // $cost = $this->input->post('cost');
        $cost = 0;
        $description = $this->input->post('description');
        $product = $this->input->post('product');
        $employee_array = $this->input->post('teamleader');
        $teamleader = implode(',', $employee_array);
        if ($this->shows->addbooth($prid, $size, $cost, $description, $product, $teamleader)) {
            echo json_encode(array('status' => 'Success', 'message' => '[Booth] ' . $this->lang->line('ADDED') . '&nbsp; Return to project <a href="' . base_url("projects/exploreshow?id=" . $prid) . '" class="btn btn-primary btn-xs"><i class="icon-eye"></i> ' . $this->lang->line('Yes') . '</a>'));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    //display Packing List Request history
    public function productrequesthistory()
    {
        $this->session->set_userdata('favourite_website', $this->aauth->get_user()->roleid);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Product Request History';
        $data['totalt'] = $this->projects->project_count_all();
        $this->load->model('Projects_model', 'getUSerDetails');
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/packingListRequest', $data);
        $this->load->view('fixed/footer');
    }
    //edit booth
    public function editbooth()
    {
        $boothid = $this->input->get('id');
        $this->load->model('employee_model', 'employee');
        $data['booth'] = $this->shows->getBoothDetailsById($boothid);
        $data['emp'] = $this->employee->getAllTeamLeaderwithoutlogin($data['booth']['prid']);
        $data['sales'] = $this->shows->getSalesPersonByShowAssignedOnly($data['booth']['prid']);

        $data['boothteamleader'] = $this->employee->boothteamleader($boothid);

        $data['products'] = $this->shows->get_product_cat();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Edit Booth';

        $this->load->view('fixed/header', $head);
        $this->load->view('projects/editBooth', $data);
        $this->load->view('fixed/footer');
    }
    //edit booth post request
    public function editshowbooth()
    {
        $boothid = $this->input->post('id');
        $size = $this->input->post('size');
       // $cost = $this->input->post('cost');---remove cost
       $cost=0;
        $description = $this->input->post('description');
        $product = $this->input->post('product');
        $employee_array = $this->input->post('teamleader');
        $teamleader = implode(',', $employee_array);
        if ($this->shows->editBooth($boothid, $size, $cost, $description, $product, $teamleader)) {
            echo json_encode(array('status' => 'Success', 'message' => '[Booth] ' . $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    //Delete Booth for show
    public function delete_booth()
    {
        $deleteid = $this->input->post();

        if ($this->shows->deletebooth($deleteid['delete_id'])) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    //Insert Team Leader Request
    public function add_request_for_show()
    {
        $mid = $this->input->post('object_id');
        $data = $this->shows->requesrtforstore($mid);
        //call send notification to business owner/s - arzoo
        //owners tokens
        $tokens = $this->shows->retriveOwnersToken();
        //msg - teamleader - name -(employee-profile) - Show (show)
        $msg = $this->shows->getMessageToOwner($mid);
        $this->sendNotification($tokens, "Apply for Show", $msg);

        echo json_encode(array('status' => 'Success', 'message' => 'Request Sent Successfully.'));
    }
    //Accept Request Status for show Request by team leader
    public function accept_request_show()
    {
        $mid = $this->input->post('object_id');
        $data = $this->shows->acceptstatusteamleader($mid);
        $tokens = $this->shows->retriveTeamLeaderTokenBasedOnShow($mid);
        $msg = $this->shows->getMessageShowRequestStatus($mid, "accepted");
        $this->sendNotification($tokens, "Accept for Show", $msg);

        echo json_encode(array('status' => 'Success', 'message' => 'Team Leader Accepted Successfully'));
    }
    //Reject Request of team leader for show
    public function reject_request()
    {
        $mid = $this->input->post('object_id');
        $data = $this->shows->rejectteamleader($mid);
        $tokens = $this->shows->retriveTeamLeaderTokenBasedOnShow($mid);
        $msg = $this->shows->getMessageShowRequestStatus($mid, "rejected");
        $this->sendNotification($tokens, "Rejected for Show", $msg);
        echo json_encode(array('status' => 'Success', 'message' => 'Team Leader Rejected Successfully'));
    }
    //Load Attendess Data
    public function attendees_list()
    {
        $id = $this->input->get('id');

        $list = $this->shows->getShowAssignPersons($id);
        $data1 = array();
        $no = 1;
        $i = 0;
        foreach ($list as $d) {
            foreach ($d as $d1) {
                $row = array();
                $row[] = $no++;
                $row[] = $d1['name'];
                if ($d1['roleid'] == 3) {
                    $row[] = 'Team Leader';
                } else if ($d1['roleid'] == 5) {
                    $row[] = 'Bussiness Owner';
                } else if ($d1['roleid'] == 2) {
                    $row[] = 'Salesperson';
                } else {
                    $row[] = 'Not Found';
                }
                $row[] = isset($d1['description'])?$d1['description']:'Unassigned';
                $row[] = isset($d1['title'])?$d1['title']:'Unassigned';
                $i++;
                $data1[] = $row;
            }
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data1,
        );
        echo json_encode($output);
    }
    //Product Packing List insert data for request by team leader
    public function check_status()
    {
        $data = $this->input->post('product[]');
        $data1 = $this->input->post('product_id[]');
        $dd = '';
        foreach ($data as $d) {
            $dd .= "Product Id :" . $d['id'] . " -- Product Requested Quantity : " . $d['requested_qty'];
        }
        echo json_encode(array('status' => 'Success', 'message' => $dd));
    }
    //Edit Milestones
    public function editmilestone()
    {
        $start_milestone_date = $this->input->post('start_date');
        $end_milestone_date = $this->input->post('end_date');
        $id = $this->input->get('id');
        $show_id = $this->input->get('sid');
        if ($this->input->post()) {
            $id = $this->input->post('mile_id');
            $title = $this->input->post('name');
            $color = $this->input->post('color');
            $sdate = $this->input->post('start_date');
            $start_date = datefordatabase($sdate);
            $edate = $this->input->post('end_date');
            $end_date = datefordatabase($edate);
            $des = $this->input->post('content');

            //--------------------------
            if ($this->shows->editmilestone($show_id, $id, $title, $color, $start_date, $end_date, $des)) {
                echo json_encode(array('status' => 'Success', 'message' => '[Milestone] Edited' . $this->lang->line('Edited')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $data['milestone'] = $this->shows->getmilestones($id);
            $data['project'] = $this->shows->explore($show_id);
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Edit Milestone';
            $this->load->view('fixed/header', $head);
            $this->load->view('projects/editmilestoneforshow', $data);
            $this->load->view('fixed/footer');
        }
    }
    //delete show
    public function delete_show()
    {
        $id = $this->input->post('deleteid');
        if ($this->shows->delete_show($id)) {
            echo json_encode(array('status' => 'Success', 'message' => 'Show Removed Successfully'));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    //Add BreakTime for show
    public function setBreakTimeShow()
    {

        $data = $this->input->post('all[]');

        foreach ($data as $d) {
            $sdate = $d['date'];
            $startworkingtime = $d['starttimes'];
            $endworkingtime = $d['endtimes'];
            $salesperson = $d['salesperson'];
            $show_id = $d['show_id'];
            $assign_by = $d['assign_by'];

            $date = datefordatabase($sdate);

            $lastid = $this->shows->setbreaktime($date, $startworkingtime, $endworkingtime, $salesperson, $show_id, $assign_by);
            $sbrk = array();
            $ebrk = array();
            foreach ($d['start_break_time'] as $sbreak) {
                $sbrk[] = $sbreak;
            }
            foreach ($d['end_break_time'] as $ebreak) {
                $ebrk[] = $ebreak;
            }
            for ($i = 0; $i < count($sbrk); $i++) {
                $this->shows->addbreaktime($lastid, $sbrk[$i], $ebrk[$i]);
            }
        }

        echo json_encode(array('status' => 'Success', 'message' => "Data Inserted Successfully."));
    }
    //----------------------add working time----------------------
    public function setBreakTimeShowwt()
    {

        $data = $this->input->post('all[]');
        $show_id = $data[0]['show_id'];
        $salesperson = $data[0]['salesperson'];

        foreach ($data as $d) {
            $sdate = $d['date'];
            $startworkingtime = $d['starttimes'];
            $endworkingtime = $d['endtimes'];
            $salesperson = $d['salesperson'];
            $show_id = $d['show_id'];
            $assign_by = $d['assign_by'];
            $date = $sdate;
            if ($salesperson == '') {
                $salesperson = 0;
            }

            $lastid = $this->shows->setbreaktime($date, $startworkingtime, $endworkingtime, $salesperson, $show_id, $assign_by);
        }

        $emp_name = $this->shows->getloginusername($this->aauth->get_user()->id);

        if ($salesperson == 0) {
            if ($this->aauth->get_user()->roleid == 5) {
                $name = '[ Business Owner ' . $emp_name . ' has set working time for All Salespersons  ]';
            } else {
                $name = '[ Teamleader ' . $emp_name . ' has set working time for All Salespersons  ]';
            }
        } else {
            $salesperson_name = $this->shows->getloginusername($salesperson);

            if ($this->aauth->get_user()->roleid == 5) {
                $name = '[ Business Owner ' . $emp_name . ' has set working time for salesperson ' . $salesperson_name . '  ]';
            } else {
                $name = '[ Teamleader ' . $emp_name . ' has set working time for salesperson ' . $salesperson_name . '  ]';
            }
        }



        $this->shows->add_activity($name, $show_id);

        echo json_encode(array('status' => 'Success', 'message' => "Data Inserted Successfully."));
    }

    //     //-----------------------------Inventory------------------------------
    public function requestpackinglisttl()
    {
        $data = $this->input->post();
        $show_id = $data['project'];


        $prqty = 0;
        foreach ($data['product'] as $d) {

            $product_id = $d['id'];
            $requested_qty = $d['requested_qty'];
            $approved_qty = $d['approved_qty'];
            if ($requested_qty == 0) {
                $prqty++;
            }
        }
        if ($prqty == 0) {
            // $count=0;
            foreach ($data['product'] as $d) {

                $product_id = $d['id'];
                $requested_qty = $d['requested_qty'];
                $approved_qty = $d['approved_qty'];

                $check_id = $this->shows->addpackinglistrequest1($product_id, $requested_qty, $approved_qty, $show_id);
            }

            $emp_name = $this->shows->getloginusername($this->aauth->get_user()->id);

            $name = '[ Teamleader ' . $emp_name . ' has requested for Inventory ]';

            $this->shows->add_activity($name, $show_id);
            //call code for notification to business owner for inventory - arzoo
            $product_name = '';
            //owners tokens
            $tokens = $this->shows->retriveOwnersToken();
            $msg = $this->shows->getMessageRequestInventory($show_id, $product_name);
            $this->sendNotification($tokens, "Request for Inventory", $msg);

            echo json_encode(array('status' => 'Success', 'message' => "Request Sent Successfully ."));
        } else {
            echo json_encode(array('status' => 'Warning', 'message' => "Please enter quantity for all products "));
        }
    }
    //     //-----------------------for slaesperson request for product to the TL----------
    public function requestpackinglistsl()
    {
        $data = $this->input->post();

        if ($data['teamleader'] != '' || $data['teamleader'] != null) {

            $show_id = $data['project'];
            $count = 0;
            $checkpr = 0;
            $errormessage = '';
            $checkproductinteamleader = [];
            foreach ($data['product'] as $d) {
                $this->db->select('*');
                $this->db->from('products');
                $this->db->where('products.pid', $d['id']);
                $q1 = $this->db->get();
                $product_data = $q1->row();

                $product_id = $d['id'];
                $requested_qty = $d['requested_qty'];
                $approved_qty = $d['approved_qty'];
                $teamleader = $data['teamleader'];
                $checkproductinteamleader = $this->shows->checkproductinteamleader($product_id, $requested_qty, $teamleader, $show_id);
                if (empty($checkproductinteamleader) || $checkproductinteamleader == '') {
                    $checkpr++;
                    $errormessage .= " <br> Product " . $product_data->product_name . " has insufficient quantity in selected teamleader's warehouse ";
                }
            }
            if ($checkpr == 0) {
                foreach ($data['product'] as $d) {

                    $product_id = $d['id'];
                    $requested_qty = $d['requested_qty'];
                    $approved_qty = $d['approved_qty'];
                    $teamleader = $data['teamleader'];
                    $this->shows->addpackinglistrequest1sl($product_id, $requested_qty, $approved_qty, $show_id, $teamleader);
                }

                $emp_name = $this->shows->getloginusername($this->aauth->get_user()->id);

                $tl_name = $this->shows->getloginusername($data['teamleader']);

                $name = '[ Salesperson ' . $emp_name . ' has requested for Inventory from Teamleader ' . $tl_name . ' ]';

                $this->shows->add_activity($name, $show_id);
                //salesperson - to team leader request for inventory - arzoo
                //owners tokens
                $tokens = $this->shows->getTokens($teamleader);
                // Request for Inventory
                $product_name = '';
                $msg = $this->shows->getMessageRequestInventory($show_id, $product_name);
                $this->sendNotification($tokens, "Request for Inventory", $msg);

                echo json_encode(array('status' => 'Success', 'message' => "Request Sent Successfully."));
            } else {
                echo json_encode(array('status' => 'Warning', 'message' => $errormessage));
            }
        } else {
            echo json_encode(array('status' => 'Warning', 'message' => 'Please Select Teamleader to request for Products.'));
        }
    }
    //get data for display packing list request for business owner
    public function gettlrequestforpackinglist()
    {
        $show_id = $this->input->get('id');
        $items = $this->products->getItemList();
        $item_list = array();
        foreach ($items as $item) {
            $item_list[$item->item_id] = $item->item_name;
        }
        $list = $this->shows->gettlrequestforpackinglist($show_id);
        $data = array();
        $i = 0;
        $j = 0;
        $pre_item = '';
        foreach ($list as $d) {
            $i++;
            $new_item = $d->item_id;
            if ($pre_item != $new_item) {
                $pre_item = $new_item;
                $row = array();
                $row[] = $j++;
                $row[] = "";
                $row[] = "<b>".$item_list[$new_item]."</b>";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $data[] = $row;
            }
            $row = array();
            $row[] = $j++;
            $row[] = $i;
            $row[] = $d->product_name;
            $row[] = $d->empname;
            $row[] = "<input style='width: 60px;' type='number' name='product_requested_quantity' readonly value='" . $d->product_request_qty . "'>";
            if ($d->status == '1') {
                $row[] = "<input style='width: 60px' readonly min='1' max='" . $d->product_request_qty . "' type='number' name='product_approved_quantity' id='approved_qty_" . $d->id . "'  value='" . $d->product_approve_qty . "'>";
            } else {
                $row[] = "<input style='width: 60px' min='1' max='" . $d->product_request_qty . "' type='number' name='product_approved_quantity' id='approved_qty_" . $d->id . "'  value=0>";
            }

            $row[] = $d->product_requested_at;
            if ($d->status == '1') {
                $row[] = "<button type='submit' disabled  data-object-id='" . $d->id . "' data-did='17' class='btn btn-sm btn-success delete-custom'>Approved</button>";
            } elseif ($d->status == '0') {
                $row[] = "<button type='submit'  data-object-id='" . $d->id . "' data-did='17' class='btn btn-sm btn-success delete-custom'>Approve</button>";
            }

            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    //approve packing list request by BO for TL
    public function approve_qty_tl()
    {
        $mid = $this->input->post('object_id');
        $this->db->select('*');
        $this->db->from('packinglist_request_show');
        $this->db->where('id', $mid);
        $this->db->join('products', 'products.pid = packinglist_request_show.product_id', 'left');
        $query = $this->db->get()->row();
        $product_qty = $query->qty;
        $product_name = $query->product_name;
        $product_requested_by = $query->product_requested_by;
        $show_id = $query->show_id;
        $approved_qty = $this->input->post('approve_qty');
        if ($approved_qty != 0) {
            if ($product_qty >= $approved_qty) {
                if ($this->shows->approveproductfortl($mid, $approved_qty)) {
                    //notification to tl for inventory - arzoo
                    //owners tokens
                    $tokens = $this->shows->getTokens($product_requested_by);
                    //for show_name Your Inventory Request for product_name is approved by TL
                    $msg = $this->shows->getMessageApproveInventory($show_id, $product_name);
                    $this->sendNotification($tokens, "Approved for Inventory", $msg);
                    echo json_encode(array('status' => 'Success', 'message' => "Request Approved Successfully."));
                } else {
                    echo json_encode(array('status' => 'Error', 'message' => "Something went wrong !, Please try Later"));
                }
            } else {
                echo json_encode(array('status' => 'Error', 'message' => "" . $approved_qty . " Requested Quantity is not available for product : " . $product_name . ". Only " . $product_qty . " No. of quantity is available "));
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' => "Please enter quantity"));
        }
    }
    //get data for packing list confirmation for tl [ confirm Reciept - Packing List tab  ]
    public function getpackinglistrequestforconfirm()
    {
        $show_id = $this->input->get('id');
        $items = $this->products->getItemList();
        $item_list = array();
        foreach ($items as $item) {
            $item_list[$item->item_id] = $item->item_name;
        }
        $data = array();
        $list = $this->shows->confirmRecieptPackingList($show_id);
        $i = 0;
        $j = 1;
        $pre_item = '';
        foreach ($list as $d) {
            $i++;
            $new_item = $d->item_id;
            if ($pre_item != $new_item) {
                // $j++;
                $pre_item = $new_item;
                $row = array();
                $row[] = $j++;
                $row[] = "";
                $row[] = "<b>".$item_list[$new_item]."</b>";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $data[] = $row;
            }
            $row = array();
            $row[] = $j++;
            $row[] = $i;
            $row[] = $d->product_name;
            $row[] = "<input style='width: 60px' type='number' name='product_requested_quantity' readonly value='" . $d->product_request_qty . "'>";
            $row[] = "<input style='width: 60px' readonly min='1' max='" . $d->qty . "' type='number' name='product_approved_quantity' id='approved_qty_" . $d->packinglist_id . "'  value='" . $d->product_approve_qty . "'>";
            $row[] = $d->product_requested_at;
            $row[] = $d->product_approved_at;
            $row[] = $row[] = "<button type='submit'  data-object-id='" . $d->packinglist_id . "' data-did='21' class='btn btn-sm btn-danger delete-custom'>Confirm</button>";
            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    //confirm reciept by tl - look for this
    public function confirm_reciept_by_tl()
    {
        $mid = $this->input->post('object_id');
        $this->db->select('*');
        $this->db->from('packinglist_request_show');
        $this->db->where('packinglist_request_show.id', $mid);
        $this->db->join('products', 'products.pid = packinglist_request_show.product_id', 'left');
        $query = $this->db->get()->row();
        $request_qty = $query->product_approve_qty;
        $product_qty = $query->qty;
        $product_name = $query->product_name;
        $show_id = $query->show_id;
        if ($request_qty <= $product_qty) {
            $data = $this->shows->confirmrecieptbytl($mid);

            if ($data) {
                //call code for notification to business owner for inventory - arzoo
                //owners tokens
                $tokens = $this->shows->retriveOwnersToken();
                $msg = $this->shows->getMessageConfirmInventory($show_id, $product_name);
                $this->sendNotification($tokens, "Confirmed for Inventory", $msg);
                echo json_encode(array('status' => 'Success', 'message' => "Reciept Confirmed Successfully."));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => "Something went wrong!, Please try Later"));
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' => "Quantity of" . $request_qty . " is unavailable for product " . $product_name . " Currently a qty of " . $product_qty . " is available."));
        }
    }
    //get request history for BO.
    public function gethistorydetailsbo()
    {
        $show_id = $this->input->get('id');
        $list = $this->shows->requesthistorybo($show_id);
        $data = array();
        $i = 1;
        foreach ($list as $d) {
            $row = array();
            $row[] = $i++;
            $row[] = "<a href='' data-id='" . $d->product_requested_at . "' class='view_history'>" . $d->product_requested_at . "</a>";
            if ($d->product_approved_at == '') {
                $row[] = '';
            } else {
                $row[] = $d->product_approved_at;
            }
            if ($d->product_confirm_at == '') {
                $row[] = '';
            } else {
                $row[] = $d->product_confirm_at;
            }
            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    //get request history  for modal BO
    public function view_history_packinglist()
    {
        $requestdate = $this->input->post('requestdate');
        $show_id = $this->input->post('show_id');
        $data = array();
        $list = $this->shows->gethistorydataformodal($requestdate, $show_id);


        $i = 1;
        foreach ($list as $d) {
            $row = array();
            $row['no'] = '' . $i++;
            $row['product_name'] = $d->product_name;
            $row['product_requested_qty'] = $d->product_request_qty;
            $row['product_approved_qty'] = $d->product_approve_qty;
            if ($d->product_requested_at == '' or $d->product_requested_at == null) {
                $row['product_requested_at'] = '';
            } else {
                $row['product_requested_at'] = $d->product_requested_at;
            }
            if ($d->product_approved_at == '' or $d->product_approved_at == null) {
                $row['product_approved_at'] = '';
            } else {
                $row['product_approved_at'] = $d->product_approved_at;
            }
            if ($d->product_confirm_at == '' or $d->product_confirm_at == null) {
                $row['product_received_at'] = '';
            } else {
                $row['product_received_at'] = $d->product_confirm_at;
            }
            if ($d->product_requested_at != '' or $d->product_requested_at != null) {
                $row['action'] = "<button disabled class=' btn-sm btn-danger'>Requested</button>";
            }
            if ($d->product_approved_at != '' or $d->product_approved_at != null) {
                if ($this->aauth->get_user()->roleid == 5) {
                    $row['action'] = "<button teamleader_id=" . $d->product_requested_by . " show_id=" . $d->show_id . " class='btn-sm btn-primary display-consignment-details'>Approved</button>";
                } else {
                    $row['action'] = "<button disabled class=' btn-sm btn-primary'>Approved</button>";
                }
            }
            if ($d->product_confirm_at != '' or $d->product_confirm_at != null) {
                if ($this->aauth->get_user()->roleid == 5) {
                    $row['action'] = "<button teamleader_id=" . $d->product_requested_by . " show_id=" . $d->show_id . " class='btn-sm btn-success display-consignment-details'>Confirmed</button>";
                } else {
                    $row['action'] = "<button disabled class=' btn-sm btn-success'>Confirmed</button>";
                }
            }

            $data[] = $row;
        }

        echo json_encode($data);
    }
    //get request history  for modal TL
    public function view_history_packinglist_tl()
    {
        $requestdate = $this->input->post('requestdate');
        $show_id = $this->input->post('show_id');
        $list = $this->shows->gethistorydataformodaltl($requestdate, $show_id);
        $data = array();

        $i = 1;
        foreach ($list as $d) {
            $row = array();
            $row['no'] = '' . $i++;
            $row['product_name'] = $d->product_name;
            $row['product_requested_qty'] = $d->product_request_qty;
            $row['product_approved_qty'] = $d->product_approve_qty;
            if ($d->product_requested_at == '' or $d->product_requested_at == null) {
                $row['product_requested_at'] = '';
            } else {
                $row['product_requested_at'] = $d->product_requested_at;
            }
            if ($d->product_approved_at == '' or $d->product_approved_at == null) {
                $row['product_approved_at'] = '';
            } else {
                $row['product_approved_at'] = $d->product_approved_at;
            }
            if ($d->product_confirm_at == '' or $d->product_confirm_at == null) {
                $row['product_received_at'] = '';
            } else {
                $row['product_received_at'] = $d->product_confirm_at;
            }
            if ($d->product_requested_at != '' or $d->product_requested_at != null) {
                $row['action'] = "<button disabled class=' btn-sm btn-btn-danger'>Requested</button>";
            }
            if ($d->product_approved_at != '' or $d->product_approved_at != null) {
                $row['action'] = "<button disabled class=' btn-sm btn-primary'>Approved</button>";
            }
            if ($d->product_confirm_at != '' or $d->product_confirm_at != null) {
                $row['action'] = "<button disabled class=' btn-sm btn-success'>Confirmed</button>";
            }

            $data[] = $row;
        }

        echo json_encode($data);
    }
    //get request history for TL
    public function gethistorydetailstl()
    {
        $show_id = $this->input->get('id');
        $list = $this->shows->requesthistorytl($show_id);
        $data = array();
        $i = 1;
        foreach ($list as $d) {
            $row = array();
            $row[] = $i++;
            $row[] = "<a href='' data-id='" . $d->product_requested_at . "' class='view_history1'>" . $d->product_requested_at . "</a>";
            if ($d->product_approved_at == '') {
                $row[] = '';
            } else {
                $row[] = $d->product_approved_at;
            }
            if ($d->product_confirm_at == '') {
                $row[] = '';
            } else {
                $row[] = $d->product_confirm_at;
            }
            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function checkqty()
    {
        $pr_id = $this->input->post('product_id');
        $pr_qty = $this->input->post('product_qty');
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('pid', $pr_id);
        $totalqty = $this->db->get()->row()->qty;
        if ($totalqty >= $pr_qty) {
            $rt = "success";
        } else {
            $rt = "fail";
        }
        echo json_encode($rt);
    }
    //----------------get sales person request list -----------------
    public function salesperson_request_list()
    {
        $id = $this->input->get('id');
        $items = $this->products->getItemList();
        $item_list = array();
        foreach ($items as $item) {
            $item_list[$item->item_id] = $item->item_name;
        }
        $data = array();
        $list = $this->shows->salespersonrequestlist($id);
        $i = 1;
        $j = 0;
        $pre_item = '';
        foreach ($list as $d) {
            $new_item = $d->item_id;
            if ($pre_item != $new_item) {
                $pre_item = $new_item;
                $row = array();
                $row[] = $j++;
                $row[] = "";
                $row[] = "<b>".$item_list[$new_item]."</b>";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $data[] = $row;
            }
            $row = array();
            $row[] = $j++;
            $row[] = $i++;
            $row[] = $d->product_name;
            $row[] = $d->product_request_qty;
            $row[] = $d->product_approve_qty;
            $row[] = $d->product_requested_at;
            if ($d->product_approved_at == '') {
                $row[] = '';
            } else {
                $row[] = $d->product_approved_at;
            }
            if ($d->product_confirm_at == '') {
                $row[] = '';
            } else {
                $row[] = $d->product_confirm_at;
            }


            if ($d->status == '0') {
                $row[] = "<button readonly disabled class='btn btn-danger btn-sm'>Requested</button>";
            } else if ($d->status == '1') {
                $row[] = "<button readonly disabled class='btn btn-success btn-sm'>Approved</button>";
            } else if ($d->status == '2') {
                $row[] = "<button readonly disabled class='btn btn-brown btn-sm'>Confirmed</button>";
            }

            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    //get Slaes person request list for tl
    public function salesperson_request_list_for_tl()
    {
        $show_id = $this->input->get('id');
        $items = $this->products->getItemList();
        $item_list = array();
        foreach ($items as $item) {
            $item_list[$item->item_id] = $item->item_name;
        }
        $data = array();
        $list = $this->shows->getSalespersonRequisitonListforTL($show_id);
        $i = 1;
        $pre_item = '';
        foreach ($list as $d) {
            $new_item = $d->item_id;
            if ($pre_item != $new_item) {
                $pre_item = $new_item;
                $row = array();
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "<b>".$item_list[$new_item]."</b>";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $data[] = $row;
            }
            $row = array();
            $row[] = $i++;
            $row[] = $d->product_name;
            $row[] = $d->name;
            $row[] = "<input type='number' style='width: 60px' name='product_requested_quantity' disabled value='" . $d->product_request_qty . "' />";
            $row[] = "<input style='width: 60px' min='1' max='" . $d->product_request_qty . "' type='number' name='product_approved_quantity' id='approved_qty_" . $d->request_id . "' value='1'> ";
            $row[] = $d->product_requested_at;
            $row[] = "<button type='submit' data-object-id='" . $d->request_id . "' data-did='28' class='btn btn-sm btn-success delete-custom'>Approve</button>";
            $data[] = $row;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }
    //Approve Request for sales person by team leader
    public function approve_qty_sl()
    {
        $mid = $this->input->post('object_id');
        $approved_qty = $this->input->post('approve_qty');

        if ($approved_qty != 0 || $approved_qty != '') {

            $check = $this->shows->approveproductforsl($mid, $approved_qty);
            if ($check == 1) {
                //Sales Person Requisition List approved by Tl - arzoo
                $this->db->select('salesperson_request.*,products.product_name');
                $this->db->from('salesperson_request');
                $this->db->where('salesperson_request.id', $mid);
                $this->db->join('products', 'products.pid=salesperson_request.product_id ');
                $q1 = $this->db->get();
                foreach ($q1->result() as $row) {
                    //array_push($data,$row->location_id);
                    $product_name = $row->product_name;
                    $product_requested_by = $row->product_requested_by;
                    $show_id  = $row->show_id;
                }


                //owners tokens
                $tokens = $this->shows->getTokens($product_requested_by);
                // Request for Inventory

                $msg = $this->shows->getMessageApproveInventory($show_id, $product_name);
                $this->sendNotification($tokens, "Apply for Inventory", $msg);
                echo json_encode(array('status' => 'Success', 'message' => "Request Approved Successfully."));
            } else if ($check == 2) {
                echo json_encode(array('status' => 'Warning', 'message' => "You do not have product stock available for Approval"));
            } else if ($check == 3) {
                echo json_encode(array('status' => 'Warning', 'message' => "You have not enough product quantity available for approval"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => "Something went wrong !, Please try Later"));
            }
        } else {
            echo json_encode(array('status' => 'Warning', 'message' => "Please Enter Valid Product Quantity for Approval"));
        }
    }
    //get sales person confirm list
    public function salesperson_request_confirm()
    {
        $show_id = $this->input->get('id');
        $items = $this->products->getItemList();
        $item_list = array();
        foreach ($items as $item) {
            $item_list[$item->item_id] = $item->item_name;
        }
        $list = $this->shows->confirmRecieptSl($show_id);
        //   $listtl=$this->shows->getTLrequestforsl($show_id);



        $data = array();


        $i = 1;
        $j = 0;
        $pre_item = '';
        foreach ($list as $d) {
            $new_item = $d->item_id;
            if ($pre_item != $new_item) {
                $pre_item = $new_item;
                $row = array();
                $row[] = $j++;
                $row[] = "";
                $row[] = "<b>".$item_list[$new_item]."</b>";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                // $row[] = "";
                $data[] = $row;
            }
            $row = array();
            $row[] = $j++;
            $row[] = $i++;
            $row[] = $d->product_name;
            $row[] = "<input style='width: 60px' type='number' name='product_requested_quantity' readonly value='" . $d->product_request_qty . "'>";
            $row[] = "<input style='width: 60px' readonly min='1' max='" . $d->qty . "' type='number' name='product_approved_quantity' id='approved_qty_" . $d->packinglist_id . "'  value='" . $d->product_approve_qty . "'>";
            $row[] = $d->name;
            $row[] = $d->product_requested_at;
            $row[] = $d->product_approved_at;
            $row[] = $row[] = " <button type='submit' data-object-id='" . $d->packinglist_id . "' data-did='38' class='btn btn-sm btn-danger delete-custom'>Confirm</button>";

            $data[] = $row;
        }

        // foreach($listtl as $d)
        // {
        //      $row=array();

        //      $row[]=$i++;
        //      $row[]=$d->product_name;
        //      $row[]="<input style='width: 60px' type='number' name='product_requested_quantity' readonly value='".$d->product_request_qty."'>";
        //      $row[]="<input style='width: 60px' readonly min='1' max='".$d->qty."' type='number' name='product_approved_quantity' value='".$d->product_request_qty."'>";
        //      $row[]=$d->name;
        //      $row[]=$d->requested_at;
        //      $row[]=$d->requested_at;
        //      $row[]= $row[]=" <button type='submit' data-object-id='".$d->table_id."' data-did='63' class='btn btn-sm btn-danger delete-custom'>Confirm</button>";

        //      $data[]=$row;
        // }

        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    //confirm reciept by tl
    public function confirm_reciept_by_sl()
    {
        $mid = $this->input->post('object_id');
        $show_id = $this->input->post('show_id');


        $data = $this->shows->confirmrecieptbysl($mid, $show_id);
        if ($data == 1) {
            //call code for notification to TL for inventory - arzoo
            $this->db->select('products.product_name');
            $this->db->from('products');
            $this->db->join('salesperson_request', 'salesperson_request.product_id=products.pid');
            $this->db->where('salesperson_request.show_id', $show_id);
            $query = $this->db->get();
            $product_name = $query->product_name;
            //owners tokens
            $tokens = $this->shows->retriveTeamLeaderToken($show_id);
            $msg = $this->shows->getMessageConfirmInventory($show_id, $product_name);
            $this->sendNotification($tokens, "Confirmed for Inventory", $msg);
            echo json_encode(array('status' => 'Success', 'message' => "Reciept Confirmed Successfully."));
        } else if ($data == 2) {
            echo json_encode(array('status' => 'Warning', 'message' => "Not Enough Product stock available for confirmed product. Please try after some time !"));
        } else if ($data == 3) {
            echo json_encode(array('status' => 'Warning', 'message' => "Teamleader has no Product stock available. Please try after sometime !"));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => "Something went wrong!, Please try Leter"));
        }
    }

    //Add Stock Transfer Request for Team leader
    public function transferfullstock()
    {
        $show_id = $this->input->post('project');
        $transferteamleader = $this->input->post('transferteamleader');
        if ($transferteamleader == '') {
            echo json_encode(array('status' => 'Warning', 'message' => "Please Select Team Leader for Stock Transfer"));
        } else {
            $data = $this->shows->transferallstock($show_id, $transferteamleader);
            if ($data) {
                echo json_encode(array('status' => 'Success', 'message' => "Successfully Transferred"));
            } else {
                echo json_encode(array('status' => 'Warning', 'message' => "You Don't have Enough stock to Transfer Products."));
            }
        }
    }
    //Get Data for display stock transfer history.
    public function stock_transfer_history_list()
    {

        $show_id = $this->input->get('id');
        $list = $this->shows->stock_list($show_id);
        $data = array();

        $i = 1;
        foreach ($list as $d) {
            $row = array();
            $row[] = $i++;
            $row[] = $d['teamleader_transfer'];
            $row[] = $d['teamleader_accept'];
            $row[] = $d['product_name'];
            $row[] = $d['qt'];
            $row[] = $d['created_at'];

            if ($this->aauth->get_user()->id == $d['id'] && $d['status'] == 0) {
                $row[] = 'Transferred and Not Confirmed';
            } else if ($this->aauth->get_user()->id == $d['id'] && $d['status'] == 1) {
                $row[] = 'Transferred and Confirmed';
            } else if ($this->aauth->get_user()->id != $d['id'] && $d['status'] == 0) {
                $row[] = 'Received and Not Confirmed';
            } else if ($this->aauth->get_user()->id != $d['id'] && $d['status'] == 1) {
                $row[] = 'Received and Confirmed';
            }

            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }
    //Get Products which has color is available
    public function colorproductstock()
    {
        $list = $this->shows->getcolorproductstock(22);
        print_r($list);
        die;
    }
    //Delete Approved team leader for show.
    public function delete_tl_show()
    {
        $pid = $this->input->post('object_id');
        $show_id = $this->input->post('project_id');
        $this->shows->delete_tl_show($pid, $show_id);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
    }
    //Transfer Stock Manually for history
    public function transferstockmanually()
    {
        $data = $this->input->post();

        $show_id = $data['project'];
        print_r($data);
        die();
        $count = 0;
        $checkpr = 0;
        $errormessage = '';
        $checkproductinteamleader = [];
        foreach ($data['product'] as $d) {
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('products.pid', $d['id']);
            $q1 = $this->db->get();
            $product_data = $q1->row();

            $product_id = $d['id'];
            $requested_qty = $d['requested_qty'];
            $approved_qty = $d['approved_qty'];
            $teamleader = $data['teamleader'];
            $checkproductinteamleader = $this->shows->checkproductinteamleader($product_id, $requested_qty, $teamleader);
            if (empty($checkproductinteamleader) || $checkproductinteamleader == '') {
                $checkpr++;
                $errormessage .= " <br> Product " . $product_data->product_name . " does not have enough stock in selected teamleader's warehouse ";
            }
        }
        if ($checkpr == 0) { } else { }
    }
    public function confirmedtransferstock()
    {
        echo '<pre>';
        print_r($_REQUEST);
        die;
    }
    //Add Manually Stock Transfer Details
    public function transfermanuallydata()
    {
        $data = $this->input->post();
        $checkproductavaibility = 0;
        $message = '';
        $teamleader_id = $data['get_transfer_teamleadr_id'];
        $show_id = $data['project'];
        if ($teamleader_id == '') {
            echo json_encode(array('status' => 'Warning', 'message' => 'Please Select Team leader for stock transfer'));
        } else {
            foreach ($data['product'] as $d) {
                $product_id = $d['id'];
                $requested_qty = $d['requested_qty'];
                $this->db->select('*');
                $this->db->from('products');
                $this->db->where('products.pid', $product_id);
                $productname = $this->db->get()->row();
                $pr_name = $productname->product_name;
                $check = $this->shows->checkteamleaderproduct($product_id, $requested_qty);
                if ($check == '' || empty($check)) {
                    $checkproductavaibility++;
                    $message .= " You don't have enough quantity to transfer product " . $pr_name;
                }
            }
            if ($checkproductavaibility == 0) {
                foreach ($data['product'] as $d) {
                    $product_id = $d['id'];
                    $qty = $d['requested_qty'];
                    $teamleader_transfer_id = $this->aauth->get_user()->id;
                    $teamleader_accept_id = $data['get_transfer_teamleadr_id'];
                    $status = 0;
                    $created_at = date("Y-m-d H:i:s");
                    $transfertype = 0;
                    $show_id = $data['project'];
                    $this->shows->savetransferstockrequest($product_id, $teamleader_transfer_id, $teamleader_accept_id, $qty, $status, $created_at, $show_id, $transfertype);
                }
                echo json_encode(array('status' => 'Success', 'message' => 'Transfer Request sent Successfully'));
            } else {
                echo json_encode(array('status' => 'Warning', 'message' => $message));
            }
        }
    }
    //Team Leader Confirmation for stock Transfer.
    public function confirmtransferdataforteamleader()
    {
        $data['id'] = $this->input->post('id');
        $id = $data['id'];
        $check = $this->shows->transferstock($id);
        echo json_encode(array('status' => 'Success', 'message' => 'Transfer Request Confirmed Successfully'));
    }
    //Add Working Time for all sales person or for sinle salesperson.
    public function addworkingtime()
    {
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Working Time';
        $data['totalt'] = $this->projects->project_count_all();
        $data['emp'] = $this->shows->getSalesperson();
        $data['show_emp'] = $this->shows->getshowsalespersononly($id);
        $data['date'] = $this->shows->getShowDate($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/setworkingtime', $data);
        $this->load->view('fixed/footer');
    }
    //Edit Break time for salesperson.
    public function editbreaktime()
    {

        $id = $this->input->get('show_id');
        $salesperson_id = $this->input->get('id');
        $actual_sl = $this->input->get('asid');
        $data['breaktimedetailsfromdatatabse'] = $this->shows->getbreaktimedetailsfrodisplay($id, $actual_sl);

        $data['workingtimedetails'] = $this->shows->getworkingtimedetails($id, $salesperson_id);
        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->model('employee_model', 'employee');
        $data['salesperson'] = $this->employee->employee_details($actual_sl);
        $head['title'] = 'Add Break Time';
        $data['totalt'] = $this->projects->project_count_all();
        $data['emp'] = $this->shows->getSalesPersonByShowAssignedOnly($id);

        $explore = $this->shows->explore($id);
        $data['project'] = $explore['project'];
        $data['date'] = $this->shows->getShowDate($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('projects/editbreaktime', $data);
        $this->load->view('fixed/footer');
    }
    //Add Break Time for salesperson.
    public function addbreaktime()
    {
        $data = $this->input->post('all[]');
        foreach ($data as $d) {
            $detail_id = $d['detail_id'];
            $salesperson_id = $d['salesperson_id'];
            $show_id = $d['show_id'];
            $this->shows->deletebreaktime($detail_id, $salesperson_id, $show_id);
        }
        foreach ($data as $d) {
            $detail_id = $d['detail_id'];

            $sbrk = array();
            $ebrk = array();
            foreach ($d['start_break_time'] as $sbreak) {
                $sbrk[] = $sbreak;
            }
            foreach ($d['end_break_time'] as $ebreak) {
                $ebrk[] = $ebreak;
            }
            for ($i = 0; $i < count($sbrk); $i++) {
                $this->shows->addbreaktime($detail_id, $sbrk[$i], $ebrk[$i], $d['salesperson_id'], $d['show_id']);
            }
        }

        $emp_name = $this->shows->getloginusername($this->aauth->get_user()->id);

        $salesperson_name = $this->shows->getloginusername($salesperson_id);

        if ($this->aauth->get_user()->roleid == 5) {
            $name = '[ Business Owner ' . $emp_name . ' has set Break Time for Salesperson ' . $salesperson_name . ' ]';
        } else {
            $name = '[ Team Leader ' . $emp_name . ' has set Break Time for Salesperson ' . $salesperson_name . ' ]';
        }

        $this->shows->add_activity($name, $show_id);

        echo json_encode(array('status' => 'Success', 'message' => "Data Inserted Successfully."));
    }
    //Get Single milestone date for validation
    public function getmilestonedate()
    {
        $mid = $this->input->post('milestone_id');
        echo json_encode($this->shows->getmilestonedate($mid));
    }
    //Get all milestone's date for check Add Milestone date validation
    public function getmilestonealldate()
    {
        $show_id = $this->input->post('id');
        echo json_encode($this->shows->getmilestonesdateforcheck($show_id));
    }
    //Get all milestone's date for check Edit Milestone date validation
    public function getmilestonealldateedit()
    {
        $show_id = $this->input->post('id');
        $mile_id = $this->input->post('mile_id');
        echo json_encode($this->shows->getmilestonesdateforcheckedit($show_id, $mile_id));
    }
    //Get Working time details for save update break time details.
    public function getdetailsfordisplay()
    {
        $show_id = $this->input->post('show_id');
        $show_start_work_date = $this->input->post('show_start_work_date');
        $show_end_work_date = $this->input->post('show_end_work_date');
        $salesperson = $this->input->post('salesperson');
        $data = $this->shows->getshowworkingtime($show_id, $show_start_work_date, $show_end_work_date, $salesperson);
        echo json_encode($data);
    }
    //Delete Break time details when click on delete button fron Salesperson Table for selected sales person.
    public function deletebreaktime_show()
    {
        $show_id = $this->input->post('show_id');
        $salesperson_id = $this->input->post('salesperson_id');
        $this->shows->deletebreaktimefromtable($show_id, $salesperson_id);
        echo json_encode(array('status' => 'Success', 'message' => "Break Time Details deleted Successfully"));
    }

    //Confirm Inventory Reqisition Reciept By Salespersn which is allocated by team leader
    public function confirm_reciept_by_sl_to_tl()
    {
        $data = $this->input->post();

        $table_id = $data['object_id'];

        $show_id = $data['show_id'];

        $check = $this->shows->confrim_tl_pr_rq_by_sl($table_id, $show_id);


        if ($check == 2) {
            echo json_encode(array('status' => 'Warning', 'message' => "Not enough product stock available. Please try after sometime !"));
        } else if ($check == 3) {
            echo json_encode(array('status' => 'Warning', 'message' => "Product is unavailable with this team leader. Please try after sometime !"));
        } else if ($check == 1) {
            echo json_encode(array('status' => 'Success', 'message' => "Product Confirmed Successfully."));
        }
    }


    //Allocate Inventory by teamleader to salesperson.
    public function sendproductby_tl_sl()
    {

        $data = $this->input->post();

        $checkcounter = 0;

        $counter = count($data['pid']);

        $salesperson_id = $data['sl'];

        $show_id = $data['project'];

        if ($salesperson_id == '') {
            echo json_encode(array('status' => 'Warning', 'message' => "Pleaase Select Salesperson !"));
        } else {
            for ($i = 0; $i < $counter; $i++) {
                $table_id = $data['id'][$i];
                $product_id = $data['pid'][$i];
                $product_qty = $data['pr_qty'][$i];

                $check_product_qty = $this->shows->check_product_qty_product_warehouse($table_id);



                if (empty($check_product_qty)) {
                    echo json_encode(array('status' => 'Danger', 'message' => "Something went wrong, Please try again"));
                } else {
                    if (($check_product_qty->total_qty < $product_qty) || ($product_qty == 0)) {

                        $checkcounter++;
                    }
                }
            }


            if ($checkcounter != 0) {
                echo json_encode(array('status' => 'Warning', 'message' => "You don't have enough stock for products or you have entered 0 quantity for product ! Please enter valid quantity of products to send to salesperson"));
            } else {
                for ($i = 0; $i < $counter; $i++) {
                    $table_id = $data['id'][$i];
                    $product_id = $data['pid'][$i];
                    $product_qty = $data['pr_qty'][$i];

                    $this->shows->add_teamleader_request_to_sl($salesperson_id, $show_id, $product_id, $product_qty);
                }

                echo json_encode(array('status' => 'Success', 'message' => "Request sent Successfully"));
            }
        }
    }
    //location code -- arzoo
    function getLocationsAPI($id = '0')
    {
        //print_r($id);
        //echo $id;
        $locations_db = $this->shows->getAllLocations();
        //print_r($locations_db);
        // echo (in_array($id,$locations_db));
        $path = APPPATH . 'third_party/connect-php-sdk/autoload.php';
        //  echo $path;
        require_once($path);
        $this->config->load('api_config');

        $token = $this->config->item('square_token');
        // Configure OAuth2 access token for authorization: oauth2
        SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($token); # create an instance of the Location API
        $locations_api = new \SquareConnect\Api\LocationsApi();

        try {
            $locations = $locations_api->listLocations();

            $data = array();
            foreach ($locations->getLocations() as $key => $value) {
                // print_r($value['id'].' abcd '.(!in_array($value['id'],$locations_db).' '.($id == $value['id']).'<br/>'));
                if ((!in_array($value['id'], $locations_db)) || ($id == $value['id'])) {

                    array_push($data, ['id' => $value['id'], 'name' => $value['name']]);
                }
            }

            return ($data);
        } catch (\SquareConnect\ApiException $e) {

            return 0;
        }
    }
    //send notification -- arzoo
    public function sendNotification($ids, $title, $msgd)
        // public function sendNotification()

    {

        //define('SERVER_API_KEY', 'AIzaSyBfZJGjP72Xsgm6aodFg8hd50KiExAYKP4');
        // $tokens = array();
        // $tokens = $ids;
        $this->config->load('api_config');

        $SERVER_API_KEY = $this->config->item('firebase_token');
        // $ret = $this->shows->getTokens($ids);
        // foreach ($ret as $row) {
        //     array_push($tokens, $row->device_token);
        // }
        // print_r($ids);
        $dashboard = base_url() . 'dashboard';

        $header = [
            'Authorization: Key=' . $SERVER_API_KEY,
            'Content-Type:Application/json'
        ];
        $msg = [
            'title' => $title,
            'body' => $msgd,
            'icon' => 'https://acmesoftware.net/userfiles/company/1556091612354279320.png',
            'image' => 'https://acmesoftware.net/userfiles/company/1556091612354279320.png',
            'click_action' => $dashboard,
        ];
        $payload = [
            'registration_ids' => $ids,
            'data' => $msg,
            'notification' => $msg
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return;
    }
    //get break notification
    public function getBreakDetails()
    {
        $data = $this->shows->getBreakTimingInfo();
        //print_r($data);
        foreach ($data as $key => $value) {
            $title = "Break time coming up";
            $msgd = "Your break time for show " . $value['name'] . " will start in 5-10 minutes";
            $this->sendNotification($value['token'], $title, $msgd);
            // print_r($key);
            // echo "<br/>";
            // print_r($value['token']);
            // echo "<br/>";
            // echo $title . ' ' . $msgd . "<br/>";
        }
        // $this->sendNotification($ids, $title,$msgd);
    }

    //booth image upload Arzoo
    public function doc_image_upload()
    {
        $this->load->helper("file");
        $this->load->helper(array('form', 'url'));
        $this->load->helper('directory');
        $this->load->library("upload");
        //  $id=$this->input->post('id');
        // $id = $this->session->userdata('attach_id');

        if ($_FILES['uploadFile']['size'] > 0) {
            $this->upload->initialize(array(
                "upload_path" => './assets/booth_img/',
                "overwrite" => FALSE,
                "max_filename" => 300,
                "remove_spaces" => TRUE,
                "allowed_types" => '*',
                "max_size" => 30000,
            ));
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);
            }
            $data = $this->upload->data();
            $path = $data['file_name'];
            echo $path;
        } else {
            echo "no file";
        }
    }
    //retive amount for sales person and show
    public function getSalesPersonAmount(){
        $sp_id = $this->input->post('salesperson_id');
        $loc_id = $this->input->post('show_id');
        $amnt = $this->invoice->getSalesPersonAmount($sp_id, $loc_id);
        echo $amnt;
    }
    public function notifytheTeamLeader(){
        $limit = 500;
        $msgs = $this->account->getTeamLeaderIdsToNotify();
        echo json_encode($msgs);
        foreach($msgs as $msg){
            $m = 'Cash in hand for '.$msg['sales_name'].' is more than '.$limit.' for show '.$msg['show_name'];

            $this->sendNotification($msg['team_lead_device_token'],'Cash Balance is more than limit',$m);
            // $this->sendNotification("dhTpM7IRnjE:APA91bFcI2yinxLT93Qcruwp4xQWBNCIdBgFKyFkTMos-ApAQ8JjGEKa2oVfam8ON-wpWAnxw-c7GrimZJ6H1ZfzLPCzCLwJdkReB46pRO7bzIngxT7FmiqdgGjMVVPKzp2wy6TzM1tE",'Balance is more than limit',$m);
            echo $m;
        }

    }
    public function getAllShowRequests(){
        if($this->aauth->get_user()->roleid == 5){
            $data = $this->shows->getAllPendingShowRequests();
        }else{
            $data= array();
        }

        echo json_encode($data);
    }
	
	//check show id for duplicate
    public function checkshowId(){
        $show_id = $this->input->post('show_id');
       
        $cnt = $this->shows->checkshowId($show_id);
        echo $cnt;
    }
}
