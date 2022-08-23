<?php 

class AccountController extends BaseController{

    private $accModel;

    public function __construct() {
        if(empty($_SESSION['cus_id'])){
            header('location: /Aquarium/views/frontend');
        }
        $this->accModel = $this->load_model_public('AccountModel');
    }

    public function index() {
        $condition = 'id = "'.$_SESSION['cus_id'].'"';
        $data = $this->accModel->getDataUser($condition);
        $arr = explode('@', $data[0]['email']);
        if(count($arr) == 2)
            $data[0]['email'] = substr($arr[0], 0, 2).'*******@'.$arr[1];
        else $data[0]['email'] = '*********@****';
        return $this->view('frontend.account.index', [
            'data'=>$data[0]??[],
        ]);
    }
}