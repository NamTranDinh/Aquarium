<?php

class HomeController extends BaseController{

    // private $homeModel;
    
    // public function __construct() {
    //     $this->homeModel = $this->load_model_public('HomeModel');
    // }

    public function index(){
        return $this->view('frontend.home.index');
    }
 
}