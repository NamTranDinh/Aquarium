<?php 

class AboutController extends BaseController{

    public function index()
    {
        return $this->view('frontend.about.index');
    }
}