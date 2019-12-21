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

class Salesperson Extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library("Aauth");

        $this->load->model('projects_model', 'projects');

        $this->load->model('shows_model','shows');

        $this->load->model('tools_model', 'tools');

        $this->load->model('products_model','products');      

        if (!$this->aauth->is_loggedin()) {

            redirect('/user/', 'refresh');

        }

        if ($this->aauth->get_user()->roleid != 2) {

           exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        }

    }

    public function explore()
    {
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

        $head['usernm'] = $this->aauth->get_user()->username;

        $head['title'] = 'Sales Person Dashboard';

        $this->load->view('fixed/header', $head);

        $this->load->view('SalesPerson/explore',$data);

        $this->load->view('fixed/footer');

    }

}
