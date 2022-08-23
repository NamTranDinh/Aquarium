<?php

class CustomerController extends BaseController{

    private $cusModel;
    private $paging;

    public function __construct() {
        $this->cusModel = $this->load_model('CustomerModel');
        $this->paging['cus'] = $this->load_library('Pagination');
    }

    public function index() {
        
        $count_row = $this->cusModel->getCountRecord('ep_customer');;
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['cus']->setValue($count_row, $page, CUSTOMER_LIMIT, "");
        $data = $this->cusModel->getCustomerData(CUSTOMER_LIMIT, $this->paging['cus']->offset);

        $total_all = $this->cusModel->getTotalAll();
      
        return $this->view('backend.customer.index', [
            'data'=>$data,
            'num_customers' =>$count_row,
            'total_all'     =>$total_all,
            'paging_cus'    =>$this->paging['cus']
        ]);
    }
}