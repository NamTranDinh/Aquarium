<?php

class AccountController extends BaseController{

    private $accountModel;

    public function __construct() {
        $this->accountModel = $this->load_model('AccountModel');        
    }

    public function index() { 
        $data = $this->accountModel->getDataAccount($_SESSION['userId']);
        return $this->view('backend.account.index',[
            'data'  =>$data,           
            'title' =>"Information user"
        ]);
    } 
}