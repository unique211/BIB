<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Shows_model extends CI_Model

{

	var $column_order = array('shows.status', 'shows.name', 'shows.edate', 'shows.worth', null);

    var $column_search = array('shows.name', 'shows.edate', 'shows.status');

    var $tcolumn_order = array('status', 'name', 'duedate', 'start', null, null);

    var $tcolumn_search = array('name', 'edate', 'status');

    var $order = array('id' => 'desc');





    //add new show

    public function addshow($show_id,$name, $status,$atendance,$budget,$quota,$employee, $sdate,$setupdate,$eddate,$setuptime,$note,$hourlyrate,$tlcomission,$default_warehouse,$shipping_option,$tag,$task_communication,$location,$shipping_carrier)

    {

    	

        $data = array(

        	'show_id'=>$show_id,

        	'show_name' => $name,

        	'show_status'=>$status,

        	'show_attendence'=>$atendance,

        	'show_budget'=>$budget,

        	'show_quota'=>$quota,

        	'show_assign_to'=>$employee,

        	'show_start_date'=>$sdate,

        	'show_end_date'=>$eddate,

        	'show_setup_date'=>$setupdate,

        	'show_setup_time'=>$setuptime,

        	'show_hourly_wage'=>$hourlyrate,

        	'show_note'=>$note,

        	'show_tl_commission'=>$tlcomission,

        	'show_default_warehouse'=>$default_warehouse,

        	'show_shipping_option'=>$shipping_option,

        	'show_tag'=>$tag,

            'show_task_communication'=>$task_communication,
            
            'location_id' =>$location,
            'shipping_carrier' =>$shipping_carrier

            );



        $this->db->insert('shows', $data);



   



        $last = $this->db->insert_id();

        



        $title = '[Show Created] ';

        $this->add_activity($title, $last);

        $data = array('sid' => $last, 'metakey' => 2, 'metadata' => $customerview, 'value' => $customer_comment);

        $this->db->insert('showmeta', $data);



        if ($employee) {

            foreach ($employee as $key => $value) {



                $data = array('pid' => $last, 'meta_key' => 19, 'meta_data' => $value);

                $this->db->insert('project_meta', $data);

            }

        } else {

            $data = array('sid' => $last, 'metakey' => 19, 'metadata' => $this->aauth->get_user()->id);

            $this->db->insert('showmeta', $data);

        }



       return $last;

       

    }



    //Get all show list

    public function show_list()
    { 

        $this->db->select('*');

        $this->db->from('shows');

        
        if($this->aauth->get_user()->roleid==2){
            $this->db->where('id',$this->session->userdata('salesperson_show_id'));
        }

        $this->db->order_by('id', 'DESC');


        $query = $this->db->get();

        return $query->result();

    }

    //Get last 10 show list before current date

    public function show_list1()
    { 

        $this->db->select('id,show_name,show_status,show_start_date,show_id');

        $this->db->from('shows');

        $this->db->where('show_start_date <',date('Y-m-d'));
        
        $this->db->order_by('show_start_date', 'DESC');

        $this->db->order_by('id', 'DESC');

        $this->db->limit('10');

        $query = $this->db->get();

      // echo  $this->db-last_query();

       return $query->result();

    }

//Get last 10 show list after current date

public function show_list2()
{ 

    $this->db->select('id,show_name,show_status,show_start_date,show_id');

    $this->db->from('shows');

    $this->db->where('show_start_date >',date('Y-m-d'));
    
    $this->db->order_by('show_start_date', 'ASC');

    $this->db->order_by('id', 'ASC');

    $this->db->limit('10');

    $query = $this->db->get();

  // echo  $this->db-last_query();

   return $query->result();

}

    //Get all show list

    public function show_request_list()

    { 

        $this->db->select('*');

        $this->db->from('shows');

        $this->db->where('show_status !=','Terminated');

        $this->db->where('show_status !=','Finished');

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();

        return $query->result();



    }



    //Get show by id

    public function details($id)

    {



        $this->db->select('shows.*');

        $this->db->from('shows');

        $this->db->where('shows.id', $id);

        $query = $this->db->get();



        return $query->row_array();

    }



    //Filter show details

    function show_count_filtered()

    {

        $this->_show_list();

        $query = $this->db->get();

        return $query->num_rows();

    }



    //Count show

    public function show_count_all()

    {

        $this->_show_list();

        $query = $this->db->get();

        return $query->num_rows();

    }



    //Add activity

    public function add_activity($name, $prid)
    {



        $data = array('sid' => $prid, 'metakey' => 12, 'value' => $name . ' @' . date('Y-m-d H:i:s'));

        if ($prid) {

            return $this->db->insert('showmeta', $data);



        } else {

            return 0;

        }

    }


    //Edit Show

    public function editshow($id,$store_id,$name, $status,$atendance,$budget,$quota,$employee, $sdate,$setupdate,$eddate,$setuptime,$note,$hourlyrate,$tlcomission,$default_warehouse,$shipping_option,$tag,$task_communication,$location,$shipping_carrier)

    {



        $title = '[Show Edited] ';

        $this->add_activity($title, $id);

        $data = array(

            'show_id'=>$store_id,

            'show_name' => $name,

            'show_status'=>$status,

            'show_attendence'=>$atendance,

            'show_budget'=>$budget,

            'show_quota'=>$quota,

            'show_assign_to'=>$employee,

            'show_start_date'=>$sdate,

            'show_end_date'=>$eddate,

            'show_setup_date'=>$setupdate,

            'show_setup_time'=>$setuptime,

            'show_hourly_wage'=>$hourlyrate,

            'show_note'=>$note,

            'show_tl_commission'=>$tlcomission,

            'show_default_warehouse'=>$default_warehouse,

            'show_shipping_option'=>$shipping_option,

            'show_tag'=>$tag,

            'show_task_communication'=>$task_communication,
            'location_id'=>$location,
            'shipping_carrier'=>$shipping_carrier

        );

        
        $this->db->set($data);

        $this->db->where('id', $id);

        $out = $this->db->update('shows');   
      
       

        $data1 = array('meta_data' => $customerview, 'value' => $customer_comment);

        $this->db->set($data1);

        $this->db->where('pid', $id);

        $this->db->where('meta_key', 2);



        return $this->db->update('project_meta');

    }



    //Get Details for Expolre Show Explore page

    public function explore($id)

    {

        //shows

        $this->db->select('shows.*');

        $this->db->from('shows');

        $this->db->where('shows.id', $id);

        $query = $this->db->get();

        $project = $query->row_array();

        

        return array('project' => $project);



    }



    //Get Ectivity by id

    public function activities($id)
    {

        $this->db->select('showmeta.value');

        $this->db->from('showmeta');

        $this->db->where('sid', $id);

        $this->db->order_by('showmeta.id', 'desc');


        $query = $this->db->get();

        return $query->result_array();

    }



    //Add Tasks

    public function addtask($name, $status, $priority, $stdate, $tdate, $employee, $assign, $content, $prid, $milestone)

    {

        $data = array('showtaskdate' => date('Y-m-d H:i:s'), 'showtaskname' => $name, 'showtaskstatus' => $status, 'showtaskstart' => $stdate, 'showtaskdue' => $tdate, 'showtaskdescription' => $content, 'showtaskeid' => $employee, 'showtaskaid' => $assign, 'showrelated' => 1, 'showpriority' => $priority, 'sid' => $prid,'milestone_id'=>$milestone);
        

            return $this->db->insert('showtodolist', $data);

            
    }

    public function edittask($id, $name, $status, $priority,$milestone, $stdate, $tdate, $employee, $content)
    {

       // echo 124;

        $array=array(
            'showtaskname'=>$name,
            'showtaskstatus'=>$status,
            'showtaskdate'=>date('Y-m-d H:i:s'),
            'showtaskstart'=>$stdate,
            'showtaskdue'=>$tdate,
            'showtaskdescription'=>$content,
            'showtaskeid'=>$employee,
            'showtaskaid'=>$this->aauth->get_user()->id,
            'showrelated'=>1,
            'showpriority'=>$priority,
            'milestone_id'=>$milestone

            );

            $this->db->set($array);

            $this->db->where('id', $id);

            return $this->db->update('showtodolist');
    }



  

    //Get Task Data for table display

    function task_datatables($cday = '')

    {

       

       $this->db->select('showtodolist.*');

       $this->db->from('showtodolist');

       $this->db->where('sid=',$cday);

       $this->db->order_by('id', 'desc');

       $query = $this->db->get();

       return $query->result();

    }



    //Add milestone

    public function add_milestone($name, $stdate, $tdate, $content, $color, $prid)
    {


        $data1 = array('pid' => $prid, 'name' => $name, 'sdate' => $stdate, 'edate' => $tdate, 'color' => $color, 'exp' => $content);

        if ($prid) {

            $title =  $name .'[Milestone Added] ';

             $data = array('sid' => $prid, 'metakey' => 10, 'value' =>$title . ' @' . date('Y-m-d H:i:s'));

          $this->db->insert('showmeta', $data);

        return $this->db->insert('showmilestone', $data1);

        } else {

            return 0;

        }

    }



    //Get Milestone List

    public function milestones_list($id)

    {

    $this->db->select('*');

    $this->db->from('showmilestone');

    $this->db->where('pid=',$id);

    $this->db->order_by('id', 'desc');

    $query = $this->db->get();

     return $query->result_array();

    }

    public function milestones_list_all($id)

    {

    $this->db->select('*');

    $this->db->from('showmilestone');

    $this->db->where('pid=',$id);

    $this->db->order_by('id', 'desc');

    $query = $this->db->get();

    return $query->result();

    }



    //Get Milestone details order by

    public function milestones($id)
    {
        $this->db->select('*');

        $this->db->from('showmilestone');

        $this->db->where('pid', $id);

        $this->db->order_by('id', 'desc');

        $query = $this->db->get();

        return $query->result_array();

    }



    //Set notes

    public function setnote($id, $stat)

    {



        $data = array('show_note' => $stat);

        $this->db->set($data);

        $this->db->where('id', $id);

        return $this->db->update('shows');

    }



     //Add Comments

    public function add_comment($comment, $prid, $emp)

    {



        $data = array('sid' => $prid, 'metakey' => 13, 'meatadata' => $emp, 'value' => $comment . '<br><small>@' . date('Y-m-d H:i:s') . '</small>');

        if ($prid) {



            return $this->db->insert('showmeta', $data);

        } else {

            return 0;

        }

    }



    //comments

    public function comments_thread($id)

    {



        $this->db->select('showmeta.value, showmeta.key3,employee_profile.name AS employee, customers.name AS customer');

        $this->db->from('showmeta');

        $this->db->where('showmeta.sid', $id);

        $this->db->where('showmeta.metakey', 13);

        $this->db->join('employee_profile', 'showmeta.meatadata = employee_profile.id', 'left');

        $this->db->join('customers', 'showmeta.key3 = customers.id', 'left');

        $this->db->order_by('showmeta.id', 'desc');

        $query = $this->db->get();

        return $query->result_array();

    }



    //Add Booths

    public function addbooth($prid,$size,$cost,$description, $product,$teamleader)

    {

         $title =  $name .'[Booth Added] ';

             $data1 = array('sid' => $prid, 'metakey' => 5, 'value' =>$title . ' @' . date('Y-m-d H:i:s'));

             $this->db->insert('showmeta', $data1);

        $data = array('prid' => $prid,'size'=>$size,'cost'=>$cost,'description'=>$description,'product_id'=>$product,'teamleader_id'=>$teamleader,'user_id'=>$this->session->userdata('id'));

         

            



       return $this->db->insert('showbooth', $data);

        
       

    }



     public function getBoothbyid($id)



   {



     



        $this->db->select('*,showbooth.id AS boothid');



        $this->db->from('showbooth');



        $this->db->join('product_cat','showbooth.product_id=product_cat.id','left');



        $this->db->where('prid=',$id);



        $query = $this->db->get();



        return $query->result_array();



   }



  public function getBoothDetailsById($id)

   {



    $this->db->select('*');



    $this->db->from('showbooth');



    $this->db->join('products','products.pid=showbooth.product_id','left');



    $this->db->join('shows','shows.id=showbooth.prid','left');



    $this->db->where('showbooth.id=',$id);



    $query = $this->db->get();



    return $query->row_array();



   }

   //Edit Booth

   public function getBoothDetails($id)

   {



    $this->db->select('*,title,showbooth.id as boothid');



    $this->db->from('showbooth');

    $this->db->join('product_cat','product_cat.id=showbooth.product_id','left');

    $this->db->where('showbooth.prid=',$id);



    $query = $this->db->get();

    //return $query->result();

    return $query->result_array();



   }



   public function editBooth($boothid,$size,$cost,$description,$product,$teamleader)

   {

        $data=array('size'=>$size,'cost'=>$cost,'description'=>$description,'product_id'=>$product,'teamleader_id'=>$teamleader);



        $this->db->set($data);



        $this->db->where('id', $boothid);



        $out = $this->db->update('showbooth');  



        return $out;

   }



   //thread task

    public function task_thread($id)

    {

        $this->db->select('*');
       $this->db->from('showtodolist');
       $this->db->where('showtodolist.sid',$id);
       $query=$this->db->get();
       return $query->result_array();


        

    }



     //Delete Milestones 

    public function deletemilestone($mid)
    {
        $this->db->select('showmilestone.*');
        $this->db->from('showmilestone');
        $this->db->where('id='.$mid);
        $query=$this->db->get();
        $milestone = $query->row();

        $this->db->where('milestone_id',$milestone->id);
        $this->db->delete('showtodolist');
    
        $title = $milestone->name.' [Milestone Deleted] ';

        $data = array('sid' => $milestone->pid, 'metakey' => 10, 'value' =>$title.  ' @' . date('Y-m-d H:i:s'));

       $this->db->insert('showmeta', $data);


        $this->db->delete('showmilestone', array('id' => $mid));

    }



    //Delete Booth

    public function deletebooth($mid)
    {


         if($this->db->delete('showbooth', array('id' => $mid)))
         {
            return true;
         }
         else
         {
            return false;
         }

    }



    //Add Metadata for shows

    public function meta_insert($prid, $meta_key, $meta_data, $value)
    {


        $data = array('sid' => $prid, 'metakey' => $meta_key, 'meatadata' => $meta_data, 'value' => $value);

        if ($prid) {

            return $this->db->insert('showmeta', $data);

        } else {

            return 0;

        }

    }



     //Get Show files

    public function p_files($id)

    {



        $this->db->select('*');

        $this->db->from('showmeta');

        $this->db->where('sid', $id);

        $this->db->where('metakey', 9);

        $query = $this->db->get();

        return $query->result_array();

    }



    //Delete file

    public function deletefile($pid, $mid)

    {



        $this->db->select('value');

        $this->db->from('showmeta');

        $this->db->where('sid', $pid);

        $this->db->where('metakey', 9);

        $this->db->where('meatadata', $mid);

        $query = $this->db->get();

        $result = $query->row_array();

        unlink(FCPATH . 'userfiles/project/' . $result['value']);

        $this->db->delete('showmeta', array('sid' => $pid, 'metakey' => 9, 'meatadata' => $mid));





    }



    //Insert Team Leader request for show.

    public function requesrtforstore($mid)  

    {

        $data=array('show_id'=>$mid,'teamleader_id'=>$this->aauth->get_user()->id,'status'=>0);

        

            $this->db->insert('show_request', $data);

             return $this->db->last_query();

    }



    //Check Team Leader for already Requested for Perticular show or not.

    public function check_teamleader_request($id)

    {

        $this->db->select('show_request.*');

        $this->db->from('show_request');

        $this->db->where('show_request.teamleader_id=',$this->aauth->get_user()->id);

        $this->db->where('show_request.show_id=',$id);

        $query = $this->db->get();



        return $query->result_array();

    }



    //Get Team Leader List for request show.

    public function req_show_list($show)

    {

        $this->db->select('*');

        $this->db->select('show_request.id AS reqid');

        $this->db->from('show_request');

        $this->db->join('employee_profile', 'show_request.teamleader_id = employee_profile.id', 'left');

        $this->db->where('show_request.show_id=',$show);

        $this->db->where('show_request.delete_flag=',0);

        $query = $this->db->get();



        return $query->result_array();



    }



    public function acceptstatusteamleader($mid)

    {

        $data = array('status' => 1);

        $this->db->set($data);

        $this->db->where('id', $mid);

        $out = $this->db->update('show_request'); 

        return $out;

    }



    public function rejectteamleader($mid)

    {

        $data = array('status' => 2);

        $this->db->set($data);

        $this->db->where('id', $mid);

        $out = $this->db->update('show_request'); 

        return $out;

    }



    //Get Total product for Due Status.

    public function getDuelist($id='')

    {

        $this->db->select('*');

        $this->db->from('showtodolist');

        $this->db->where('showtodolist.sid='.$id);

        $this->db->where('showtodolist.showtaskstatus=','Due');

        $query = $this->db->get();

        return $query->num_rows();

    }



     //Get Total product for Done Status.

    public function getDonelist($id)

    {

        $this->db->select('*');

        $this->db->from('showtodolist');

        $this->db->where('showtodolist.sid='.$id);

        $this->db->where('showtodolist.showtaskstatus=','Done');

        $query = $this->db->get();

        return $query->num_rows();

    }



    //Get Total product for Progress Status.

    public function getProgresslist($id)

    {

        $this->db->select('*');

        $this->db->from('showtodolist');

        $this->db->where('showtodolist.sid='.$id);

        $this->db->where('showtodolist.showtaskstatus=','Progress');

        $query = $this->db->get();

        return $query->num_rows();

    }



    //Get total task count

    public function gettotalTask($id)

    {

        $this->db->select('*');

        $this->db->from('showtodolist');

        $this->db->where('showtodolist.sid='.$id);

        $query = $this->db->get();

        return $query->num_rows();

    }



    //getsalespersonlist

    public function getsalespersonlist()

    {

        $this->db->select('*');

        $this->db->from('aauth_users');

        $this->db->join('employee_profile', 'aauth_users.id = employee_profile.id', 'left');

        $this->db->where('aauth_users.roleid=',2);

        $query=$this->db->get();

        return $query->result_array();



    }



    //Get Product details which has color

    public function getProductByColor($id)

    {
        $this->db->select('*, shows.show_default_warehouse AS wr');

            $this->db->from('shows');

           $this->db->join('product_warehouse', 'shows.show_default_warehouse = product_warehouse.id', 'left');

            $this->db->where('shows.id',$id);

            $id1=$this->db->get()->row()->wr;


            $this->db->select('*');

            $this->db->from('products');

            $this->db->where('products.color!=','');

            $this->db->where('products.warehouse',$id1);
             $this->db->where('products.quick_pick!=',1);
             $this->db->order_by('products.item_id');//arzoo to arrange the products in order

            $query1=$this->db->get();

            return $query1->result_array();


        //--------------------

    }


     //Get Product details which has color for salesperson details 

    public function getProductByColorsl($id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('shows','shows.show_default_warehouse=products.warehouse','left');
        $this->db->where('shows.id',$id);
        $this->db->where('products.color!=',null);
        $this->db->order_by('products.item_id');//arzoo to arrange the products in order
        $query1=$this->db->get();
        return $query1->result_array();


     

    }



    //Get Product Details which has not color

    public function getProductBynotColor($id)
    {
            $this->db->select('*, shows.show_default_warehouse AS wr');

            $this->db->from('shows');

           $this->db->join('product_warehouse', 'shows.show_default_warehouse = product_warehouse.id', 'left');

            $this->db->where('shows.id',$id);

            $id1=$this->db->get()->row()->wr;      

            $this->db->select('*');

            $this->db->from('products');
            // $this->db->join('item_details','item_details.item_id = products.item_id','inner');
            $this->db->where('products.color',null);
             $this->db->where('products.quick_pick!=',1);

            $this->db->where('products.warehouse',$id1);
            $this->db->order_by('products.item_id');//arzoo to arrange the products in order

            $query1=$this->db->get();

            return $query1->result_array();
       

    }

    //Get Product Details which has not color for salesperson
    public function getProductBynotColorsl($id)
    {
        
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('shows','shows.show_default_warehouse=products.warehouse','left');
        $this->db->where('shows.id',$id);
        $this->db->where('products.color',null);
        $this->db->order_by('products.item_id');
        $query1=$this->db->get();
        return $query1->result_array();

           

    }





    //Get Quick Pick Products

    public function getQuickPickproduct($id)
    {
        $pids = $this->getProductByColor($id);

       $this->db->select('*, shows.show_default_warehouse AS wr');

            $this->db->from('shows');

            $this->db->join('product_warehouse', 'shows.show_default_warehouse = product_warehouse.id', 'left');

            $this->db->where('shows.id',$id);

            $id1=$this->db->get()->row()->wr; 

        $this->db->select('*');

        $this->db->from('products');

        $this->db->where('products.quick_pick',1);
        $this->db->where('products.warehouse',$id1);
        

        if(!empty($pids))
        {
            $pds = array_column($pids,'pid');
             $this->db->where_not_in('products.pid',$pds);
        }
        $this->db->order_by('products.item_id');//arzoo to arrange the products in order

        
        

        $query=$this->db->get();

        return $query->result_array();



    }



    //Get Assign to team leader or Salesperson



    public function getShowAssignPersons($id)

    {
        $this->db->select('*');
        $this->db->from('shows');
        $this->db->where('shows.id',$id);
        $salesperson=$this->db->get()->row()->show_assign_to;

        // $this->db->select('*');
        // $this->db->from('showbooth');
        // $this->db->where('showbooth.prid',$id);
        // $teamleaders=$this->db->get()->result_array();
        $this->db->select('*');

        $this->db->from('show_request');

        $this->db->where('show_request.show_id',$id);

        $this->db->where('show_request.status',1);
        $this->db->where('show_request.delete_flag',0);
        $teamleaders=$this->db->get()->result_array();

        $salesperson_details=array();
        //$teamleaders_details=array();

        if($salesperson != '')
        {
              $sales_person=explode(',',$salesperson);

                foreach($sales_person as $sl)
                {
                    $this->db->select('*');
                    $this->db->from('showbooth');
                    $this->db->where('showbooth.prid',$id);
                    $this->db->join('aauth_users','aauth_users.id ='.$sl,'left');
                    $this->db->join('employee_profile','aauth_users.id=employee_profile.id','left');
                   
                     $this->db->join('product_cat','product_cat.id=showbooth.product_id','left');
                     $this->db->limit(1);
                    //$data['sldetails']=$this->db->get()->result_array();
                    $ret = $this->db->get()->result_array();
                    if(!empty($ret))
                    $alldata[]=$ret;
                    else{
                        $this->db->select('*');
                        $this->db->from('employee_profile');
                        $this->db->join('aauth_users','aauth_users.id=employee_profile.id','left');
                        $this->db->where('employee_profile.id',$sl);
                        $ret = $this->db->get()->result_array();
                        $alldata[]=$ret;
                    }
                    
                }
        }

        if(!empty($teamleaders))
        {
            foreach($teamleaders as $tl)
            {
                if($tl['teamleader_id'] != null)
                {

                    $teamleader_person=explode(',',$tl['teamleader_id']);

                    // if(!empty($teamleader_person))
                    // {
                    //     foreach($teamleader_person as $tl1)
                    //     {
                            $this->db->select('*');
                            $this->db->from('showbooth');
                            $this->db->where('showbooth.teamleader_id',$tl['teamleader_id']);
                            $this->db->where('showbooth.prid',$id);
                            $this->db->join('aauth_users','aauth_users.id ='.$tl['teamleader_id'],'left');
                            $this->db->join('employee_profile','aauth_users.id=employee_profile.id','left');
                             $this->db->join('product_cat','product_cat.id=showbooth.product_id','left');
                           // $data['tldetails'][]=$this->db->get()->result_array();

                           // $alldata[]=$this->db->get()->result_array();
                           $ret = $this->db->get()->result_array();
                           if(!empty($ret))
                           $alldata[]=$ret;
                           else{
                               $this->db->select('*');
                               $this->db->from('employee_profile');
                               $this->db->join('aauth_users','aauth_users.id=employee_profile.id','left');
                               $this->db->where('employee_profile.id',$tl['teamleader_id']);
                               $ret = $this->db->get()->result_array();
                               $alldata[]=$ret;
                           }
                    //     }
                    // }  
                }
                
            }
        }

        return $alldata;
    }

    //deleteshow
    public function delete_show($id)
    {
          $this->db->where('prid='.$id);
          $this->db->delete('showbooth');

          $this->db->where('sid='.$id);
          $this->db->delete('showmeta');

          $this->db->where('pid='.$id);
          $this->db->delete('showmilestone');

          $this->db->where('sid='.$id);
          $this->db->delete('showtodolist');

          $this->db->where('show_id='.$id);
          $this->db->delete('show_request');

          $this->db->where('id='.$id);
          if($this->db->delete('shows'))
          {
               return 1;
          }
          else
          {
            return 0;
          }


    }

    //Get All Salesperson 

    public function getSalesperson()
    {
       $this->db->select('employee_profile.*,aauth_users.banned,aauth_users.roleid');

        $this->db->from('employee_profile');

        $this->db->join('aauth_users', 'employee_profile.id = aauth_users.id', 'left');

        $this->db->order_by('aauth_users.roleid', 'DESC');

        $this->db->where('aauth_users.roleid=',2);

        $query = $this->db->get();

        return $query->result_array();
    }

    //Get Salesperson for edit show

    public function getshowsalespersononly($id)
    {
       
        $this->db->select('*');
        $this->db->from('shows');
        $this->db->where('shows.id',$id);
        $query=$this->db->get()->row();

        $salesperson_id=$query->show_assign_to;

      
        return $salesperson_id;
    }

    //Get Approved Team leader Details

    public function getApprovedTeamLeaderForSale($id)
    {
       $this->db->select('show_request.*,employee_profile.*');
       $this->db->from('show_request');
       $this->db->join('employee_profile', 'show_request.teamleader_id = employee_profile.id', 'left');
       $this->db->where('show_request.status',1);
       $this->db->where('show_request.show_id',$id);

        $query = $this->db->get();

        return $query->result_array();
    } 


    //Display All Teamleaders
    public function getAllteamleader($id)
    {
        $this->db->select('*');
        $this->db->from('aauth_users');
        $this->db->where('aauth_users.roleid',3);
        $this->db->join('employee_profile','employee_profile.id=aauth_users.id');
        $query = $this->db->get();
        return $query->result_array();


    }


    //Check TeamLeader Approved or not for access all tabs

    public function checkTLApprovedorNot($id)
    {
        $this->db->select('*');
        $this->db->from('show_request');
        $this->db->where('teamleader_id',$this->session->userdata('id'));
        $this->db->where('show_request.status',1);
        $this->db->where('show_id',$id);
        $query = $this->db->get();
        return $query->result_array();

    }

    //Get Show Start Date and Show End Date 

    public function getShowDate($id)
    {
         $this->db->select('shows.show_start_date,shows.show_end_date');
         $this->db->from('shows');
         $this->db->where('shows.id',$id);
         $query = $this->db->get();
         return $query->result_array();
    }

    //Get Salesperson for SetDateTime 

    public function getSalesPersonByShowAssignedOnly($id)
    {
        $id= 44;
        $this->db->select('shows.*');
        $this->db->from('shows');
        $this->db->where("shows.id=".$id);
        $query=$this->db->get();



        $teamLeaderDeatils=$query->result_array();
        $details=array();

        foreach($teamLeaderDeatils as $tl)
        {
            $person = array();

            $person=explode(',',$tl['show_assign_to']);

            foreach($person as $p1){

                $this->db->select('employee_profile.*');
                $this->db->from('employee_profile');
                $this->db->where('employee_profile.id=',$p1);
            
                $query1=$this->db->get();

                $details[]=$query1->result_array();


            }
        }

        return $details;

    }

    //Add Details of set break time
    public function setbreaktime($date,$startworkingtime,$endworkingtime,$salesperson,$show_id,$assign_by)
    {

        $data=array('date'=>datefordatabase($date),'start_working_time'=>$startworkingtime,'end_working_time'=>$endworkingtime,'salesperson'=>$salesperson,'show_id'=>$show_id,'assign_by'=>$assign_by);

        $check=$this->checkDataforshowbreaktime($show_id,$salesperson,datefordatabase($date));


        if(!empty($check))
        {
           foreach($check as $d1)
            {
                if($d1['date'].' 00:00:00'==datefordatabase($date) AND $d1['show_id']==$show_id AND $d1['salesperson']==$salesperson)
               {
                   
                  
                          $this->db->set($data);

                         $this->db->where('id', $d1['id']); 

                    $this->db->update('show_break_times');
                }
                 else{
                     $this->db->insert('show_break_times',$data);
               }
            
            } 

           
        }
        else
        {
              $this->db->insert('show_break_times',$data);
        }


        


        return 1;
    }

    //add break time for salesperson 
    public function addbreaktime($lastid,$sbrk,$ebrk,$salesperson_id,$show_id)
    {

        if($sbrk==':00')
        {
            $sbrk=null;
        }
        if($ebrk==':00')
        {
            $ebrk=null;
        }
        $data=array('start_break_time'=>$sbrk,'end_break_time'=>$ebrk,'detail_id'=>$lastid,'salesperson_id'=>$salesperson_id,'show_id'=>$show_id);

     

          $this->db->insert('breaktimesforshow',$data);

         
    }


    //---------------------------------Inventory--------------------------------------------

    //add reqest packing list by team leader
     public function addpackinglistrequest1($product_id,$requested_qty,$approved_qty,$show_id)
    {
       
        $data=array('product_id'=>(int)$product_id,'product_request_qty'=>(int)$requested_qty,'product_approve_qty'=>(int)$approved_qty,'product_requested_by'=>(int)$this->aauth->get_user()->id,'show_id'=>(int)$show_id,'status'=>0,'product_requested_at'=>date('Y-m-d H:i:s'));

        $this->db->insert('packinglist_request_show',$data);

        return true;
    }

 //add reqest packing list by sales person to teamleader
    public function addpackinglistrequest1sl($product_id,$requested_qty,$approved_qty,$show_id,$teamleader)
    {
       
       
        $data=array('product_id'=>(int)$product_id,'product_request_qty'=>(int)$requested_qty,'product_approve_qty'=>(int)$approved_qty,'product_requested_by'=>(int)$this->aauth->get_user()->id,'show_id'=>(int)$show_id,'status'=>0,'product_requested_at'=>date('Y-m-d H:i:s'),'product_requested_to'=>$teamleader);

        $this->db->insert('salesperson_request',$data);

        return true;
    }


    //get sales person request list 

    public function salespersonrequestlist($id)
    {
        $this->db->select('*');
        $this->db->from('salesperson_request');
        $this->db->where('salesperson_request.product_requested_by',$this->aauth->get_user()->id);
        $this->db->join('products', 'products.pid = salesperson_request.product_id', 'left');
        $this->db->where('salesperson_request.show_id',$id);
         $query = $this->db->get();

        return $query->result();

    }

    //get salesperosn for show salesperson breaktime list
     public function getsalespersonfrombreaktime($id)
        {
            $this->db->select('*');
            $this->db->from('show_break_times');
            $this->db->where('show_break_times.show_id',$id);
            $this->db->group_by('show_break_times.salesperson');
            $query=$this->db->get();
            return $query->result_array();
        }




    //get data for display packing list request for business owner 

    public function gettlrequestforpackinglist($show_id)
    {
        $this->db->select('packinglist_request_show.*,products.*,employee_profile.name AS empname');
        $this->db->from('packinglist_request_show');
        $this->db->join('products', 'products.pid = packinglist_request_show.product_id', 'left');
        $this->db->join('employee_profile','employee_profile.id=packinglist_request_show.product_requested_by','left');
         $this->db->where('packinglist_request_show.show_id',$show_id);
         $this->db->where('packinglist_request_show.status ',0);
         $this->db->order_by('products.item_id');
         $this->db->order_by('packinglist_request_show.id', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    //approve product reqest packing list for team leader 

    public function approveproductfortl($mid,$approved_qty)
    {


        $data=array(
            'status'=>1,
            'product_approve_qty'=>$approved_qty,
            'product_approved_by'=>$this->aauth->get_user()->id,
            'product_approved_at'=>date('Y-m-d H:i:s'),
            'product_confirm_at'=>NULL
        );

        $this->db->set($data);

        $this->db->where('id', $mid);

       

        return $this->db->update('packinglist_request_show');  
    }

      //get data for packing list confirmation for tl [ confirm Reciept - Packing List tab  ]

    public function confirmRecieptPackingList($show_id)
    {
         $this->db->select('packinglist_request_show.id AS packinglist_id,packinglist_request_show.*,products.*,employee_profile.id');

        $this->db->from('packinglist_request_show');
        $this->db->join('products', 'products.pid = packinglist_request_show.product_id', 'left');
         $this->db->where('packinglist_request_show.product_requested_by',$this->aauth->get_user()->id);
        $this->db->join('employee_profile','employee_profile.id=packinglist_request_show.product_requested_by','left');
         $this->db->where('packinglist_request_show.show_id',$show_id);
         $this->db->where('packinglist_request_show.status',1);
        
        //  $this->db->order_by('packinglist_request_show.id', 'ASC');
         $this->db->order_by('products.item_id', 'ASC');

        $query = $this->db->get();

        return $query->result();
    }

    //confirm reciept by TL
    public function confirmrecieptbytl($mid)
    {


        $this->db->select('packinglist_request_show.*');
        $this->db->from('packinglist_request_show');
        $this->db->where('packinglist_request_show.id',$mid);

        //decrease confirm qty

        $query=$this->db->get();


        $product_id=$query->row();

        $pid= $product_id->product_id;

        $approveqty=$product_id->product_approve_qty;


        $this->db->set('qty','qty - '.(int)$approveqty,FALSE);

        $this->db->where('pid',$pid);

        $this->db->update('products');


        //add data into Team Leader warehouse

        $this->db->select('*');
        $this->db->from('product_warehouse');
        $this->db->where('user_id',$this->aauth->get_user()->id);
        $warehouse_id=$this->db->get()->row()->id;


        $this->db->select('*');
        $this->db->from('teamleader_products');
        $this->db->where('product_id',$pid);
        $this->db->where('teamleader_id',$this->aauth->get_user()->id);
        $this->db->where('warehouse_id',$warehouse_id);

        $updateid=$this->db->get()->row()->id;
     
        if($updateid != '')
        {
            $this->db->select('*');
            $this->db->from('teamleader_products');
            $this->db->where('id',$updateid);
            $q1=$this->db->get()->row()->total_qty;

            $qtys=array($q1,$approveqty);

            $totalquantity=array_sum($qtys);

            $data=array('total_qty'=>$totalquantity);
            $this->db->set($data);
            $this->db->where('id',$updateid);
            $this->db->update('teamleader_products');
        }
        else
        {
            $data=array('product_id' =>$pid,'teamleader_id'=>$this->aauth->get_user()->id,'total_qty'=>$approveqty,'warehouse_id'=>$warehouse_id );

            $this->db->insert('teamleader_products',$data);
        }

        //change status of request
        $data=array('status'=>2,'product_confirm_at'=>date('Y-m-d H:i:s'));

        $this->db->set($data);

        $this->db->where('id', $mid);

       $this->db->update('packinglist_request_show');

       return true;
      
    }

    //get data of requesr for business owner side history
    public function requesthistorybo($show_id)
    {
        $this->db->select('*');
        $this->db->from('packinglist_request_show');
        $this->db->where('show_id',$show_id);
        $this->db->group_by('product_requested_at');
        $query=$this->db->get();

        return $query->result();


    }


    //get history data for modal BO side

        public function gethistorydataformodal($requestdate,$show_id)
        {
            $this->db->select('*');
            $this->db->from('packinglist_request_show');
            $this->db->join('products', 'products.pid = packinglist_request_show.product_id', 'left');
            $this->db->where('packinglist_request_show.product_requested_at',$requestdate);
            $this->db->where('packinglist_request_show.show_id',$show_id);

            $query=$this->db->get();

            return $query->result();
        }

         //get data for team leader side history tab 

        public function requesthistorytl($show_id)
        {
            $this->db->select('*');
            $this->db->from('packinglist_request_show');
            $this->db->where('show_id',$show_id);
            $this->db->where('product_requested_by',$this->aauth->get_user()->id);
            $this->db->group_by('product_requested_at');
            $query=$this->db->get();

        return $query->result();
        
        }

        //get history data for modal for team leader

        public function gethistorydataformodaltl($requestdate,$show_id)
        {
            $this->db->select('*');
            $this->db->from('packinglist_request_show');
            $this->db->join('products', 'products.pid = packinglist_request_show.product_id', 'left');
            $this->db->where('packinglist_request_show.product_requested_at',$requestdate);
            $this->db->where('packinglist_request_show.show_id',$show_id);
            $this->db->where('packinglist_request_show.product_requested_by',$this->aauth->get_user()->id);

            $query=$this->db->get();

            return $query->result();
        }

        //get sales person requision list ofr tl
       public function getSalespersonRequisitonListforTL($id)
            {
                $this->db->select('*,salesperson_request.id AS request_id');
                $this->db->from('salesperson_request');
                $this->db->where('salesperson_request.show_id',$id);
                $this->db->where('salesperson_request.product_requested_to',$this->aauth->get_user()->id);
                $this->db->where('salesperson_request.status',0);
                 $this->db->join('employee_profile','employee_profile.id=salesperson_request.product_requested_by','left');
                 $this->db->join('products','salesperson_request.product_id=products.pid','left');
                $this->db->order_by('products.item_id');
                

                 $query=$this->db->get();

                return $query->result();

            }

             public function checkproductinteamleader($product_id,$requested_qty,$teamleader)
        {
            $this->db->select('*');
            $this->db->from('teamleader_products');
            $this->db->where('teamleader_products.product_id',$product_id);
            $this->db->where('teamleader_products.teamleader_id',$teamleader);
            $this->db->where('teamleader_products.total_qty >= ',$requested_qty);
            $query=$this->db->get();
            return $query->result_array();

        }

        //Aprrove Request by team leader for sales person

        public function approveproductforsl($mid,$approved_qty)
    {


        $data=array(
            'status'=>1,
            'product_approve_qty'=>$approved_qty,
            'product_approved_by'=>$this->aauth->get_user()->id,
            'product_approved_at'=>date('Y-m-d H:i:s'),
            'product_confirm_at'=>NULL
        );

        $this->db->set($data);

        $this->db->where('id', $mid);

       

        return $this->db->update('salesperson_request');  
    }

     //get data for packing list confirmation for sl [ confirm Reciept - Requisiton List tab  ]

    public function confirmRecieptSl($show_id)
    {

        $this->db->select('*,salesperson_request.id AS packinglist_id');
        $this->db->from('salesperson_request');
        $this->db->where('salesperson_request.product_requested_by',$this->aauth->get_user()->id);
        $this->db->where('salesperson_request.show_id',$show_id);
         $this->db->where('salesperson_request.status',1);
        $this->db->join('products', 'products.pid = salesperson_request.product_id', 'left');
        $this->db->join('employee_profile','employee_profile.id='.$this->aauth->get_user()->id,'left');
        $this->db->order_by('salesperson_request.id', 'ASC');

        $query = $this->db->get();

        return $query->result();
    }


    //confirm reciept by SL
    public function confirmrecieptbysl($mid)
    {

        $this->db->select('salesperson_request.*');
        $this->db->from('salesperson_request');
        $this->db->where('salesperson_request.id',$mid);

        //decrease confirm qty

        $query=$this->db->get();

        $product_id=$query->row();

        $pid= $product_id->product_id;

        $approveqty=$product_id->product_approve_qty;

        $this->db->set('total_qty','total_qty - '.(int)$approveqty,FALSE);

        $this->db->where('product_id',$pid);

        $this->db->update('teamleader_products');


        //change status of request
        $data=array('status'=>2,'product_confirm_at'=>date('Y-m-d H:i:s'));

        $this->db->set($data);

        $this->db->where('id', $mid);

       $this->db->update('salesperson_request');

       return true;
      
    }

     //Get Product details which has color for salesperson details 

    public function getProductByColorbytl($id)
    {
        $this->db->select('*');
        $this->db->from('showbooth');
        $this->db->join('product_cat','showbooth.product_id=product_cat.id','left');
        $this->db->join('item_details', 'item_details.product_category = product_cat.id', 'left');
        $this->db->join('products', 'products.item_id = item_details.item_id', 'left');
        $this->db->join('employee_profile','employee_profile.id=showbooth.teamleader_id');
        $this->db->where('showbooth.prid',$id);
        $this->db->where('products.color!=','');
        $this->db->where('showbooth.teamleader_id',$this->aauth->get_user()->id);
         $query1=$this->db->get();
          return $query1->result_array(); 

    }

 //Get Product Details which has not color for salesperson
    public function getProductBynotColorbytl($id)
    {
        $this->db->select('*');
        $this->db->from('showbooth');
         $this->db->join('product_cat','showbooth.product_id=product_cat.id','left');
        $this->db->join('item_details', 'item_details.product_category = product_cat.id', 'left');
        $this->db->join('products', 'products.item_id = item_details.item_id', 'left');
        $this->db->join('employee_profile','employee_profile.id=showbooth.teamleader_id');
        $this->db->where('showbooth.prid',$id);
         $this->db->where('showbooth.teamleader_id',$this->aauth->get_user()->id);
        $this->db->where('products.color',null);

         $query1=$this->db->get();
          return $query1->result_array();

           

    }

    //getTeamleaderforstocktransfer

    public function getTeamLeader($show_id)
    {

        $this->db->select('*');
        $this->db->from('showbooth');
        $this->db->where('teamleader_id is NOT NULL', NULL, FALSE);
        $booth_details = $this->db->where('showbooth.prid',$show_id);
        $booth_details =  $this->db->get()->result_array();
       
        $person = array();
        foreach ($booth_details as $key => $value) 
        {
            if($value['teamleader_id']!=='')
            {
                
                $person1 = explode(',',$value['teamleader_id']);
                $person = array_merge($person, $person1);
            }
            
        }
             
        $this->db->select('*','employee_profile.id AS eid');
        $this->db->from('employee_profile');
        $this->db->where('employee_profile.id!=',$this->aauth->get_user()->id);//This is currenmty team lead who login
        $this->db->where_in('id', $person);
        $tl_details =  $this->db->get()->result_array();

        return $tl_details;

    }


    //transfer all stock to teamleader

    public function transferallstock($show_id,$transferteamleader)
    {
        $this->db->select('*');
        $this->db->from('product_warehouse');
        $product_warehouse = $this->db->get()->result_array();
       
        $ware_details = array();
        foreach ($product_warehouse as $key => $value) 
        {
            $ware_details[$value['user_id']] = $value['id'];
        }
       
        
        //fetch prodct data from team leader
        $this->db->select('teamleader_products.*,show_request.status as request_status,show_request.delete_flag');
        $this->db->from('teamleader_products');
        $this->db->join('show_request', 'show_request.teamleader_id = teamleader_products.teamleader_id', 'left');
        $this->db->where('teamleader_products.teamleader_id',$this->aauth->get_user()->id);
        $this->db->where('show_request.delete_flag!=',1);
        $this->db->where('show_request.status=',1);
        $this->db->where('show_request.show_id',$show_id);
 
        
        $data=$this->db->get()->result_array();

        $qty_check = array_column($data,'total_qty');
        if(in_array('0', $qty_check))
        {
            return false;
        }

      
        $transfer_history_arrray = array();
        $team_leader_array = array();
        if(!empty($data))
        {
            
            foreach($data as $key=>$value)
            {
               

                $update_teamleader[$key]['id'] = $value['id'];
                $update_teamleader[$key]['status'] = 1;
                $update_teamleader[$key]['total_qty'] = 0;


                $transfer_history_arrray[$key]['product_id'] = $value['product_id'];
                $transfer_history_arrray[$key]['teamleader_transfer_id'] = $value['teamleader_id'];
                $transfer_history_arrray[$key]['teamleader_accept_id'] = $transferteamleader;
                $transfer_history_arrray[$key]['qty'] = $value['total_qty'];
                $transfer_history_arrray[$key]['product_id'] = $value['product_id'];
                $transfer_history_arrray[$key]['show_id'] = $show_id;
                $transfer_history_arrray[$key]['created_at'] = date("Y-m-d H:i:s");
                
            }
            if(!empty($transfer_history_arrray))
            {
             
                $this->db->insert_batch('stock_transfer_history',$transfer_history_arrray);
              
                $this->db->update_batch('teamleader_products',$update_teamleader, 'id'); 
                  
            }

            return true;
            
        }


    }

    //Get Recieved Stock Details
    public function getreceivedstockdetails($id,$teamleadertransferid)
    {
        $this->db->select('*');
        $this->db->from('stock_transfer_history');
        $this->db->where('stock_transfer_history.teamleader_accept_id',$this->aauth->get_user()->id);
        $this->db->where('stock_transfer_history.status',0);
        $this->db->where('stock_transfer_history.show_id',$id);
        $this->db->join('products','stock_transfer_history.product_id=products.pid');
        $this->db->where('stock_transfer_history.teamleader_transfer_id',$teamleadertransferid);
        $this->db->where('products.color!=',null);

        $query=$this->db->get();

        $data['productwithcolor']=$query->result_array();

        $this->db->select('*');
        $this->db->from('stock_transfer_history');
        $this->db->where('stock_transfer_history.teamleader_accept_id',$this->aauth->get_user()->id);
        $this->db->where('stock_transfer_history.status',0);
        $this->db->where('stock_transfer_history.show_id',$id);
        $this->db->join('products','stock_transfer_history.product_id=products.pid');
        $this->db->where('stock_transfer_history.teamleader_transfer_id',$teamleadertransferid);
        $this->db->where('products.color=',null);

        $query1=$this->db->get();

         $data['productwithnotcolor']=$query1->result_array();

         return $data;


    }




//get stock transfer list for history 

       
        public function stock_list()
        {

           $this->db->select('*');
           $this->db->from('employee_profile');
           $query_emp=$this->db->get()->result_array();
          
           $emp_details = array();
           foreach ($query_emp as $key => $value) 
           {
               $emp_details[$value['id']] = $value['name']; 
           }
           
           $this->db->select('*,stock_transfer_history.qty AS qt');
           $this->db->from('stock_transfer_history');

           $this->db->where("(teamleader_transfer_id='".$this->aauth->get_user()->id."' OR teamleader_accept_id='".$this->aauth->get_user()->id."')", NULL, FALSE);
           $this->db->join('products','products.pid=stock_transfer_history.product_id');
           $this->db->join('employee_profile','employee_profile.id=stock_transfer_history.teamleader_accept_id');
            $query=$this->db->get()->result_array();

            foreach ($query as $key => $value) 
            {
                $query[$key]['teamleader_transfer'] = $emp_details[ $value['teamleader_transfer_id']];
                $query[$key]['teamleader_accept'] = $emp_details[ $value['teamleader_accept_id']];
            }
       
            return $query;
        }


        //Get Product Which has color available
        public function getcolorproductstock($id)
        {
            $this->db->select('*');
            $this->db->from('teamleader_products');
            $this->db->join('products','products.pid=teamleader_products.product_id');
            $this->db->where('teamleader_products.teamleader_id',$this->aauth->get_user()->id);
            $this->db->where('products.color!=',null);
            $this->db->where('teamleader_products.total_qty!=',0);
            $this->db->order_by('products.item_id');
            $query=$this->db->get();

            return $query->result_array();

        }

        //Get Products which has not color available
        public function getnotcolorproductstock($id)
        {
            $this->db->select('*');
            $this->db->from('teamleader_products');
            $this->db->join('products','products.pid=teamleader_products.product_id');
            $this->db->where('teamleader_products.teamleader_id',$this->aauth->get_user()->id);
            $this->db->where('products.color=',null);
            $this->db->where('teamleader_products.total_qty!=',0);
            $this->db->order_by('products.item_id');
            $query=$this->db->get();

            return $query->result_array();

        }

        //Delete Teamleader for show 
        public function delete_tl_show($request_id = '',$show_id)
        {

            $this->db->select('*');
            $this->db->from('show_request');
            $this->db->where('id',$request_id);
            $teamleader_id=$this->db->get()->row()->teamleader_id;

            $array=array('sid'=>$show_id,
                'showtaskeid'=>$teamleader_id
            );

           $this->db->where($array);
           $this->db->delete('showtodolist');

            $this->db->where('id',$request_id);
            $this->db->delete('show_request');
 
            
            return 1;



        }

        //Confirm Transfer Stock Details
        public function confirmtransferstock($show_id = '',$tl='')
        {

            $this->db->select('stock_transfer_history.*,products.product_name,products.color,products.quick_pick');
            $this->db->from('stock_transfer_history');
            $this->db->join('products', 'products.pid = stock_transfer_history.product_id');
            $this->db->where('stock_transfer_history.teamleader_accept_id',$this->aauth->get_user()->id);
            $this->db->where('stock_transfer_history.teamleader_transfer_id',$tl);
            $this->db->where('stock_transfer_history.status=',0);
            $this->db->order_by('stock_transfer_history.created_at');
            $this->db->where('stock_transfer_history.show_id',$show_id);


            $data = $this->db->get()->result_array();
            $all_values = array();
            foreach ($data as $key => $value) 
            {
                $all_values[$value['created_at']][] = $value;
            }
           
            return $all_values;
        }

        //Get Details for Confirm transfer stock
        public function confirmedtransferstock($id = '', $date = '',$tl_id = '')
        {
           
            $this->db->select('stock_transfer_history');
            $this->db->from('stock_transfer_history');
            $this->db->where('stock_transfer_history.teamleader_accept_id',$this->aauth->get_user()->id);
            $this->db->where('stock_transfer_history.status=',0);
            $this->db->where('stock_transfer_history.show_id',$show_id);
            $this->db->where('stock_transfer_history.created_at',$date);
            $data = $this->db->get()->result_array();
            foreach ($data as $key => $value) 
            {
                
            }
            return $data;
        }

        //Get Team Leader list for product request for salesperson
        public function teamleaderlistforproductrequestsl($id)
        {
            $this->db->select('*,employee_profile.id AS tlid');
            $this->db->from('show_request');
            $this->db->where('show_request.show_id',$id);
            $this->db->where('show_request.status',1);
            $this->db->join('employee_profile','show_request.teamleader_id=employee_profile.id','left');
            $query=$this->db->get();

            return $query->result_array();
        }

        //Check Products for teamleader
        public function checkteamleaderproduct($product_id,$product_transfer_qty)
        {

            $checkqty=0;
            $this->db->select('*');
            $this->db->from('teamleader_products');
            $this->db->where('teamleader_products.product_id',$product_id);
            $this->db->where('teamleader_products.teamleader_id',$this->aauth->get_user()->id);
            $this->db->where('teamleader_products.total_qty >= ',$product_transfer_qty);
            $query=$this->db->get();

           return $query->result_array();


        }

        //Save Stock Transfer Request
        public function savetransferstockrequest($product_id,$teamleader_transfer_id,$teamleader_accept_id,$qty,$status,$created_at,$show_id,$transfertype)
        {
            $data=array(
                'product_id'=>$product_id,
                'teamleader_transfer_id'=>$teamleader_transfer_id,
                'teamleader_accept_id'=>$teamleader_accept_id,
                'qty'=>$qty,
                'status'=>$status,
                'created_at'=>$created_at,
                'show_id'=>$show_id,
                'transfertype'=>$transfertype,
            );

           $this->db->insert('stock_transfer_history',$data);

        }

        //Transfer stock for teamleader
        public function transferstock($id)
        {

          
            $this->db->select('*');
            $this->db->from('stock_transfer_history');
            $this->db->where('stock_transfer_history.id',$id);
            $query=$this->db->get()->row();

            $d1=$query->created_at;


          $this->db->select('*');
          $this->db->from('stock_transfer_history');
          $this->db->where('stock_transfer_history.created_at',$d1);
            $query=$this->db->get();

            $data= $query->result_array();

          

            foreach($data as $d)
            {

                $status=array('status'=>1);

                $this->db->set($status);
                $this->db->where('id', $d['id']);
                $this->db->update('stock_transfer_history'); 

                $this->db->select('*');
                $this->db->from('teamleader_products');
                $this->db->where('teamleader_products.teamleader_id',$this->aauth->get_user()->id);
                $this->db->where('product_id',$d['product_id']);

                $q1=$this->db->get()->row();

                if($q1 == null || empty($q1))
                {
                    $this->db->select('*');
                    $this->db->from('product_warehouse');
                    $this->db->where('product_warehouse.user_id',$this->aauth->get_user()->id);
                    $warehouse_id=$this->db->get()->row();

                    $insertdata=array(
                        'product_id'=>$d['product_id'],
                        'warehouse_id'=>$warehouse_id->id,
                        'teamleader_id'=>$this->aauth->get_user()->id,
                        'total_qty'=>$d['qty']
                    );

                      $this->db->insert('teamleader_products', $insertdata);

                }
                else
                {
                    $updateid=$q1->id;
                    $qty = $d['qty'];

                    $sql = "UPDATE `teamleader_products` SET `total_qty` = total_qty + ".$qty." WHERE `id` = '".$updateid."' ";

                    $this->db->query($sql);

                }

                $decreaseproductid=$d['teamleader_transfer_id'];

                $this->db->select('*');
                $this->db->from('teamleader_products');
                $this->db->where('teamleader_products.teamleader_id',$decreaseproductid);
                $this->db->where('teamleader_products.product_id',$d['product_id']);
                $decid=$this->db->get()->row();

                $this->db->set('total_qty','total_qty - '.(int)$d['qty']);
                $this->db->where('id',$decid->id);
                $this->db->update('teamleader_products');
                
         
           }

           
        } 

        //Get Woring time details
        public function getworkingtimedetails($id,$salesperson_id)
        {
            $this->db->select('*');
            $this->db->from('show_break_times');
            $this->db->where('show_break_times.salesperson',$salesperson_id);
            $this->db->where('show_break_times.show_id',$id);
            //$this->db->join('breaktimesforshow','breaktimesforshow,detail_id=show_break_times.id');
           // $this->db->group_by('show_break_times.id','left');


            $query=$this->db->get();

            return $query->result_array();

        }

        //Get Milestone details by milestone id
        public function getmilestones($mid)
        {
            $this->db->select('*');
            $this->db->from('showmilestone');
            $this->db->where('id',$mid);
            $this->db->join('products','products.pid=showmilestone.pid','left');
            return $this->db->get()->row();
        }

        //Edit Milestone
        public function editmilestone($show_id,$id,$title,$color,$start_date,$end_date,$des)
        {
            $array=array(
                'pid'=>$show_id,
                'name'=>$title,
                'sdate'=>$start_date,
                'edate'=>$end_date,
                'exp'=>$des,
                'color'=>$color

            );


            $this->db->set($array);
            $this->db->where('id',$id);
           if($this->db->update('showmilestone'))
           {
            return true;
           }
           else
           {
            return false;
           }

        }

        //Get Milestone Date
        public function getmilestonedate($id)
        {
            $this->db->select('*');
            $this->db->from('showmilestone');
            $this->db->where('id',$id);
            return $this->db->get()->row();
        }

        //Get Task Details for display in edit task.
        public function viewtask($id)
        {
            $this->db->select('*');
            $this->db->from('showtodolist');
            $this->db->where('id',$id);

            return $this->db->get()->row();
        }

        //Get Working Time details is availabel for show or not.
        public function checkDataforshowbreaktime($show_id,$salesperson,$date)
        {
            if($salesperson=='')
            {
                $salesperson=0;
            }
            $this->db->select('*');
            $this->db->from('show_break_times');
            $this->db->where('show_id',$show_id);
            $this->db->where('salesperson',$salesperson);
            $this->db->where('date',$date);
            return $this->db->get()->result_array();
        }


         //Get all kilestone's date for vallidate ADD milestone start date and end date
        public function getmilestonesdateforcheck($show_id)
        {
           
            $this->db->select('*');
            $this->db->from('showmilestone');
            $this->db->where('pid',$show_id);

            return $this->db->get()->result_array();

          
        }

        //Get all kilestone's date for vallidate edit milestone start date and end date
        public function getmilestonesdateforcheckedit($show_id,$mile_id)
        {
            $this->db->select('*');
            $this->db->from('showmilestone');
            $this->db->where('pid',$show_id);
            $this->db->where('id !=',$mile_id);

            return $this->db->get()->result_array();
        }

        //Get Show Working time for display in working display on set working time page
        public function getshowworkingtime($show_id,$show_start_work_date,$show_end_work_date,$salesperson)
        {
            $this->db->select('*');
            $this->db->from('show_break_times');
            $this->db->where('date >=',$show_start_work_date);
            $this->db->where('date <=',$show_end_work_date);
            $this->db->where('salesperson',$salesperson);
            $this->db->where('show_id',$show_id);
            $data= $this->db->get()->result_array();

            if(empty($data))
            {
                $this->db->select('*');
                $this->db->from('show_break_times');
                $this->db->where('date >=',$show_start_work_date);
                $this->db->where('date <=',$show_end_work_date);
                $this->db->where('salesperson',0);
                $this->db->where('show_id',$show_id);
                $data= $this->db->get()->result_array();
            }

            return $data;
        }

        //Get Break time details for display.
        public function getbreaktimedetailsfrodisplay($show_id,$sl_id)
        {
            $this->db->select('*');
            $this->db->from('breaktimesforshow');
            $this->db->where('breaktimesforshow.salesperson_id',$sl_id);
            $this->db->where('breaktimesforshow.show_id',$show_id);

            return $this->db->get()->result_array();
        }


        //Delete Break time for save update Break time details
        public function deletebreaktime($detail_id,$salesperson_id,$show_id)
        {
             $array=array('detail_id'=>$detail_id,
                'salesperson_id'=>$salesperson_id,
                'show_id'=>$show_id
            );

           $this->db->where($array);
           $this->db->delete('breaktimesforshow');
        }

        //Delete Break Time Details Based on selected Salesperson.
        public function deletebreaktimefromtable($show_id,$salesperson_id)
        {
           $array=array(
                'salesperson_id'=>$salesperson_id,
                'show_id'=>$show_id
            );

           $this->db->where($array);
           $this->db->delete('breaktimesforshow'); 

        }


         //get all products category
    public function get_product_cat()
    {
        $this->db->select('*');
        $this->db->from('product_cat');
        return $this->db->get()->result_array();
    }
     //get all allocated locations-arzoo
     public function getAllLocations(){
        $this->db->select('location_id');
        $this->db->from('shows');
        $this->db->where_not_in('location_id',"");
        $query = $this->db->get();
        $data = array();
        foreach ($query->result() as $row) {
            array_push($data,$row->location_id);
        }
        return $data;
     }  
     //get all get tokens based on id -arzoo
     public function getTokens($id){
        $tokens = array();
        $this->db->select('device_token');
        $this->db->from('aauth_users');
        $this->db->where_in('id',$id);
        $ret =  $this->db->get()->result();
        foreach ($ret as $row) {
            array_push($tokens, $row->device_token);
        }

        return $tokens;
     }
     //get all owners tokens - arzoo
     public function retriveOwnersToken(){
        $tokens = array();
        $this->db->select('device_token');
        $this->db->from('aauth_users');
        $this->db->where_in('roleid','5');
        $ret =  $this->db->get()->result();
        foreach ($ret as $row) {
            array_push($tokens, $row->device_token);
        }
        return $tokens;
        
     }

//get all TL tokens - arzoo
public function retriveTeamLeaderToken($show_id){
    $tokens = array();
        $this->db->select('device_token');
        $this->db->from('aauth_users'); 
        $this->db->join('show_request','show_request.teamleader_id=aauth_users.id');
        $this->db->where_in('aauth_users.roleid','3');
        $this->db->where('show_request.show_id',$show_id);
        $this->db->where('show_request.status','1');
        $this->db->where('show_request.delete_flag','0');
        $ret =  $this->db->get()->result();
        foreach ($ret as $row) {
            array_push($tokens, $row->device_token);
        }
        return $tokens;
 }

     //get Request for show msg for owner - arzoo
     public function getMessageToOwner($id){
         $msg = "";
        $this->db->select('show_name');
        $this->db->from('shows');
        $this->db->where_in('id',$id);
        $ret = $this->db->get()->result();
        foreach ($ret as $row) {
            $msg =  $row->show_name . ' show requested by  ';
        }
        $this->db->select('name');
        $this->db->from('employee_profile');
        $this->db->where_in('id',$this->aauth->get_user()->id);
        $ret = $this->db->get()->result();
        foreach ($ret as $row) {
            $msg =  $msg.' '.$row->name;
        }
        return $msg;
    }


    //get Request inventory for show msg for TL - arzoo
    public function getMessageRequestInventory($show_id,$product_name){
        $msg = "";
       $this->db->select('show_name');
       $this->db->from('shows');
       $this->db->where_in('id',$show_id);
       $ret = $this->db->get()->result();
       foreach ($ret as $row) {
           $msg = ' for '.$row->show_name.' ,Inventory requested by ';
       }
       $this->db->select('name');
       $this->db->from('employee_profile');
       $this->db->where_in('id',$this->aauth->get_user()->id);
       $ret = $this->db->get()->result();
       foreach ($ret as $row) {
           $msg =  $msg.' '.$row->name;
       }
       return $msg;
   }

     //get Approved inventory for show msg for owner - arzoo
     public function getMessageApproveInventory($show_id,$product_name){
        $msg = "";
       $this->db->select('show_name');
       $this->db->from('shows');
       $this->db->where_in('id',$show_id);
       $ret = $this->db->get()->result();
       foreach ($ret as $row) {
           $msg = ' for '.$row->show_name.' ,Inventory Request for product '.$product_name.'  is approved by ';
       }
       $this->db->select('name');
       $this->db->from('employee_profile');
       $this->db->where_in('id',$this->aauth->get_user()->id);
       $ret = $this->db->get()->result();
       foreach ($ret as $row) {
           $msg =  $msg.' '.$row->name;
       }
       return $msg;
   }


     //get Approved inventory for show msg for owner - arzoo
     public function getMessageConfirmInventory($show_id,$product_name){
        $msg = "";
       $this->db->select('show_name');
       $this->db->from('shows');
       $this->db->where_in('id',$show_id);
       $ret = $this->db->get()->result();
       foreach ($ret as $row) {
           $msg = ' for '.$row->show_name.' ,Inventory Allocation for product '.$product_name.'  is confirmed by ';
       }
       $this->db->select('name');
       $this->db->from('employee_profile');
       $this->db->where_in('id',$this->aauth->get_user()->id);
       $ret = $this->db->get()->result();
       foreach ($ret as $row) {
           $msg =  $msg.' '.$row->name;
       }
       return $msg;
   }

    //get loggedin user's name
    public function getloginusername($id)
    {
        $this->db->select('*');
        $this->db->from('employee_profile');
        $this->db->where('id',$id);
        return $this->db->get()->row()->name;
    }

    //get loogedin teamleader's account details
     public function loggedin_user_ac_detail()
    {
       $this->db->select('*');
       $this->db->from('employee_profile');
       $this->db->where('id',$this->aauth->get_user()->id);
       $ac_num=$this->db->get()->row()->ac_num;

       $this->db->select('*');
       $this->db->from('accounts');
       $this->db->where('accounts.acn',$ac_num);
       return $this->db->get()->row()->id;

    }

    //Check Balance from account before transfer from teamleader's account to salesperson account
    public function checkbalancebeforetransfer($pay_acc,$amount)
    {
         $this->db->select('*');
        $this->db->from('accounts');
        $this->db->where('id',$pay_acc);
        $amount_check=$this->db->get()->row()->lastbal;

        if((int)$amount_check >= (int)$amount)
        {
            return true;

        }
        // return $msg;
     }
     //get Team leader token based on showid - arzoo
     public function retriveTeamLeaderTokenBasedOnShow($id){
        $tokens = array();
        $this->db->select('device_token');
        $this->db->from('aauth_users');
        $this->db->join('show_request','aauth_users.id=show_request.teamleader_id');
        $this->db->where('show_request.id',$id);
        $ret =  $this->db->get()->result();
        foreach ($ret as $row) {
            array_push($tokens, $row->device_token);
        }
        return $tokens;
     }
     //get msg accept or reject to team leader for show request- arzoo
     public function getMessageShowRequestStatus($mid, $mode){
         $msg = "";
        $this->db->select('shows.show_name');
        $this->db->from('show_request');
       // $this->db->join('employee_profile','employee_profile.id=show_request.teamleader_id');
        $this->db->join('shows','shows.id=show_request.show_id');
        $this->db->where('show_request.id',$mid);
        $ret =  $this->db->get()->result();
        foreach ($ret as $row) {
            $msg = "Your request for show ".$row->show_name." has been ".$mode." by ";
        }
        $this->db->select('name');
        $this->db->from('employee_profile');
        $this->db->where_in('id',$this->aauth->get_user()->id);
        $ret = $this->db->get()->result();
        foreach ($ret as $row) {
            $msg =  $msg.' '.$row->name;
        }
        return $msg;
     }
     //break time tokens and info - arzoo
     public function getBreakTimingInfo(){
         $data = array();
         $tokens = array();
         $query = $this->db->query("select breaktimesforshow.id, breaktimesforshow.salesperson_id, breaktimesforshow.show_id, device_token, show_name from breaktimesforshow inner join show_break_times on show_break_times.id = breaktimesforshow.detail_id inner join aauth_users on aauth_users.id = breaktimesforshow.salesperson_id inner join shows on shows.id = breaktimesforshow.show_id where date = CURRENT_DATE and start_break_time between DATE_ADD(NOW(), INTERVAL 5 MINUTE) and DATE_ADD(NOW(), INTERVAL 35 MINUTE)");
         $ret = $query->result();
         foreach($ret as $row){
            if(!isset( $data[$row->show_id] ))
                $tokens[$row->show_id]  = array();
             $data[$row->show_id]['name'] = $row->show_name;
            //  if(!isset($tokens[$row->show_id]))
            //      $tokens[$row->show_id]  = array();
             array_push($tokens[$row->show_id],$row->device_token);
            //  $tokens[$row->show_id] 
            //  if(!isset($data[$row->show_id]['token']))
            //     $data[$row->show_id]['token']  = array();
            //  array_push($data[$row->show_id]['token'],$row->device_token);
         }
         foreach ($tokens as $key => $value) {
             $data[$key]['token'] = $value;
         }
         return $data;
     }

     //count location show arzoo
    public function location_show_count($show_id)
    {
        $this->db->select('*');
        $this->db->from('show_location');
		$this->db->where('show_id', $show_id);
		$query = $this->db->get();
        return $query->num_rows();
    }

     //show location Details arzoo
     public function getLocationDetails($show_id)
     {
         $this->db->select('*');
         $this->db->from('show_location');
         $this->db->where('show_id', $show_id);
         $query = $this->db->get();
         return $query->result_array();
     }

    // location show add arzoo
    function data_insert($data){
        $result = $this->db->insert('show_location',$data);
        return $result;
    }

    // location show update arzoo
    function data_update($data,$show_id){
        $this->db->where('show_id',$show_id);
        $result = $this->db->update('show_location',$data);
        return $result;
    }
    public function getAllPendingShowRequests(){
       $ret  =  $this->db->select('show_request.*,shows.show_name,employee_profile.name as empname')
        ->from('show_request')
        ->join('shows','shows.id = show_request.show_id')
        ->join('employee_profile','employee_profile.id = show_request.show_id')
        ->where('delete_flag','0')
        ->where('status','0')
        ->get()
        ->result_array();
        return $ret;
    }
	
	//check show id for duplicate
    public function checkshowId($show_id)
    {
        $this->db->select('*');
        $this->db->from('shows');
		$this->db->where('show_id', $show_id);
		$query = $this->db->get();
        return $query->num_rows();
    }
    // public function getteamleadeinfo($id){
    //     $ret  =  $this->db->select('show_request.*,shows.show_name,employee_profile.name as empname')
    //     ->from('show_request')
    //     ->join('shows','shows.id = show_request.show_id')
    //     ->join('employee_profile','employee_profile.id = show_request.teamleader_id')
    //     ->where('delete_flag','0')
    //     ->where('show_id',$id)
    //     ->get()
    //     ->result_array();
    //     return $ret; 
    // }
}