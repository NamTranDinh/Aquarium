<?php

class RevenueController extends BaseController{

    private $revenueModel;

    public function __construct() {
        $this->revenueModel = $this->load_model('RevenueModel');
    }

    public function index() {
        
        return $this->view('backend.revenues.index', [

        ]);
    }

}