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



if (!defined('BASEPATH'))

    exit('No direct script access allowed');





class User extends CI_Controller

{



    public function __construct()

    {

        parent::__construct();

        // YRegards constructor code

        $this->load->library("Aauth");

        $this->load->library("Captcha_u");

        $this->load->library("form_validation");

        $this->captcha = $this->captcha_u->public_key()->captcha;



    }

    public function iOSapi(){
        $token = $this->input->post('token');
        $email = $this->input->post('email');

        $update = array(
            'device_token' => $token
        );

        $where = array(
            'email' => $email
        );

        if(!empty($token) && !empty($email)){
            $this->db->update('aauth_users', $update, $where);
            if($this->db->affected_rows() > 0){
                $response = array(
                    'success' => 1,
                    'message' => 'Token Updated Successfully'
                );
            }else{
                $response = array(
                    'success' => 0,
                    'message' => 'Token Not Updated'
                );
            }
        }else{
            $response = array(
                'success' => 0,
                'message' => 'Email or Token is empty'
            );
        }
        echo(json_encode($response));
    }



    public function index()
    {

        if ($this->aauth->is_loggedin()) {

            redirect('dashboard/', 'refresh');

        }

        $this->db->select('*');
        $this->db->from('shows');
        $this->db->where('shows.show_end_date >= ',date("Y-m-d"));
        $this->db->or_where('shows.show_start_date >= ',date("Y-m-d"), NULL, FALSE);

        $query=$this->db->get();
        $shows=$query->result_array();

        $data['response'] = '';

        $data['captcha_on'] = $this->captcha;

        $data['captcha'] = $this->captcha_u->public_key()->recaptcha_p;

        $data['shows']=$shows;

        if ($this->input->get('e')) {

            $data['response'] = 'Invalid username or password!';

        }
        else if($this->input->get('s')) {

            $data['response'] = 'Please Select Booth and Show!';

        }
        else if($this->input->get('t')) {

            $data['response'] = 'You are not assigned for selected show!';

        }


        $this->load->view('user/header');

        $this->load->view('user/index', $data);

        $this->load->view('user/footer');

    }

    public function getboothlistshowloginpage()
    {
        $show_id=$this->input->get('id');
        $this->db->select('*');
        $this->db->from('showbooth');
        $this->db->where('prid',$show_id);
        $query=$this->db->get();
        $data=$query->result_array();
        echo json_encode($data);
    }



    public function checklogin()
    {

        $user = $this->input->post('username');

        $password = $this->input->post('password');

        $remember_me = $this->input->post('remember_me');

        $show_id=$this->input->post('show_id');

        $booth_id=$this->input->post('booth_id');

        $rem = false;

        if ($remember_me == 'on') {

            $rem = true;

        }

        $this->db->select('*');

        $this->db->from('aauth_users');

        $this->db->where('aauth_users.email',$user);

        $query=$this->db->get()->row();

        if($query=='')
        {
            redirect('user/?e=eyxde', 'refresh');
        }
        else
        {
            if($query->roleid != 2)
            {
                if ($this->aauth->login($user, $password, $rem, $this->captcha))
                {

                    redirect('dashboard/', 'refresh');

                }
                else
                {
                    redirect('user/?e=eyxde', 'refresh');
                }
            }
            else
            {
                if($show_id == '' OR $booth_id == '')
                {
                    //$this->aauth->logout();
                    redirect('user/?s=eyxde', 'refresh');
                }
                else
                {
                    $count=0;
                    $this->db->select('*');
                    $this->db->from('shows');
                    $this->db->where('shows.id',$show_id);
                    $salesperson_id=$this->db->get()->row()->show_assign_to;

                    $salesperson=array();

                    $salesperson=explode(",", $salesperson_id);

                    foreach($salesperson as $sl)
                    {
                        if($sl==$query->id)
                        {
                            $count++;
                        }

                    }
                    if($count != 0)
                    {
                        if ($this->aauth->login($user, $password, $rem, $this->captcha))
                        {
                            $this->session->set_userdata('salesperson_show_id', $show_id);
                            redirect('dashboard/', 'refresh');

                        }
                        else
                        {
                            redirect('user/?e=eyxde', 'refresh');
                        }

                    }
                    else
                    {

                        redirect('user/?t=eyxde', 'refresh');
                    }


                }
            }
        }


    }



    public function profile()

    {

        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');

        }





        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = $head['usernm'] . ' Profile';

        $this->load->model('employee_model', 'employee');

        $id = $this->aauth->get_user()->id;

        $data['employee'] = $this->employee->employee_details($id);

        $data['eid'] = intval($id);

        $this->load->view('fixed/header', $head);

        $this->load->view('user/profile', $data);

        $this->load->view('fixed/footer');





    }



    public function update()

    {

        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');

        }





        $id = $this->aauth->get_user()->id;

        $this->load->model('employee_model', 'employee');

        if ($this->input->post()) {

            $name = $this->input->post('name');

            $phone = $this->input->post('phone');

            $phonealt = $this->input->post('phonealt');

            $address = $this->input->post('address');

            $city = $this->input->post('city');

            $region = $this->input->post('region');

            $country = $this->input->post('country');

            $postbox = $this->input->post('postbox');

            $this->employee->update_employee($id, $name, $phone, $phonealt, $address, $city, $region, $country, $postbox);



        } else {

            $head['usernm'] = $this->aauth->get_user()->username;

            $head['title'] = $head['usernm'] . ' Profile';





            $data['user'] = $this->employee->employee_details($id);

            $data['eid'] = intval($id);

            $this->load->view('fixed/header', $head);

            $this->load->view('user/edit', $data);

            $this->load->view('fixed/footer');

        }





    }



    public function displaypic()

    {



        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');

        }



        $this->load->model('employee_model', 'employee');

        $id = $this->aauth->get_user()->id;

        $this->load->library("uploadhandler", array(

            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/employee/'

        ));

        $img = (string)$this->uploadhandler->filenaam();

        if ($img != '') {

            $this->employee->editpicture($id, $img);

        }





    }



    public function user_sign()

    {

        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');

        }





        $this->load->model('employee_model', 'employee');

        $id = $this->aauth->get_user()->id;

        $this->load->library("uploadhandler", array(

            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/employee_sign/'

        ));

        $img = (string)$this->uploadhandler->filenaam();

        if ($img != '') {

            $this->employee->editsign($id, $img);

        }





    }





    public function updatepassword()

    {



        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');

        }



        $id = $this->aauth->get_user()->id;

        $this->load->model('employee_model', 'employee');





        if ($this->input->post()) {

            $this->form_validation->set_rules('newpassword', 'Password', 'required');

            $this->form_validation->set_rules('renewpassword', 'Confirm Password', 'required|matches[newpassword]');

            if ($this->form_validation->run() == FALSE) {

                echo json_encode(array('status' => 'Error', 'message' => '<br>Rules<br> Password length should  be at least 6 [a-z-0-9] allowed!<br>New Password & Re New Password should be same!'));

            } else {

                $cpassword = $this->input->post('cpassword');

                $newpassword = $this->input->post('newpassword');

                $renewpassword = $this->input->post('renewpassword');



                $hash = $this->aauth->hash_password($cpassword, $id);



                if (hash_equals($this->aauth->get_user()->pass, $hash)) {

                    echo json_encode(array('status' => 'Success', 'message' => 'Password Updated Successfully!'));



                    $this->aauth->update_user($id, false, $newpassword, false);



                } else {

                    echo json_encode(array('status' => 'Error', 'message' => 'Incorrect current password!'));

                }

            }





        } else {

            $head['usernm'] = $this->aauth->get_user()->username;

            $head['title'] = $head['usernm'] . ' Profile';





            $data['user'] = $this->employee->employee_details($id);

            $data['eid'] = intval($id);

            $this->load->view('fixed/header', $head);

            $this->load->view('user/password', $data);

            $this->load->view('fixed/footer');

        }





    }



    public function forgot()

    {

        if ($this->aauth->is_loggedin()) {

            redirect('/dashboard/', 'refresh');

        }



        $data['response'] = '';

        if ($this->input->get('e')) {

            $data['response'] = 'Invalid username or password!';

        }

        $this->load->view('user/header');

        $this->load->view('user/forgot', $data);

        $this->load->view('user/footer');

    }



    public function send_reset()

    {

        if ($this->aauth->is_loggedin()) {

            redirect('/dashboard/', 'refresh');

        }



        $data['response'] = '';





        $email = $this->input->post('email');

        $out = $this->aauth->remind_password($email);

        if ($out) {

            $this->load->model('communication_model');



            $mailtoc = $out['email'];

            $mailtotilte = $out['username'];

            $subject = '[' . $this->config->item('ctitle') . '] Password Reset Link';

            $link = base_url('user/reset_pass?code=' . $out['vcode'] . '&email=' . $email);



            $message = "<h4>Dear $mailtotilte</h4>, <p>We have generated a password reset request for you. You can reset the password using follwing link.</p> <p><a href='$link'>$link</a></p><p>Reagrds,<br>Team " . $this->config->item('ctitle') . "</p>";

            $attachmenttrue = false;

            $attachment = '';

            $this->communication_model->send_email($mailtoc, $mailtotilte, $subject, $message, $attachmenttrue, $attachment);

        } else {

            echo json_encode(array('status' => 'Success', 'message' => 'Email Sent Successfully!'));

        }

    }



    public function reset_pass()

    {

        if ($this->aauth->is_loggedin()) {

            redirect('/dashboard/', 'refresh');

        }

        $data['code'] = $this->input->get('code');

        $data['email'] = $this->input->get('email');



        $data['response'] = '';

        if ($this->input->get('e')) {

            $data['response'] = 'Invalid username or password!';

        }

        $this->load->view('user/header');

        $this->load->view('user/reset', $data);

        $this->load->view('user/footer');

    }



    public function reset_change()

    {

        if ($this->aauth->is_loggedin()) {

            redirect('/dashboard/', 'refresh');

        }

        $code = $this->input->post('n_code');

        $password = $this->input->post('n_password');

        $code = $this->input->post('n_code');

        $email = $this->input->post('email');



        if (strlen($password) > 5) {

            $out = $this->aauth->reset_password($email, $code, $password);



            if ($out) echo json_encode(array('status' => 'Success', 'message' => 'Password Changed Successfully!'));

            else echo json_encode(array('status' => 'Error', 'message' => 'Code Expired!'));

        }





        $data['response'] = '';

        if ($this->input->get('e')) {

            $data['response'] = 'Invalid username or password!';

        }



    }



    public function logout()

    {



        $this->aauth->logout();



        redirect('/user/', 'refresh');



    }

    public function getshowdetailsforlogin()
    {
        $shows_data=[];
        $email=$this->input->get('email');
        $ck=0;

        $this->db->select('*');
        $this->db->from('aauth_users');
        $this->db->where('aauth_users.email',$email);
        $user_data=$this->db->get()->row();

        if(!empty($user_data))
        {
            $user_role=$user_data->roleid;
            $user_id=$user_data->id;

            if($user_role == 2)
            {
                $this->db->select('*');
                $this->db->from('shows');
                $this->db->where('shows.show_end_date >= ',date("Y-m-d"));
                $this->db->or_where('shows.show_start_date >= ',date("Y-m-d"), NULL, FALSE);
                $showss=$this->db->get()->result_array();

                $show_ids=[];

                foreach($showss as $sh)
                {
                    if($sh['show_assign_to']!='')
                    {
                        $sl=explode(',',$sh['show_assign_to']);

                        if(!empty($sl))
                        {

                            if(in_array($user_id,$sl))
                            {

                                $show_ids[]=$sh['id'];

                            }

                        }
                    }
                }

                foreach($show_ids as $sl)
                {
                    $this->db->select('*');
                    $this->db->from('shows');
                    $this->db->where('shows.id',$sl);
                    $shows_data[]=$this->db->get()->row();
                }


                echo json_encode($shows_data);
            }
        }
        else
        {
            echo json_encode('');
        }
    }
    //code to insert the token in aauth_users
    public function setToken(){
        $token  = $this->input->post('token');
        $data = array(
            'device_token'=>$token
        );
        $this->db->where('id', $this->aauth->get_user()->id);
        echo  json_encode($this->db->update('aauth_users', $data));
    }
}
