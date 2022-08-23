<?php

class AjaxController extends BaseController{

    private $ajaxModel;
    private $paging;
    private $upload;

    public function __construct() {
        $this->ajaxModel = $this->load_model('AjaxModel');
        $this->upload    = $this->load_library('Upload_img');
    }
    // ========== delete img ==========
    /**
     * @param array
     * @param string
     * @param string
     * @return bool
     */
    public function dropImg($column = [], $table, $condition, $limit = 999, $offset = 0) {
        $column_list = $this->ajaxModel->ColumnList($table);
        if($table && $condition && in_array($column[0], $column_list)){
            $all_img = $this->ajaxModel->findField($column, $table, $limit, $offset, $condition);
            $base = str_replace('\Aquarium', '', BASE_PATH);
            $base = str_replace('\\', '/', $base);
            if(!empty($all_img[0][$column[0]])){
                foreach($all_img as $val){
                    $link = $base.$val[$column[0]];
                    $extension = array('jpg', 'png', 'jpeg', 'gif');
                    $ext = strtolower(pathinfo($link, PATHINFO_EXTENSION));
                    if(in_array($ext, $extension) && file_exists($link)) unlink($link);
                }
            }
            return true;
        }
        return false;
    }
    // ============== Account ===========
    public function changePass(){
        $account = $this->load_model('AccountModel');
        if(isset($_REQUEST['oldpass'])) {
            $oldpass = $_REQUEST['oldpass'];
            $newpass = $_REQUEST['newpass'];
            $password = $account->isPassword($_SESSION['userId'], $oldpass);
            if($password===true){
                $account->changePassword($_SESSION['userId'], $newpass);
                $data = $account->getDataAccount($_SESSION['userId']);
                return $this->view('backend.ajax.account.load_account',[
                    'data'  =>$data,
                    'susses'=>"Changed password!",
                    'title' =>"Information user"
                ]);
            }else{
                $data = $account->getDataAccount($_SESSION['userId']);
                return $this->view('backend.ajax.account.load_account',[
                    'data'=>$data,
                    'title' =>"Information user",
                    'error'=>"Password is incorrect!"
                ]);
            }
        }
    }
    // ============== Setting ============
    /**
     * Phân trang cho setting phần staff
     * @return table
     */
    public function st_staff_paging() {
        $this->paging['staff'] = $this->load_library('Pagination');
        $count_row = $this->ajaxModel->countUser();
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['staff']->setValue($count_row, $page, SETTING_LIMIT, "");
        $userData = $this->ajaxModel->getUserData(SETTING_LIMIT, $this->paging['staff']->offset);
        $userGroupData = $this->ajaxModel->getUserGroupData();
        return $this->view("backend.ajax.setting.showStaff",[
            'data'      => $userData,
            'groupData' => $userGroupData,
            'pagination'=>$this->paging['staff'],            
        ]);        
    }
    /**
     * Phân trang cho setting phần Group staff
     * @return table
     */
    public function st_staff_group_paging() {
        $this->paging['staff_gr'] = $this->load_library('Pagination');
        $count_row_gr = $this->ajaxModel->countGroupUser();
        $page_gr = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['staff_gr']->setValue($count_row_gr, $page_gr, SETTING_LIMIT, "");
        $userData_gr = $this->ajaxModel->getUserGroupData(SETTING_LIMIT, $this->paging['staff_gr']->offset);
        
        return $this->view('backend.ajax.setting.showStaffGroup', [
            'data_gr'   => $userData_gr,
            'pagination_gr'=>$this->paging['staff_gr']
        ]);
    }
    /**
     * Tạo nhân viên phần setting
     * @return string
     */
    public function creStaff() {
        if(isset($_REQUEST['addUser'])){            
            $data = [
                'name'      =>$_REQUEST['name'],
                'username'  =>$_REQUEST['username'],
                'email'     =>$_REQUEST['email'],
                'password'  =>password_hash($_REQUEST['password'], PASSWORD_DEFAULT),
                'group_id'  =>$_REQUEST['group_id'],
            ];
            $check = $this->ajaxModel->check_name("username = '".$_REQUEST['username']."'", 'ep_users');
            if(count($check)!=0){
                $messes = 'This account already exists!';    
            }else{
                $messes = 'Successfully add account!';
                $this->ajaxModel->store($data, 'ep_users');
            }
            echo $messes;
        }
    }
    /**
     * Tạo nhóm nhân viên phần setting
     * @return string
     */
    public function creGroupStaff() {
        if(isset($_REQUEST['addGroup'])){            
            $data = [
                'group_name'=>$_REQUEST['group_name'],
                'group_permission'=>$_REQUEST['group_permission'],
            ];
            $check = $this->ajaxModel->check_name("group_name = '".$_REQUEST['group_name']."'", 'ep_users_group');
            if(count($check)!=0){                
                $messes = 'This group already exists!';    
            }else{                
                $messes = 'Successfully add group!';
                $this->ajaxModel->store($data, 'ep_users_group'); 
            }
            unset($_REQUEST['addGroup']);
            echo $messes;
        }
    }
    /**
     * Xóa nhân viên phần setting
     * @return string
     */
    public function deleteStaff() {
        if(isset($_REQUEST['id_del'])) {
            if($_REQUEST['id_del'] != $_SESSION['userId']):                
                $messes = 'Employee has been deleted';
                $condition = 'id = "'.$_REQUEST['id_del'].'"';
                $this->ajaxModel->destroy($condition, 'ep_users');
                unset($_REQUEST['id_del']);
            else:                
                $messes = 'Can\'t delete your account!';
            endif;
            echo $messes;
        }
    }
    /**
     * Xóa nhóm phần setting
     * @return string
     */
    public function deleteGroupStaff() {
        if(isset($_REQUEST['id_del'])) {
            if($_REQUEST['id_del'] != $_SESSION['permission']):
                $messes = 'Employee has been deleted';
                $condition = 'id = "'.$_REQUEST['id_del'].'"';
                $this->ajaxModel->destroy($condition, 'ep_users_group');
                $condition = 'group_id = "'.$_REQUEST['id_del'].'"';
                $this->ajaxModel->destroy($condition, 'ep_users');
                unset($_REQUEST['id_del']);
            else:
                $messes = 'You can\'t delete this group';
            endif;
            echo $messes;
        }
    }
    /**
     * Sửa thông tin nv phần setting
     * @return string
     */
    public function updateStaff() {
        if(isset($_REQUEST['id_upd'])){
            $data = [
                'name'      =>$_REQUEST['name'],
                'email'     =>$_REQUEST['email'],
                'group_id'  =>$_REQUEST['group_id'],
                'status'    =>$_REQUEST['status']
            ];
            
            $condition = 'id = "'.$_REQUEST['id_upd'].'"';
            $messes = 'Successfully updated !';
            $this->ajaxModel->updateField($data, $condition, 'ep_users'); 
            echo $messes;
        }
    }
    /**
     * Sửa thông tin nhóm phần setting
     * @return string
     */
    public function updateGroupStaff() {
        if(isset($_REQUEST['id_upd'])){
            $data = [
                'group_name'=>$_REQUEST['group_name'],
                'group_permission'=>$_REQUEST['group_permission'],
            ];
            $condition = 'id = "'.$_REQUEST['id_upd'].'"';                       
            $messes = 'Successfully updated!';
            $this->ajaxModel->updateField($data, $condition, 'ep_users_group');
            echo $messes;
        }
    }
    // =================== Post manage ==================
    public function category($data, $parent_id = 0, $level = 0) {
        $result = [];
        foreach($data as $item){
            if($item['parent_id'] == $parent_id){
                $item['level'] = $level;
                $result[] = $item;
                unset($data[$item['id']]);
                $child = $this->category($data, $item['id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result ;
    }
    public function get_category($parent_id = -1) {
        $category_data = $this->ajaxModel->get_category_data();
        return $this->category($category_data, $parent_id, 0);
    }
    public function post_paging() {
        $search = $_POST['search'];
        $group_id = $_POST['group_id'];
        $type_s = $_POST['type_s'];
        $status = $_POST['status'];
        $order_type = $_POST['order_type']??'asc';
        $condition_cate = 'id = "'.$group_id.'" and status = 1';
        $category = $this->ajaxModel->findField(['group_name'], 'ep_sea_group', 1, 0, $condition_cate);
        $condition = '1';
        if($status!=-1){
            $condition .= ' and a.status = "'.$status.'"';
        }
        if($search != ''){
            if($type_s=='false') $percent = '';
        else $percent = '%';
            $condition .= ' and (sea_name like "'.$percent.''.$search.'%" or group_name like "'.$percent.''.$search.'%" or  c.name like "'.$percent.''.$search.'%")';
        }

        if($group_id != -1){
            $condition .= ' and (group_name = "'.$category[0]['group_name'].'"';
            $list_groupId = $this->get_category($group_id);
            foreach ($list_groupId as $val){
                $condition .= ' or group_name = "'.$val['group_name'].'"';
            }
            $condition .= ')';
        }
        $order_by = 'sea_id '.$order_type;

        $this->paging['posts'] = $this->load_library('Pagination');
        $count_row = count($this-> ajaxModel->getPostData(0, 0, $condition, $order_by));
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['posts']->setValue($count_row, $page, POST_LIMIT, "");
        $data = $this->ajaxModel->getPostData(POST_LIMIT, $this->paging['posts']->offset, $condition, $order_by);
        $this->view('backend.ajax.post_manage.paging_post', [
            'data'      => $data,
            'search'    => $search,
            'paging_posts'=>$this->paging['posts'],
            'category'  => $category
        ]);
    }
    public function post_category_paging() {
        $search = $_POST['search'];
        $type_s = $_POST['type_s'];
        if($type_s=='false') $percent = '';
        else $percent = '%';
        $condition = 'group_name like "'.$percent.''.$search.'%"';
        
        $this->paging['category']   = $this->load_library('Pagination');
        $count_row = count($this-> ajaxModel->getPostGrData(0, 0, $condition));
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['category']->setValue($count_row, $page, POST_LIMIT, "");
        $data = $this->ajaxModel->getPostGrData(POST_LIMIT, $this->paging['category']->offset, $condition);
    
        $list_cate_id = $this->ajaxModel->findField(['id'] , 'ep_sea_group', POST_LIMIT, $this->paging['category']->offset, $condition);
        $i = 0;
        foreach($list_cate_id as $value){
            $list_groupId = $this->find_category_post([['id'=>$value['id']]]);
            $list_groupId = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($list_groupId)), 0);
            $total_post = 0;
            foreach($list_groupId as $val){
                $condition = 'sea_group_id = "'.$val.'"';
                $list_post =  $this->ajaxModel->findAny(['sea_id'], $condition, 'ep_sea_animal');
                $total_post += count($list_post);
            }
            $data[$i]['total_subcategory'] = count($list_groupId)-1;
            $data[$i]['total_posts'] = $total_post;
            $data[$i]['sub_cate_id'] = $list_groupId;
            $i++;
        }
 
        return $this->view('backend.ajax.post_manage.paging_category', [
            'data' => $data,
            'category'=>$this->get_category(),
            'search' =>$search,
            'paging_category'=>$this->paging['category']
        ]);
    }
    public function load_post() {
        $this->paging['posts'] = $this->load_library('Pagination');
        $count_row = count($this-> ajaxModel->getPostData());
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['posts']->setValue($count_row, $page, POST_LIMIT, "");
        $data = $this->ajaxModel->getPostData(POST_LIMIT, $this->paging['posts']->offset);
        
        $this->view('backend.post_manage.index', [
            'data' => $data,
            'category'=>$this->get_category(),
            'paging_posts'=>$this->paging['posts']
        ]);         
    }
    public function load_post_category() {
        $this->paging['category'] = $this->load_library('Pagination');
        $count_row = count($this-> ajaxModel->getPostGrData());
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['category']->setValue($count_row, $page, POST_LIMIT, "");
        $data = $this->ajaxModel->getPostGrData(POST_LIMIT, $this->paging['category']->offset);

        $list_cate_id = $this->ajaxModel->findField(['id'] , 'ep_sea_group', POST_LIMIT, $this->paging['category']->offset);
        $i=0;
        foreach($list_cate_id as $value){
            $list_groupId = $this->find_category_post([['id'=>$value['id']]]);
            $list_groupId = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($list_groupId)), 0);
            $total_post = 0;
            foreach($list_groupId as $val){
                $condition = 'sea_group_id = "'.$val.'"';
                $list_post =  $this->ajaxModel->findAny(['sea_id'], $condition, 'ep_sea_animal');
                $total_post += count($list_post);
            }
            $data[$i]['total_subcategory'] = count($list_groupId)-1;
            $data[$i]['total_posts'] = $total_post;
            $data[$i]['sub_cate_id'] = $list_groupId;
            $i++;
        }

        
        return $this->view('backend.ajax.post_manage.post_group', [
            'data' => $data,
            'category'=>$this->get_category(),
            'paging_category'=>$this->paging['category']
        ]);
    }
    // ========= post ============
    public function show_edit_post() {
        $sea_id = $_POST['sea_id'];
        $condition = 'sea_id = "'.$sea_id.'"';
        $data = $this->ajaxModel->getPostData(1, 0, $condition);
        return $this->view('backend.ajax.post_manage.post_edit', [
            'data'      => $data[0],
            'category'  =>$this->get_category(),
        ]);
    }
    public function cre_posts() {
        $data = array();  
        $check = [];
        if(isset($_POST)){
            $condition = 'sea_name = "'.$_POST['sea_name'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_sea_animal');
            if(!empty($check)){
                echo 'Post name is exist!';
                return false;
            }
            array_shift($_POST);
            $data = $_POST;
            $data['user_id'] = $_SESSION['userId'];
        }
        
        $folder_up = 'animal';
        $upload_path = UPLOAD_PATH.$folder_up;
        $this->upload->set_upload_path($upload_path);
        // max file là 2Mb
        // $_FILES['abc']
        $this->upload->set_max_filesize(2048);
        if(!($this->upload->do_upload('post_img', 'no'))){
            echo $this->upload->get_error();
        }elseif(!($this->upload->do_upload('post_sub_img', 'no'))) {
            echo $this->upload->get_error();
        }else{
            $this->upload->do_upload('post_img');
            $data['sea_img'] = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
            $this->upload->do_upload('post_sub_img');
            $data['sea_sub_img'] = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
            $this->ajaxModel->store($data, 'ep_sea_animal');
            echo 'Successfully added post!';
        }
    }
    public function udp_posts() {
        // var_dump($_FILES);die;
        $data = array();
        $check = [];
        if(isset($_POST)){
            $condition = 'sea_name = "'.$_POST['sea_name'].'" and sea_id != "'.$_POST['sea_id'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_sea_animal');
            if(!empty($check)){
                echo 'Post name is exist!';
                return false;
            }
            array_shift($_POST);
            $data = $_POST;
            $data['status'] = $data['status']=='true'?1:0;
        }
        if(isset($_FILES)){
            $folder_up = 'animal';
            $upload_path = UPLOAD_PATH.$folder_up;
            $this->upload->set_upload_path($upload_path);
            // max file là 2Mb
            $this->upload->set_max_filesize(2048);
   
            $condition = 'sea_id = "'.$_POST['sea_id'].'"';
           
            if(isset($_FILES['post_img']) && !($this->upload->do_upload('post_img', 'no'))){
                echo $this->upload->get_error();
                return false;
            } 
            if(isset($_FILES['post_sub_img']) && !($this->upload->do_upload('post_sub_img', 'no'))) {
                echo $this->upload->get_error();
                return false;
            }
            if($this->upload->do_upload('post_img')){
                $this->dropImg(['sea_img'], 'ep_sea_animal', $condition);
                $data['sea_img'] = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
            }
            if($this->upload->do_upload('post_sub_img')){
                $this->dropImg(['sea_sub_img'], 'ep_sea_animal', $condition);
                $data['sea_sub_img'] = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
            }
            $this->ajaxModel->updateField($data, $condition,'ep_sea_animal');
            echo 'Successfully update post! Please wait a few seconds for the data to be updated';
        } else{
            $condition = 'sea_id = "'.$_POST['sea_id'].'"';
            $this->ajaxModel->updateField($data, $condition,'ep_sea_animal');
            echo 'Successfully update post!';
        }
    }
    public function udp_post_status() {
        $data = [
            'status' => $_POST['status']
        ];
        $condition = 'sea_id = "'.$_POST['sea_id'].'"';
        $this->ajaxModel->updateField($data, $condition,'ep_sea_animal');
        echo "Status updated!";
    }
    public function del_posts() {
        if(isset($_POST)){
            $condition = 'sea_id = "'.$_POST['sea_id'].'" ';
            $this->dropImg(['sea_img'], 'ep_sea_animal', $condition);
            $this->dropImg(['sea_sub_img'], 'ep_sea_animal', $condition);
            $this->dropImg(['img'], 'ep_sea_description', $condition);
            $this->ajaxModel->destroy($condition, 'ep_sea_animal');
            $this->ajaxModel->destroy($condition, 'ep_sea_description');
            echo 'Post has been deleted';
        }
    }
    // -------- post-detail -------
    public function show_detail_post() {
        if(isset($_POST['sea_id'])){
            $data = $this->ajaxModel->getPostData(0, 0, "sea_id = ".$_POST['sea_id']);
            $description = $this->ajaxModel->getPostDescription("sea_id = '".$_POST['sea_id']."'");
            return $this->view('backend.ajax.post_manage.post_view_detail', [
                'data'       => $data[0],
                'description'=> $description
            ]);
        }
    }
    public function show_detail_content_post() {
        if(isset($_POST['sea_id'])){
            $data = $this->ajaxModel->getPostData(0, 0, "sea_id = ".$_POST['sea_id']);
            $description = $this->ajaxModel->getPostDescription("sea_id = '".$_POST['sea_id']."'");
            return $this->view('backend.ajax.post_manage.post_detail_content', [
                'data'       => $data[0],
                'description'=> $description
            ]);
        }
    }
    public function show_add_content_post() {
        return $this->view('backend.ajax.post_manage.post_add_content', [
            'sea_id'=>$_POST['sea_id']??'',
            'sea_name'=>$_POST['sea_name']??'',
        ]);
    }
    public function show_edit_content_post() {
        $condition = 'id = "'.$_POST['id'].'"';
        $description = $this->ajaxModel->getPostDescription($condition);
        $condition = 'sea_id = "'.$_POST['sea_id'].'"';
        $sea_name = $this->ajaxModel->findField(['sea_name'], 'ep_sea_animal', 1, 0, $condition);
        return $this->view('backend.ajax.post_manage.post_edit_content', [
            'description'=>$description[0],
            'sea_id'     =>$_POST['sea_id'],
            'sea_name'   =>$sea_name[0]['sea_name']
        ]);
    }
    public function cre_content_post() {
        $data = array();
        $check = [];
        if(isset($_POST)){
            $condition = 'des_name = "'.$_POST['des_name'].'" and sea_id = "'.$_POST['sea_id'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_sea_description');
            array_shift($_POST);
            $data = $_POST;
            if(!empty($check)){
                echo 'Name content is exist!';
                return false;
            }
        }
        if(isset($_FILES['img'])){
            $folder_up = 'animal';
            $upload_path = UPLOAD_PATH.$folder_up;
            $this->upload->set_upload_path($upload_path);
            $this->upload->set_max_filesize(2048);
            if($this->upload->do_upload('img')){
                $data['img']  = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
                $this->ajaxModel->store($data, 'ep_sea_description');
                echo 'Successfully added content!';
            }else{
                echo $this->upload->get_error();
            }
        }else{
            $this->ajaxModel->store($data, 'ep_sea_description');
            echo 'Successfully added content!';
        }
    }
    public function udp_content_post() {
        $data = array();
        $check = [];
        if(isset($_POST)){
            $condition = 'des_name = "'.$_POST['des_name'].'" and sea_id = "'.$_POST['sea_id'].'" and id != "'.$_POST['id'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_sea_description');
            array_shift($_POST);
            $data = $_POST;
            if(!empty($check)){
                echo 'Name content is exist!';
                return false;
            }
        }
        if(isset($_FILES['img'])){
            $folder_up = 'animal';
            $upload_path = UPLOAD_PATH.$folder_up;
            $this->upload->set_upload_path($upload_path);
            $this->upload->set_max_filesize(2048);
            if($this->upload->do_upload('img')){
                $data['img']  = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
                $condition = 'id = "'.$_POST['id'].'"';
                $this->dropImg(['img'], 'ep_sea_description', $condition);
                $this->ajaxModel->updateField($data, $condition,'ep_sea_description');
                echo 'Successfully update content! Please wait a few seconds for the data to be updated';
            }else{
                echo $this->upload->get_error();
            }
        }else{
            $condition = 'id = "'.$_POST['id'].'"';
            $this->ajaxModel->updateField($data, $condition,'ep_sea_description');
            echo 'Successfully update content!';
        }
    }
    public function del_content_post() {
        if(isset($_POST)){
            $condition = 'id = "'.$_POST['id'].'" ';
            $this->dropImg(['img'], 'ep_sea_description', $condition);
            $this->ajaxModel->destroy($condition, 'ep_sea_description');
            echo 'Content has been deleted';
        }
    }
    // -------- post-category ---------
    public function cre_category_post() {
        if(isset($_POST)){
            array_shift($_POST);
            $condition = 'group_name = "'.$_POST['group_name'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_sea_group');
            if(!empty($check)){
                echo "This category is exist!";
                return false;
            }
            $data = $_POST;
            $this->ajaxModel->store($data, 'ep_sea_group');
            echo 'Successfully added category!';
        }
    }
    public function udp_category_post() {
        $condition = 'id != "'.$_POST['id'].'" and group_name = "'.$_POST['group_name'].'"';
        $check = $this->ajaxModel->check_name($condition, 'ep_sea_group');
        if(!empty($check)){
            echo 'Group name is exist!';
            return false;
        }else{
            $data = [
                'group_name' => $_POST['group_name'],
                'parent_id'  => $_POST['parent_id'],
                'status'     => $_POST['status']
            ];
            $condition = 'id = "'.$_POST['id'].'"';
            $this->ajaxModel->updateField($data, $condition, 'ep_sea_group');
            echo 'Successfully update category!';
        }
    }
    public function find_category_post($id = []) {
        $data = array();
        foreach($id as $val){
            $condition = 'parent_id = "'.$val['id'].'"';
            $result = $this->ajaxModel->findAny(['id'], $condition, 'ep_sea_group');
            $data[] = $val;
            $child = $this->find_category_post($result);
            if(!empty($child)) array_push($data, $child);
        }
        return $data;
    }
    public function del_category_post() {
        $id = $_POST['id'];
        $list_groupId = $this->find_category_post([['id'=>$id]]);
        $list_groupId = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($list_groupId)), 0);
        // $list_groupId = call_user_func_array('array_merge', $list_groupId);
        $count['group'] = 0;
        $count['post'] = 0;
        
        foreach($list_groupId as $value){
            $count['group']++;
            $condition = 'sea_group_id = "'.$value.'"';
            $data =  $this->ajaxModel->findAny(['sea_id'], $condition, 'ep_sea_animal');
            foreach($data as $val){
                $count['post']++;
                $condition = 'sea_id = "'.$val['sea_id'].'" ';
                $this->dropImg(['sea_img'], 'ep_sea_animal', $condition);
                $this->dropImg(['sea_sub_img'], 'ep_sea_animal', $condition);
                $this->dropImg(['img'], 'ep_sea_description', $condition);
                $this->ajaxModel->destroy($condition, 'ep_sea_animal');
                $this->ajaxModel->destroy($condition, 'ep_sea_description');
            }
            $condition = 'id = "'.$value.'"';
            $this->ajaxModel->destroy($condition, 'ep_sea_group');
        }
        echo 'There are '.$count['group'].' categories and '.$count['post'].' posts deleted';      
    }
     
    // =================== Event manage ==================
    /**
     * @param string $data
     *        15/05/2021 20:00 ==> 2021-05-15 20:00
     */
    public function formatDate($data, $fr = '/', $to = '-') {
        $dateArr = explode(' ', $data);
        $time    = isset($dateArr[1])?" $dateArr[1]":'';
        return implode($to, array_reverse(explode($to, str_replace($fr, $to, $dateArr[0])))).$time;
    }
    public function load_event() {
 
        $this->paging['event'] = $this->load_library('Pagination');
        $count_row = count($this->ajaxModel->getEventData());
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['event']->setValue($count_row, $page, EVENT_LIMIT, "");
        $data = $this->ajaxModel->getEventData(EVENT_LIMIT, $this->paging['event']->offset);
        return $this->view('backend.event.index', [
            'data'  =>  $data,
            'paging_event'=>$this->paging['event']
        ]);
    }
    // ------- event ---------
    public function event_paging() {
        $condition = '';
        if(isset($_POST)){

            $search     = $_POST['search'];
            $type_s     = $_POST['type_s'];
            $date_start = $_POST['date_start'];
            $date_end   = $_POST['date_end'];
            $min_price  = $_POST['min_price'];
            $max_price  = $_POST['max_price'];
            $order_type = $_POST['order_type']??'asc';
            $condition  = '1';
            if($search != '')  {
                if($type_s=='false') $percent = '';
                else $percent = '%';
                $condition .= ' and event_name like "'.$percent.''.$search.'%"';
            } 
            if($date_start!=''){
                $date_start = $this->formatDate($date_start, '/'); 
                $condition .= ' and time_start >= "'.$date_start.'"';
            } 
            if($date_end!='')  {
                $date_end = $this->formatDate($date_end, '/'); 
                $condition .= ' and time_end <= "'.$date_end.' 23:59:59"';
            } 
            if($min_price!=-1)  $condition .= ' and ticket_price >= '.$min_price.'';
            if($max_price!=-1)  $condition .= ' and ticket_price <= '.$max_price.'';
            $order_by = 'id '.$order_type;
        }
        if($condition!='') $isSearch = 1;
        else $isSearch = 0;
        $this->paging['event'] = $this->load_library('Pagination');
        $count_row = count($this->ajaxModel->getEventData(0, 0, $condition, $order_by));
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['event']->setValue($count_row, $page, EVENT_LIMIT, "");
        $data = $this->ajaxModel->getEventData(EVENT_LIMIT, $this->paging['event']->offset, $condition, $order_by);
        return $this->view('backend.ajax.event.paging_event', [
            'data'      => $data,
            'paging_event'=>$this->paging['event'],
            'isSearch'  => $isSearch,
            'search'    => $search,
        ]);
    }
    public function cre_event() {
        array_shift($_POST);
        $data = $_POST;
        $condition = 'event_code like "%EV%"';
        $max_event_code = $this->ajaxModel->select_max('event_code', 'ep_event', $condition);
        $max_code = (int)(str_replace('EV', '', $max_event_code['event_code'])) + 1;
        if ($max_code < 10)
            $data['event_code'] = 'EV00000' . ($max_code);
        else if ($max_code < 100)
            $data['event_code'] = 'EV0000' . ($max_code);
        else if ($max_code < 1000)
            $data['event_code'] = 'EV000' . ($max_code);
        else if ($max_code < 10000)
            $data['event_code'] = 'EV00' . ($max_code);
        else if ($max_code < 100000)
            $data['event_code'] = 'EV0' . ($max_code);
        else if ($max_code < 1000000)
            $data['event_code'] = 'EV' . ($max_code);

        $data['time_start'] = $this->formatDate($data['time_start'], '/');
        $data['time_end'] = $this->formatDate($data['time_end'], '/');
        
        $folder_up = 'event';
        $upload_path = UPLOAD_PATH.$folder_up;
        $this->upload->set_upload_path($upload_path);
        // max file là 2Mb

        $this->upload->set_max_filesize(2048);

        if(!($this->upload->do_upload('event_img', 'no'))){
            echo $this->upload->get_error();
        }elseif(!($this->upload->do_upload('event_sub_img', 'no'))) {
            echo $this->upload->get_error();
        }else{
            $this->upload->do_upload('event_img');
            $data['event_img'] = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
            $this->upload->do_upload('event_sub_img');
            $data['event_sub_img'] = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
            $this->ajaxModel->store($data, 'ep_event');
            echo 'Successfully added event!';
        }
 
    }
    public function udp_event_base() {
        array_shift($_POST);
        $condition = 'event_name = "'.$_POST['event_name'].'" and id != "'.$_POST['id'].'"';
        $check = $this->ajaxModel->check_name($condition, 'ep_event');
        if(!empty($check)){
            echo 'Event name is exist!';
            return false;
        } else{
            $data = $_POST;
            $data['time_start'] = $this->formatDate($data['time_start'], '/');
            $data['time_end'] = $this->formatDate($data['time_end'], '/');
            $condition = 'id = "'.$data['id'].'"';
            $this->ajaxModel->updateField($data, $condition, 'ep_event');
            echo 'Successfully update!';
        }
    }
    public function del_event() {
        $id = $_POST['id'];
        $ev_condition   = 'id = "'.$id.'"';
        $fore_condition = 'event_id = "'.$id.'"';
        // $ord_detail_con = 'even_id = "'.$id.'"';
        $this->dropImg(['event_img'], 'ep_event', $ev_condition);
        $this->dropImg(['event_sub_img'], 'ep_event', $ev_condition);
        $this->dropImg(['des_img'], 'ep_even_description', $fore_condition);
        $this->ajaxModel->destroy($ev_condition, 'ep_event');
        $this->ajaxModel->destroy($fore_condition, 'ep_feedback');
        // $this->ajaxModel->destroy($ord_detail_con, 'ep_order_detail');
        $this->ajaxModel->destroy($fore_condition, 'ep_even_description');
        echo 'Successfully delete event!';
    }
    // ------- event detail ---------

    public function show_detail_event() {
        if(isset($_POST['id'])){
            $data = $this->ajaxModel->getEventDetail($_POST['id']);
            $condition = 'event_id = "'.$_POST['id'].'"';
            $description = $this->ajaxModel->getEventDescription($condition);
            // echo "<pre>";
            // var_dump($data);
            // echo "</pre>";
            $this->view('backend.ajax.event.event_detail', [
                'data'=>$data[0],
                'description'=>$description
            ]);
        }
    }
    public function show_detail_content_event() {
        if(isset($_POST['event_id'])){
            $data = $this->ajaxModel->getEventData(0, 0, "id = ".$_POST['event_id']);
            $description = $this->ajaxModel->getEventDescription("event_id = '".$_POST['event_id']."'");
            return $this->view('backend.ajax.event.event_detail_content', [
                'data'       => $data[0],
                'description'=> $description
            ]);
        }
    }
    public function show_add_content_event() {
        return $this->view('backend.ajax.event.event_add_content', [
            'id'=>$_POST['id']??'',
            'event_name'=>$_POST['event_name']??'',
        ]);
    }
    public function show_edit_content_event() {
        $condition = 'id = "'.$_POST['id'].'"';
        $description = $this->ajaxModel->getEventDescription($condition);
        $condition = 'id = "'.$_POST['event_id'].'"';
        $event_name = $this->ajaxModel->findField(['event_name'], 'ep_event', 1, 0, $condition);
        return $this->view('backend.ajax.event.event_edit_content', [
            'description'=>$description[0],
            'id'         =>$_POST['id'],
            'event_id'   =>$_POST['event_id'],
            'event_name' =>$event_name[0]['event_name']
        ]);
 
    }
    public function udp_event_detail() {
        $check = [];
        if(isset($_POST['id'])){
            $condition = 'event_name = "'.$_POST['event_name'].'" and id != "'.$_POST['id'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_event');
            if(!empty($check)){
                echo 'Event name is exist!';
                return false;
            } else{
                $data['event_name'] = $_POST['event_name'];
                $data['event_intro'] = $_POST['event_intro'];
                $condition = 'id = "'.$_POST['id'].'"';
                if(isset($_FILES)){
                    $folder_up = 'event';
                    $upload_path = UPLOAD_PATH.$folder_up;
                    $this->upload->set_upload_path($upload_path);
                    $this->upload->set_max_filesize(2048);
           
                    if(isset($_FILES['event_img']) && !($this->upload->do_upload('event_img', 'no'))){
                        echo $this->upload->get_error();
                        return false;
                    } 
                    if(isset($_FILES['event_sub_img']) && !($this->upload->do_upload('event_sub_img', 'no'))) {
                        echo $this->upload->get_error();
                        return false;
                    }
                    if($this->upload->do_upload('event_img')){
                        $this->dropImg(['event_img'], 'ep_event', $condition);
                        $data['event_img'] = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
                    }
                    if($this->upload->do_upload('event_sub_img')){
                        $this->dropImg(['event_sub_img'], 'ep_event', $condition);
                        $data['event_sub_img'] = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
                    }
                }
                $this->ajaxModel->updateField($data, $condition, 'ep_event');
                $data = $this->ajaxModel->findAny(['event_name, event_intro, event_img'], $condition, 'ep_event');
                $data = $data[0];
                $html  = "<button onclick='show_edit_detail_event(".'"#event-edit"'.")' class='btn btn-edit post_detail-btn' style='display: none;'><i class='fas fa-edit edit-item'></i><span>Edit</span></button>";
                $html .= "<img width='100%' height='100%' src='".$data['event_img']."' alt='SHARKS!'>";
                $html .= "<div class='post_detail-title'>";
                $html .=     "<div class='text text-light'>";
                $html .=         "<h1>".$data['event_name']."</h1>";
                $html .=         "<h5>".$data['event_intro']."</h5>";
                $html .=     "</div>";
                $html .= "</div>";

                echo $html;
            }
        }
    }
    public function udp_event_detail_base() {
        if(isset($_POST['id'])){
            array_shift($_POST);
            $id = array_shift($_POST);
            $data = $_POST;
            $data['time_start'] = $this->formatDate($data['time_start'], '/');
            $data['time_end'] = $this->formatDate($data['time_end'], '/');
            $condition = 'id = "'.$id.'"';
            $this->ajaxModel->updateField($data, $condition, 'ep_event');
            $dataAfter = $this->ajaxModel->getEventDetail($id);
            // echo "<pre>";
            // print_r($dataAfter);
            return $this->view('backend.ajax.event.event_detail_base', [
                'data'=>$dataAfter[0]
            ]);
        }
    }
    public function cre_content_event() {
        $data = array();
        $check = [];
        if(isset($_POST)){
            $condition = 'des_name = "'.$_POST['des_name'].'" and event_id = "'.$_POST['event_id'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_even_description');
            if(!empty($check)){
                echo 'Name content is exist!';
                return false;
            }
            array_shift($_POST);
            $data = $_POST;
        }
        if(isset($_FILES['des_img'])){
            $folder_up = 'event';
            $upload_path = UPLOAD_PATH.$folder_up;
            $this->upload->set_upload_path($upload_path);
            $this->upload->set_max_filesize(2048);
            if($this->upload->do_upload('des_img')){
                $data['des_img']  = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
            }else{
                echo $this->upload->get_error();
                return false;
            }
        } 
        $this->ajaxModel->store($data, 'ep_even_description');
        echo 'Successfully added content!';
    }
    public function udp_content_event() {
        if(isset($_POST['id'])){
            $condition = 'des_name = "'.$_POST['des_name'].'" and event_id = "'.$_POST['event_id'].'" and id != "'.$_POST['id'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_even_description');
            if(!empty($check)){
                echo 'Name content is exist!';
                return false;
            }
            $condition = 'id = "'.$_POST['id'].'"';
            $data['event_id'] = $_POST['event_id'];
            $data['des_name'] = $_POST['des_name'];
            $data['des_content'] = $_POST['des_content'];

            if(isset($_FILES['des_img'])){
                $folder_up = 'event';
                $upload_path = UPLOAD_PATH.$folder_up;
                $this->upload->set_upload_path($upload_path);
                $this->upload->set_max_filesize(2048);
                if($this->upload->do_upload('des_img')){
                    $this->dropImg(['des_img'], 'ep_even_description', $condition);
                    $data['des_img']  = $this->upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
                    $this->ajaxModel->updateField($data, $condition,'ep_even_description');
                    echo "<h3>Curren image</h3>
                         <img width='90%' src='".$data['des_img']."' alt='no_image'>";
                }else{
                    echo $this->upload->get_error();
                }
            }else{
                $condition = 'id = "'.$_POST['id'].'"';
                $this->ajaxModel->updateField($data, $condition,'ep_even_description');
                echo 'Successfully update content!';
            }
        }
    }
    public function del_content_event() {
        if(isset($_POST['id'])){
            $condition = 'id = "'.$_POST['id'].'"';
            $this->dropImg(['des_img'], 'ep_even_description', $condition);
            $this->ajaxModel->destroy($condition, 'ep_even_description');
            echo 'Successfully delete content!';
        }
    }

    // =================== Customer ==================
    public function load_cus() {
        $count_row = $this->ajaxModel->getCountRecord('ep_customer');
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['cus'] = $this->load_library('Pagination');
        $this->paging['cus']->setValue($count_row, $page, CUSTOMER_LIMIT, "");
        $data = $this->ajaxModel->getCustomerData(CUSTOMER_LIMIT, $this->paging['cus']->offset);

        $total_all = $this->ajaxModel->getTotalAll();

        return $this->view('backend.customer.index', [
            'data'=>$data,
            'num_customers' =>$count_row,
            'total_all'     =>$total_all,
            'paging_cus'=>$this->paging['cus']
        ]);
    }
    public function cus_paging() {
        $condition = '1';
        $having = '1';
        $order = '';
        if(isset($_POST)){
            $search_text = $_POST['search_text'];
            $type_s      = $_POST['type_s'];
            $search_op   = $_POST['search_op'];
            $order_by    = $_POST['order_by'];
            $order_type  = $_POST['order_type']??'asc';
            if($search_text != ''){
                if($type_s=='false') $percent = '';
                else $percent = '%';
                $condition .= ' and (username like "'.$percent.$search_text.'%"';
                $condition .= ' OR cus_name like "'.$percent.$search_text.'%"';
                $condition .= ' OR phone like "'.$percent.$search_text.'%"';
                $condition .= ' OR email like "'.$percent.$search_text.'%")';
            }
            switch ($search_op) {
                case '1':
                    $having .= ' and total_money > 0';
                    break;
                case '2':
                    $having .= ' and total_money is null';
                    break;
                case '3':
                    $condition .= ' and a.status = 1';
                    break;
                case '4':
                    $condition .= ' and a.status = 0';
                    break;
            }
            switch ($order_by) {
                case 'normal':
                    $order = 'customer_code '.$order_type;
                    break;
                case 'lastBuy':
                    $order = 'last_purchase '.$order_type;
                    break;
                case 'total':
                    $order = 'total_money '.$order_type;
                    break;
            }
        }
        // echo "$condition <br> $having <br> $order";die;
        $this->paging['cus'] = $this->load_library('Pagination');
        $count_row = $this->ajaxModel->getCountRecord('ep_customer');
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['cus']->setValue($count_row, $page, CUSTOMER_LIMIT, "");
        $data = $this->ajaxModel->getCustomerData(CUSTOMER_LIMIT, $this->paging['cus']->offset, $condition, $having, $order);

        $total_all = $this->ajaxModel->getTotalAll();
  
        return $this->view('backend.ajax.customer.paging_cus', [
            'data'=>$data,
            'num_customers' =>$count_row,
            'total_all'     =>$total_all,
            'paging_cus'=>$this->paging['cus']
        ]);
    }
    public function cus_detail_paging() {
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $all_data = $this->ajaxModel->getCus_order($id);
            $count_row = count($all_data);
            $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
            $this->paging['cus_detail'] = $this->load_library('Pagination');
            $this->paging['cus_detail']->setValue($count_row, $page, CUS_DETAIL_LIMIT, "");
            $cusOrder = $this->ajaxModel->getCus_order($id, CUS_DETAIL_LIMIT, $this->paging['cus_detail']->offset);
 
            if(!empty($cusOrder)){
                $cus_odrDetail = [];
                $total_moneyAll = 0;
                foreach ($cusOrder as $val){
                    $cus_odrDetail[] = $this->ajaxModel->getCus_ordDetail($id, $val['id']);
                }
                foreach ($all_data as $val){
                    $total_moneyAll+=$val['total_money'];
                }
            }
            return $this->view('backend.ajax.customer.paging_cus_detail', [
                'cusOrder'=>$cusOrder,
                'cus_odrDetail'=>$cus_odrDetail,
                'paging_cus_detail'=>$this->paging['cus_detail'],
                'total_order'=>$count_row,
                'total_moneyAll'=>$total_moneyAll,
                'cus_id'=>$id,
            ]);
        }
    }
    public function cre_cus() {
        if(isset($_POST['username'])){
            $condition = 'username = "'.$_POST['username'].'"';
            $check = $this->ajaxModel->check_name($condition, 'ep_customer');
            if(count($check)>0){
                echo 'User name is exist!';
                return false;
            }
            array_shift($_POST);
            $data = $_POST;

            $condition = 'customer_code like "%KH%"';
            $max_event_code = $this->ajaxModel->select_max('customer_code', 'ep_customer', $condition);
            $max_code = (int)(str_replace('KH', '', $max_event_code['customer_code'])) + 1;
            if ($max_code < 10)
                $data['customer_code'] = 'KH00000' . ($max_code);
            else if ($max_code < 100)
                $data['customer_code'] = 'KH0000' . ($max_code);
            else if ($max_code < 1000)
                $data['customer_code'] = 'KH000' . ($max_code);
            else if ($max_code < 10000)
                $data['customer_code'] = 'KH00' . ($max_code);
            else if ($max_code < 100000)
                $data['customer_code'] = 'KH0' . ($max_code);
            else if ($max_code < 1000000)
                $data['customer_code'] = 'KH' . ($max_code);

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['datebirth'] = $this->formatDate($data['datebirth']);
            $this->ajaxModel->store($data, 'ep_customer');
            echo 'Successfully added customer!';
        }
    }
    public function udp_cus() {
        if(isset($_POST['id'])){
            array_shift($_POST);
            $id = array_shift($_POST);
            $condition = 'id = "'.$id.'"';
            $data = $_POST;
            $data['datebirth'] = $this->formatDate($data['datebirth']);
            $this->ajaxModel->updateField($data, $condition, 'ep_customer');
            $cusInfo = $this->ajaxModel->getCustomerInfo($id);
            return $this->view('backend.ajax.customer.cus_detail_info', [
                'cusInfo'=>$cusInfo,
            ]);
        }
    }
    public function udp_cus_status() {
        if(isset($_POST['id'])){
            $condition = 'id = "'.$_POST['id'].'"';
            $data['status'] = $_POST['status'];
            $this->ajaxModel->updateField($data, $condition, 'ep_customer');
            echo 'Successfully updated status!';
        }
    }
    public function del_cus() {
        if(isset($_POST['cus_id'])){
            $condition = 'customer_id = "'.$_POST['cus_id'].'"';
            $cus_ordStatus = $this->ajaxModel->findAny(['id, status'], $condition, 'ep_order');
            
            foreach($cus_ordStatus as $val){
                if($val['status']==1 || $val['status']==2){
                    echo 'Can not remove users while still Unapproved bill';
                    return false;
                }
            }
            $this->ajaxModel->destroy($condition, 'ep_feedback');
            $this->ajaxModel->destroy($condition, 'ep_order');
            foreach($cus_ordStatus as $val){
                $condition = 'order_id = "'.$val['id'].'"';
                $this->ajaxModel->destroy($condition, 'ep_order_detail');
            }
            $condition = 'id = "'.$_POST['cus_id'].'"';
            $this->ajaxModel->destroy($condition, 'ep_customer');
            echo 'Successfully deleted!';
        }
    }
    public function show_detail_cus() {
        
        if(isset($_POST['id'])){
            $id = $_POST['id'];

            $this->paging['cus_detail'] = $this->load_library('Pagination');
            $count_row = count($this->ajaxModel->getCus_order($id));
            $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
            $this->paging['cus_detail']->setValue($count_row, $page, CUS_DETAIL_LIMIT, "");
            $cusOrder = $this->ajaxModel->getCus_order($id, CUS_DETAIL_LIMIT, $this->paging['cus_detail']->offset);

            $cusInfo = $this->ajaxModel->getCustomerInfo($id);

            if(!empty($cusOrder)){
                $cus_odrDetail = [];
                $total_moneyAll = 0;
                foreach ($cusOrder as $val){
                    $cus_odrDetail[] = $this->ajaxModel->getCus_ordDetail($id, $val['id']);
                }
                foreach ($this->ajaxModel->getCus_order($id) as $val){
                    $total_moneyAll+=$val['total_money'];
                }
            }
            return $this->view('backend.ajax.customer.cus_detail', [
                'cusInfo'=>$cusInfo,
                'cusOrder'=>$cusOrder,
                'cus_odrDetail'=>$cus_odrDetail??0,
                'paging_cus_detail'=>$this->paging['cus_detail'],
                'total_order'=>$count_row,
                'total_moneyAll'=>$total_moneyAll??0,
            ]);
        }
    }
    public function show_order_history_cus() {
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $this->paging['cus_detail'] = $this->load_library('Pagination');
            $count_row = count($this->ajaxModel->getCus_order($id));
            $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
            $this->paging['cus_detail']->setValue($count_row, $page, CUS_DETAIL_LIMIT, "");
            $cusOrder = $this->ajaxModel->getCus_order($id, CUS_DETAIL_LIMIT, $this->paging['cus_detail']->offset);
 
            if(!empty($cusOrder)){
                $cus_odrDetail = [];
                $total_moneyAll = 0;
                foreach ($cusOrder as $val){
                    $cus_odrDetail[] = $this->ajaxModel->getCus_ordDetail($id, $val['id']);
                }
                foreach ($this->ajaxModel->getCus_order($id) as $val){
                    $total_moneyAll+=$val['total_money'];
                }
            }
            return $this->view('backend.ajax.customer.cus_detail_history', [
                'cusOrder'=>$cusOrder,
                'cus_odrDetail'=>$cus_odrDetail,
                'paging_cus_detail'=>$this->paging['cus_detail'],
                'total_order'=>$count_row,
                'total_moneyAll'=>$total_moneyAll,
                'cus_id'=>$id,
            ]);
        }
    }
    public function show_order_detail_cus() {
        if(isset($_POST['id'])){
            $condition = 'a.id = "'.$_POST['id'].'"';
            $dataOrders = $this->ajaxModel->getDataOrder(1, 0, $condition);
            if(!empty($dataOrders[0]['id'])){
                $dataOrdDetail = $this->ajaxModel->getDataOdrDetail($dataOrders[0]['id']);
            }
            $condition = 'id = "'.$_POST['id'].'"';
            $cusId = $this->ajaxModel->findAny(['customer_id'], $condition, 'ep_order');
            $orderMethod = $this->ajaxModel->getOrderMethod();
            
            return $this->view('backend.ajax.customer.cus_detail_order', [
                'dataOrder'     =>$dataOrders[0]??'',
                'dataOrdDetail' =>$dataOrdDetail??'',
                'orderMethod'   =>$orderMethod??'',
                'cusId'=>$cusId[0]['customer_id']??'',
            ]);
        }
    }
    public function del_order_cus() {
        if(isset($_POST['orderId'])){
            $order_id = $_POST['orderId'];
            $condition = 'id = "'.$order_id.'"';
            $this->ajaxModel->destroy($condition, 'ep_order');
            $condition = 'order_id = "'.$order_id.'"';
            $this->ajaxModel->destroy($condition, 'ep_order_detail');
            echo 'Successfully deleted!';
        }
    }
    // ==================== Orders ====================
    public function load_order() {
        $all_data = $this->ajaxModel->getDataOrder();
        $count_row = count($all_data);
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['orders'] = $this->load_library('Pagination');
        $this->paging['orders']->setValue($count_row, $page, ORDERS_LIMIT, "");
        $dataOrders = $this->ajaxModel->getDataOrder(ORDERS_LIMIT, $this->paging['orders']->offset);
        
        if(!empty($dataOrders)){
            $dataOrdDetail = [];
            $total_moneyAll = 0;
            foreach ($dataOrders as $val){
                $dataOrdDetail[] = $this->ajaxModel->getDataOdrDetail($val['id']);   
            }
            foreach ($all_data as $val){
                $total_moneyAll+=$val['total_money'];
            }
        }

        // $last_week = date('Y-m-d', strtotime('-1 week'));
        // $condition = '(a.status in(1) and order_date > "'.$last_week.'") or order_update like "0000%"';
        $condition = 'a.status = 1 or order_update like "0000%"';
        $dataOrdNotice = $this->ajaxModel->getDataOdrNotice(ORDERS_NOTICE_LIMIT, 0, $condition);
        
        $total_unprocessed = $this->ajaxModel->getCountRecord('ep_order', 'status = 1 and check_view = 0');
        $total_notice = $this->ajaxModel->getCountRecord('ep_order', 'status = 1');

        return $this->view('backend.orders.index', [
            'dataOrders'    =>$dataOrders,
            'dataOrdDetail' =>$dataOrdDetail,
            'dataOrdNotice' =>$dataOrdNotice,
            'total_unprocessed'=>$total_unprocessed,
            'total_notice'  =>$total_notice,
            'total_order'   =>$count_row,
            'total_moneyAll'=>$total_moneyAll,
            'paging_orders' =>$this->paging['orders'],
        ]);
    }
    public function order_paging() {
        $condition = '1';
        $having = '1';
        $order = '';
        if(isset($_POST)){
            $search_text = $_POST['search_text'];
            $type_s      = $_POST['type_s'];
            $search_op   = $_POST['search_op']??[];
            $date_start  = $_POST['date_start'];
            $date_end    = $_POST['date_end'];
            $order_by    = $_POST['order_by'];
            $order_type  = $_POST['order_type']??'asc';

            if($search_text != ''){
                if($type_s=='false') $percent = '';
                else $percent = '%';
                $condition .= ' and (order_code like "'.$percent.$search_text.'%"';
                $condition .= ' OR name like "'.$percent.$search_text.'%"';
                $condition .= ' OR cus_name like "'.$percent.$search_text.'%")';
            }
            if(!empty($search_op)){
                $op = implode(', ', $search_op);
                $condition .= ' and a.status in('.$op.')';
            }
            if($date_start != 'false'){
                $condition .= ' and order_date > "'.$date_start.'"';
            }
            if($date_end != 'false'){
                $condition .= ' and order_date < "'.$date_end.' 23:59:59"';
            }
            switch ($order_by) {
                case 'normal':
                    $order = 'order_code '.$order_type;
                    break;
                case 'orderDate':
                    $order = 'order_date '.$order_type;
                    break;
                case 'total':
                    $order = 'total_money '.$order_type;
                    break;
            }
        }
        $all_data = $this->ajaxModel->getDataOrder(0, 0, $condition, $having, $order);
        $count_row = count($all_data);
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['orders'] = $this->load_library('Pagination');
        $this->paging['orders']->setValue($count_row, $page, ORDERS_LIMIT, "");
        $dataOrders = $this->ajaxModel->getDataOrder(ORDERS_LIMIT, $this->paging['orders']->offset, $condition, $having, $order);
        
        if(!empty($dataOrders)){
            $dataOrdDetail = [];
            $total_moneyAll = 0;
            foreach ($dataOrders as $val){
                $dataOrdDetail[] = $this->ajaxModel->getDataOdrDetail($val['id']);   
            }
            foreach ($all_data as $val){
                $total_moneyAll+=$val['total_money'];
            }
        }
        return $this->view('backend.ajax.orders.paging_orders', [
            'dataOrders'    =>$dataOrders,
            'dataOrdDetail' =>$dataOrdDetail??'',
            'total_order'   =>$count_row,
            'total_moneyAll'=>$total_moneyAll??'',
            'paging_orders' =>$this->paging['orders'],
        ]);
    }
    public function load_notice() {
        if(isset($_POST)){
            $limit     = $_POST['limit']??0; 
            $offset    = $_POST['offset']??0;
            // $last_week = date('Y-m-d', strtotime('-1 week'));
            $condition = 'a.status = 1 or order_update like "0000%"';
            $dataOrdNotice = $this->ajaxModel->getDataOdrNotice($limit, $offset, $condition);
            $html = '';
            if(!empty($dataOrdNotice)){
                foreach ($dataOrdNotice as $val):
                    $pColor = $val['check_view'] == 0 ? '#f2f2f2' : '#a2a2a2';
                    $sColor = $val['check_view'] == 0 ? '#478fca' : '#a2a2a2';
                    $sDis   = $val['check_view'] == 0 ? '' : 'display: none;';
                    $sDate  = date_format(date_create($val['order_date']), 'Y-m-d H:i:s');
                    $html .= "<li onclick='show_detail_order(". $val['id'].")'>";
                    $html .= "    <span>". $val['order_code']."</span>";
                    $html .= "    <span>";
                    $html .= "        <p style='margin-bottom: 0; color: ".$pColor.";'>". $val['cus_name']." has placed a new order</p>";
                    $html .= "        <span style='font-size: 1rem; ;color: ".$sColor.";'><time class='time_notice' datetime='".$sDate."'> </time></span>";
                    $html .= "    </span>";
                    $html .= "    <span class='text-center' style='color: #478fca; ".$sDis."'><i class='fas fa-circle'></i></span>";
                    $html .= "</li>";
                endforeach;
                echo $html;
            }  
        } 
    }
    public function show_detail_order() {
        if(isset($_POST['id'])){

            $condition = 'a.id = "'.$_POST['id'].'"';
            $dataOrders = $this->ajaxModel->getDataOrder(1, 0, $condition);
            if(!empty($dataOrders[0]['id'])){
                $dataOrdDetail = $this->ajaxModel->getDataOdrDetail($dataOrders[0]['id']);
            }
            $condition = 'id = "'.$_POST['id'].'"';
            $cusId = $this->ajaxModel->findAny(['customer_id'], $condition, 'ep_order');
            $orderMethod = $this->ajaxModel->getOrderMethod();
            
            $data['check_view'] = 1;
            $this->ajaxModel->updateField($data, $condition, 'ep_order');

            return $this->view('backend.ajax.orders.odr_detail', [
                'dataOrder'     =>$dataOrders[0]??'',
                'dataOrdDetail' =>$dataOrdDetail??'',
                'orderMethod'   =>$orderMethod??'',
                'cusId'         =>$cusId[0]['customer_id']??'',
                'type'          =>$_POST['type']??'',
                'option'        =>$_POST['option']??0
            ]);
        }
    }
    public function udp_order_status() {
        if(isset($_POST['orderId'])){
            $condition = 'id = "'.$_POST['orderId'].'"';
            $data['status'] = $_POST['status'];
            $data['order_update'] = date('Y-m-d H:i:s');
            $this->ajaxModel->updateField($data, $condition, 'ep_order');
            $dataOrders = $this->ajaxModel->findAny(['id', 'status'], $condition, 'ep_order');

            return $this->view('backend.ajax.orders.odr_detail_status', [
                'dataOrder'=>$dataOrders[0]??'',
            ]);
        }
    }
    public function del_order() {
        if(isset($_POST['orderId'])){
            $order_id = $_POST['orderId'];
            $condition = 'id = "'.$order_id.'"';
            $this->ajaxModel->destroy($condition, 'ep_order');
            $condition = 'order_id = "'.$order_id.'"';
            $this->ajaxModel->destroy($condition, 'ep_order_detail');
            echo 'Successfully deleted!';
        }
    }
    // ==================== Revenue ====================
    public function load_revenue() {
        return $this->view('backend.revenues.index');
    }
    public function revenue_paging() {
        if(isset($_POST['option'])){
            $condition = '1';
            $sub_cond  = '1';
            $having    = '1';
            $order_by  = '';
            $option = $_POST['option'];
            $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
            $this->paging['revenue'] = $this->load_library('Pagination');
            
            if(isset($_REQUEST['page'])){
                $cond = $this->revenue_cond();
                if($cond){
                    $condition  .= $cond['condition'];
                    $sub_cond   .= $cond['sub_cond'];
                    $having     .= $cond['having'];
                    $order_by   .= $cond['order_by'];
                }
            }

            $report = $this->ajaxModel->getProductReport($condition);
            $data['total_quantityAll']  = $report['total_quantityAll'];
            $data['total_moneyAll']     = $report['total_moneyAll'];

            if($option == 1){
                $condition .= ' and a.status = 3';
                $all_data = $this->ajaxModel->getDataOrder(0, 0, $condition, $having, $order_by);
                $count_row = $data['total_order'] = count($all_data);
                $this->paging['revenue']->setValue($count_row, $page, REVENUE_LIMIT, "");
                $data['orders'] = $this->ajaxModel->getDataOrder(REVENUE_LIMIT, $this->paging['revenue']->offset, $condition, $having, $order_by);    
                $data['ord_detail'] = [];
                if(!empty($data['orders'])){
                    foreach ($data['orders'] as $val){
                        $data['ord_detail'][] = $this->ajaxModel->getDataOdrDetail($val['id']);   
                    }
                }
                return $this->view('backend.ajax.revenues.summary', [
                    'data' => $data,
                    'paging_revenue' =>$this->paging['revenue'],
                ]);
            } elseif($option == 2){
                $condition .= ' and b.status = 3';
                $all_data = $this->ajaxModel->getCustomerData(0, 0, $condition, $having, $order_by);

                $count_row = $data['total_customer'] = count($all_data);
                $this->paging['revenue']->setValue($count_row, $page, REVENUE_LIMIT, "");
                $data['customer'] = $this->ajaxModel->getCustomerData(REVENUE_LIMIT, $this->paging['revenue']->offset, $condition, $having, $order_by);
                
                $data['ord_list'] = [];
                if(!empty($data['customer'])){
                    $i = 0;
                    foreach ($data['customer'] as $val){
                        $condition = $sub_cond.' and customer_id = "'. $val['id'].'" and a.status = 3';
                        $data['ord_list'][$i] = $this->ajaxModel->getDataOrder(0, 0, $condition);
                        $i++;
                    }
                }
                return $this->view('backend.ajax.revenues.customer', [
                    'data' => $data,
                    'paging_revenue' =>$this->paging['revenue'],
                ]);
            } elseif($option == 3){
                $condition .= ' and c.status = 3';
                $all_data = $this->ajaxModel->getRevProductData(0, 0, $condition, $order_by);
                $count_row = $data['total_product'] = count($all_data);
                $this->paging['revenue']->setValue($count_row, $page, REVENUE_LIMIT, "");
                $data['product'] = $this->ajaxModel->getRevProductData(REVENUE_LIMIT, $this->paging['revenue']->offset, $condition, $order_by);
 
                return $this->view('backend.ajax.revenues.product', [
                    'data' => $data,
                    'paging_revenue' =>$this->paging['revenue'],
                ]);
            }
        } 
    }
    public function revenue_cond() {
        if(isset($_POST['option'])){
            $cond['condition'] = '';
            $cond['sub_cond'] = '';
            $cond['having']    = '';
            $cond['order_by']  = '';

            $search_text = $_POST['search_text'];
            $type_s      = $_POST['type_s'];
            $date_start  = $_POST['date_start'];
            $date_end    = $_POST['date_end'];
            $order_type  = $_POST['order_type'];
            
            $option = $_POST['option'];
            if($option == 1){
                if($search_text != ''){
                    if($type_s=='false') $percent = '';
                    else $percent = '%';
                    $cond['condition'] .= ' and (order_code like "'.$percent.$search_text.'%"';
                    $cond['condition'] .= ' OR name like "'.$percent.$search_text.'%"';
                    $cond['condition'] .= ' OR cus_name like "'.$percent.$search_text.'%")';
                }
                if($date_start != 'false'){
                    $cond['condition'] .= ' and order_date > "'.$date_start.'"';
                }
                if($date_end != 'false'){
                    $cond['condition'] .= ' and order_date < "'.$date_end.' 23:59:59"';
                }
                $cond['order_by'] = 'order_code '.$order_type;
            } elseif($option == 2){
                if($search_text != ''){
                    if($type_s=='false') $percent = '';
                    else $percent = '%';
                    $cond['condition'] .= ' and (customer_code like "'.$percent.$search_text.'%"';
                    $cond['condition'] .= ' OR cus_name like "'.$percent.$search_text.'%"';
                    $cond['condition'] .= ' OR phone like "'.$percent.$search_text.'%"';
                    $cond['condition'] .= ' OR email like "'.$percent.$search_text.'%")';
                }
                if($date_start != 'false'){
                    $cond['condition'] .= ' and order_date > "'.$date_start.'"';
                    $cond['sub_cond'] .= ' and order_date > "'.$date_start.'"';
                }
                if($date_end != 'false'){
                    $cond['condition'] .= ' and order_date < "'.$date_end.' 23:59:59"';
                    $cond['sub_cond'] .= ' and order_date < "'.$date_end.' 23:59:59"';
                }
                $cond['order_by'] = 'customer_code '.$order_type;
            } elseif($option == 3){
                if($search_text != ''){
                    if($type_s=='false') $percent = '';
                    else $percent = '%';
                    $cond['condition'] .= ' and (event_code like "'.$percent.$search_text.'%"';
                    $cond['condition'] .= ' OR event_name like "'.$percent.$search_text.'%")';
                 
                }
                if($date_start != 'false'){
                    $cond['condition'] .= ' and order_date > "'.$date_start.'"';
                }
                if($date_end != 'false'){
                    $cond['condition'] .= ' and order_date < "'.$date_end.' 23:59:59"';
                }
                $cond['order_by'] = 'event_code '.$order_type;
            }
            return $cond;
        }
    }
}