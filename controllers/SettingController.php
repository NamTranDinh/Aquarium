<?php

class SettingController extends BaseController{

    private $settingModel;
    private $paging;

    public function __construct() {
        $this->settingModel         = $this->load_model('SettingModel');
        $this->paging['staff']      = $this->load_library('Pagination');
        $this->paging['staff_gr']   = $this->load_library('Pagination');
    }

    public function index() {
        $messes = [];
         
        $count_row = $this->settingModel->countUser();
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['staff']->setValue($count_row, $page, SETTING_LIMIT, "");        
        $userData = $this->settingModel->getUserData(SETTING_LIMIT, $this->paging['staff']->offset);
        $userGroupData = $this->settingModel->getUserGroupData();
 
        $count_row_gr = $this->settingModel->countGroupUser();
        $page_gr = isset($_REQUEST['page_gr'])?$_REQUEST['page_gr']:1;
        $this->paging['staff_gr']->setValue($count_row_gr, $page_gr, SETTING_LIMIT, "");
        $userData_gr = $this->settingModel->getUserGroupData(SETTING_LIMIT, $this->paging['staff_gr']->offset);
        
        return $this->view('backend.setting.index', [
            'data'      => $userData,
            'groupData' => $userGroupData,
            'pagination'=>$this->paging['staff'],            
            'messes'    =>$messes,

            'data_gr'   => $userData_gr,
            'pagination_gr'=>$this->paging['staff_gr'],
        ]);
    }

}