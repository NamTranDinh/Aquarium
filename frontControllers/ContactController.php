<?php

class ContactController extends BaseController{

    private $contactModel;

    public function __construct()
    {
        $this->contactModel = $this->load_model_public('ContactModel');
    }
    public function index()
    {
        return $this->view('frontend.contact.index');
    }
    public function InsertData() {
     
        if(isset($_POST['sub'])){
            array_pop($_POST);
            foreach($_POST as $key => $val){
                $data[$key] = htmlentities($val);
            }
            // var_dump($_FILES['contactFile']);die;
            if(isset($_FILES['contactFile']) && $_FILES['contactFile']['name'] != ''){
                $upload = $this->load_library('Upload_img');
                $folder_up = 'public';
                $upload_path = UPLOAD_PATH.$folder_up;
                $upload->set_upload_path($upload_path);
                $upload->set_max_filesize(2048);
                if($upload->do_upload('contactFile')){
                    $data['img']  = $upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
                    $this->contactModel->insertData($data, 'ep_contact');
                }
            }else{
                $this->contactModel->insertData($data, 'ep_contact');
            }
            header('location: ?controller=contact');
        }
    }
}