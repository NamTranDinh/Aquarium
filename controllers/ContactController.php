
<?php

class ContactController extends BaseController{

    private $contactModel;
    private $paging;

    public function __construct() 
    {
        $this->paging['contact'] = $this->load_library('Pagination');
        $this->contactModel = $this->load_model('ContactModel');
    }

    public function index() 
    {
        $condition = '';
        if(isset($_REQUEST['search_submit']) && $_REQUEST['keyword']!=''){   
            $condition = 'name like "%'.$_REQUEST['keyword'].'%" or email like "'.$_REQUEST['keyword'].'%"';
            $url = 'controller=contact&search_submit=1&keyword='.$_REQUEST['keyword'].'&';
        }else{
            $url = 'controller=contact&';
        }

        $all_data = $this->contactModel->getContactData(0, 0, $condition);
        $count_row = count($all_data);
        $page = isset($_REQUEST['page']) ? $_REQUEST['page']: 1;
        
        $this->paging['contact']->setValue($count_row, $page, CONTACT_LIMIT, $url);
        $dataCont = $this->contactModel->getContactData(CONTACT_LIMIT, $this->paging['contact']->offset, $condition);

        $this->view('backend.contact.index', [  
            'data'=>$dataCont,       
            'contact_paging'=> $this->paging['contact'],
            'keyword'=>$_REQUEST['keyword']??''
        ]);

    }
    public function DeleteDataContact()
    {
       
        if(isset($_GET['id'])){
            
            $condition = 'id = "'.$_GET['id'].'"';
            $tblTable = "ep_contact";
            
            $this->dropImg(['img'], $tblTable, $condition);

            $this->contactModel->deleteData($condition, $tblTable);
            header('location: ?controller=contact');
        }
    }
    
    public function updateContact()
    { 
        array_pop($_POST);
        $data=$_POST;
        $condition = ' id= "'.$_POST['id'].' "';
        $this->contactModel->updateData($data, $condition, 'ep_contact');
        header('location: ?controller=contact');
    }

    public function dropImg($column = [], $table, $condition, $limit = 999, $offset = 0) {
        $column_list = $this->contactModel->ColumnList($table);
        if($table && $condition && in_array($column[0], $column_list)){
            $all_img = $this->contactModel->findField($column, $table, $limit, $offset, $condition);
            $base = str_replace('\Aquarium', '', BASE_PATH);
            $base = str_replace('\\', '/', $base);
            if(!empty($all_img[0][$column[0]])){
                foreach($all_img as $val){
                    if(file_exists($base.$val[$column[0]])) unlink($base.$val[$column[0]]);
                }
            }
            return true;
        }
        return false;
    }
 
}
