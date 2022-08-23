<?php

class AjaxController extends BaseController{

    private $ajaxModel;

    public function __construct() {
        $this->ajaxModel = $this->load_model_public('AjaxModel');
    }
  
    // =========== fg_pass =============
    public function load_login() {

        return $this->view('frontend.auth.success');
    }
    public function load_registration() {
        return $this->view('frontend.auth.registration');
    }
    public function find_account() {
        return $this->view('frontend.auth.find_account');
    }
    public function confirm_account() {
        if(isset($_POST['email'])){
            $condition = 'email = "'.$_POST['email'].'" and username not like "%@%"';
            $info_acc = $this->ajaxModel->findAny(['id, cus_name, avatar, email'], $condition, 'ep_customer');
            return $this->view('frontend.auth.confirm_account', [
                'info_acc' => $info_acc[0]??''
            ]);
        }else{
            $this->load_login();
        }
    }
    public function send_mail() {
        if(isset($_POST['data'])){
            $data = (array) json_decode($_POST['data']);
            $token = $this->rand_str(6, 'int');
            
            $this->view("frontend.auth.check_code", [
                'email' => $data['email']
            ]);

            if($this->sanitize_my_email($data['email'])){
                $content = "Hello ".$data['cus_name'].",\r\n\n\tWe have received your password reset request.\r\n\tEnter the following password reset code: $token";
                mail($data['email'], "Reset Password", "$content", "From: son.nc.993@aptechlearning.edu.vn\r\n");
                $condition = 'email = "'.$data['email'].'" and username not like "%@%"';
                $this->ajaxModel->updateField(['token'=>$token], $condition, 'ep_customer');
            }
        }
    }
    public function check_code() {
        if(isset($_POST['token'])){
            $token = $_POST['token'];
            $email = $_POST['email'];
            $condition = 'token = "'.$token.'" and email like "'.$email.'" and username not like "%@%"';
            $count = $this->ajaxModel->getRecord('ep_customer', $condition);
            if($count == 0){
                echo 'Verification incorrect';
            }else{
                return $this->view('frontend.auth.reset', [
                    'email' => $email,
                    'token' => $token,
                ]);
            }
        }else{
            $this->load_login();
        }
    }
    public function reset_pass() {
        if(isset($_POST['email']) && isset($_POST['token'])){
            $token = $_POST['token'];
            $email = $_POST['email'];
            $new_pass = $_POST['new_pass'];
            $condition = 'token = "'.$token.'" and email like "'.$email.'" and username not like "%@%"';
            $this->ajaxModel->updateField(['token'=>'0', 'password'=> password_hash($new_pass, PASSWORD_DEFAULT)], $condition, 'ep_customer');
            return $this->view('frontend.auth.success', [
                'success' => 'You have successfully changed your password.',
            ]);
        }else{
            $this->load_login();
        }
    }

    public function register_check_username($check = 0) {
        if(isset($_POST['username'])){
            $condition = 'username = "'.$_POST['username'].'"';
            $username = $this->ajaxModel->check_name($condition, 'ep_customer');
            if(empty($username)){
                if($check == 0) echo '1';
                return 1;
            }else{
                if($check == 0) echo '0';
                return 0;
            }
        }
    }

    public function register_check_email($check = 0) {
        if(isset($_POST['email'])){
            $condition = 'email = "'.$_POST['email'].'" and username not like "%@%"';
            $email = $this->ajaxModel->check_name($condition, 'ep_customer');
            if(empty($email)){
                if($check == 0) echo '1';
                return 1;
            }else{
                if($check == 0) echo '0';
                return 0;
            }
        }
    }

    public function register_account() {
        if(isset($_POST)){
            array_shift($_POST);
            $data = $_POST;
            $u_check = $this->register_check_username(1);
            $e_check = $this->register_check_email(1);
            if($u_check == 0){
                echo 'u_check';
                return false;
            }elseif($e_check == 0){
                echo 'e_check';
                return false;
            }
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
            $this->ajaxModel->store($data, 'ep_customer');
            return $this->view('frontend.auth.success', [
                'success' => 'You have successfully registered an account.',
            ]);
        }
    }

    // =============== home =================
    public function load_secondary_list() {
        if(isset($_POST['list_name'])){
            $list_name = $_POST['list_name'];
            if($list_name=='event'){
                $data = $this->ajaxModel->getListEventName();
            }elseif($list_name=='animal'){
                $list_groupId_lock = $this->category_lock();
                $list_groupId_lock = implode(', ', $list_groupId_lock);
                if($list_groupId_lock) $condition = ' and sea_group_id not in ('.$list_groupId_lock.')';
                else $condition = '';
                $data = $this->ajaxModel->getListAnimalName($condition);
                $listCate = $this->ajaxModel->getListCateName();
            }
            // echo '<pre>';
            // var_dump($data);die;
            return $this->view('frontend.block.secondary_list', [
                'data' => $data,
                'list_op'=> $_POST['list_name'],
                'listCate'=> $listCate??'',
            ]);
        }
    }
    public function searchGlobal_paging() {
        $searchModel = $this->load_model_public('SearchModel');

        if(isset($_POST['s'])){
            $s = $_POST['s'];
        }
        $keyword = explode(' ', $s);
        $condition = 'name like "%'.$s.'%" or ';
        
        foreach($keyword as $val){
            $condition .= 'name like "%'.$val.'%" or excerpt like "%'.$val.'%" or ';
        }
  
        $all_data = $searchModel->getDataSearch(0, 0, rtrim($condition, 'or '));
        $count_row = count($all_data);
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['search'] = $this->load_library('Pagination');
        $this->paging['search']->setValue($count_row, $page, SEARCH_GLOBAL_LIMIT, "");
        $data_search = $searchModel->getDataSearch(SEARCH_GLOBAL_LIMIT, $this->paging['search']->offset, rtrim($condition, 'or '));

        return $this->view('frontend.ajax.search.paging_search', [
            'data_search'=>$data_search,
            'paging_search' =>$this->paging['search'],
        ]);
    }
    // ============ Animal Guide ==============
    public function load_more_animalG() {
        if(isset($_POST)){
            $limit     = $_POST['limit']??0; 
            $offset    = $_POST['offset']??0;
            $condition = $this->search_animalG(1);
            $data = $this->ajaxModel->getAnimalGuideData($limit, $offset, $condition);
            $html = '';
            foreach($data as $val):
                $html .="   <li>";
                $html .="       <a href='?controller=post&id=".$val['sea_id']."' class='item-guide'>";
                $html .="           <div class='photo'>";
                $html .="               <img width='100%' src='".$val['sea_sub_img']."'>";
                $html .="           </div>";
                $html .="           <div class='wrapper'>";
                $html .="               <h3 class='name'>".$val['sea_name']."</h3>";
                $html .="               <span class='category'>".$val['group_name']."</span>";
                $html .="           </div>";
                $html .="       </a>";
                $html .="   </li>";
            endforeach;

            echo $html;
        }
    }

    public function search_animalG($check_load = 0) {
        if(isset($_POST['search_text'])){
            $cate_name = '';
        
            $condition = '1';
            if($_POST['search_text'] != ''){
                $arr = explode(' ', $_POST['search_text']);
                $condition .= ' and (';
                foreach($arr as $val){
                    $condition .= 'sea_name like "%'.$val.'%" or ';
                }
                $condition = rtrim($condition, 'or ').')';
            }
            if($_POST['category_id'] != -1){
                $listCategory_id = $this->find_category_post([['id'=>$_POST['category_id']]]);
                $listCategory_id = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($listCategory_id)), 0);
                $list_id = implode(', ', $listCategory_id);
                $condition .= ' and sea_group_id in ('.$list_id.')';
                $cate_name = $this->ajaxModel->findAny(['group_name'], 'id = "'.$_POST['category_id'].'"', 'ep_sea_group');
            }
            $list_groupId_lock = $this->category_lock();
            $list_groupId_lock = implode(', ', $list_groupId_lock);
            if($list_groupId_lock) $condition .= ' and sea_group_id not in ('.$list_groupId_lock.')';
            
            if($check_load != 0) {
                return $condition;
            }

            $condition1 = $condition.' and status = 1';
            $count = $this->ajaxModel->getCountRecord('ep_sea_animal', $condition1);
            $data = $this->ajaxModel->getAnimalGuideData(ANIMAL_GUIDE_LIMIT, 0, $condition);
            $mess = ' "'.$_POST['search_text'].'" ';
            if($cate_name != '')
                $mess .= 'and category is "'.$cate_name[0]['group_name']??''.'"';
            
            $html = '';
            if($count>0):
                $html .="   <div class='row'>";
                $html .="       <h2 style='margin: 72px 0 36px;'>Results <span class='counter'>(".$count.")</span></h2>";
                $html .="   </div>";
                $html .="   <div class='row'>";
                $html .="       <div style='display: none;' id='page_dt' total = '".$count."' limit = '".ANIMAL_GUIDE_LIMIT."' lastId = '".count($data)."'></div>";
                $html .="       <ul class='all-guide' id='animal-guide'>";
            foreach($data as $val):
                $html .="           <li>";
                $html .="               <a href='?controller=post&id=".$val['sea_id']."' class='item-guide'>";
                $html .="                   <div class='photo'>";
                $html .="                       <img width='100%' src='".$val['sea_sub_img']."'>";
                $html .="                   </div>";
                $html .="                   <div class='wrapper'>";
                $html .="                       <h3 class='name'>".$val['sea_name']."</h3>";
                $html .="                       <span class='category'>".$val['group_name']."</span>";
                $html .="                   </div>";
                $html .="               </a>";
                $html .="           </li>";
            endforeach;
                $html .="       </ul>";
                $html .="       <div class='load_more'>";
                $html .="           <div class='load'>";
                $html .=                $this->get_animate_rotate();
                $html .="           </div>";
                $html .="           <button onclick='load_more_animalG(1);' class='btn btn-warning'>Load More ...</button>";
                $html .="       </div>";
                $html .="   </div>";
            else:
                $html .="       <div class='row'>";
                $html .="           <h3  style='margin: 24px 0; text-align: center;'>No result for ".$mess." !</h3>";
                $html .="       </div>";
            endif;
            echo $html;
        }
    }

    // ================== Event guide ==================
    public function load_more_eventG() {
        if(isset($_POST)){
            $limit     = $_POST['limit']??0; 
            $offset    = $_POST['offset']??0;
            $condition = 'status = 1';

            $condition = $this->search_eventG(1);
            $data = $this->ajaxModel->getEventData($limit, $offset, $condition);
            $html = '';
            foreach($data as $val):
                $html .="   <li>";
                $html .="       <a href='?controller=event&id=".$val['id']."' class='item-guide'>";
                $html .="           <div class='photo'>";
                $html .="               <img width='100%' src='".$val['event_sub_img']."'>";
                $html .="           </div>";
                $html .="           <div class='wrapper'>";
                $html .="               <h3 class='name'>".$val['event_name']."</h3>";
                $html .="               <span class='category'>Learn More</span>";
                $html .="           </div>";
                $html .="       </a>";
                $html .="   </li>";
            endforeach;

            echo $html;
        }
    }
    public function search_eventG($check_load = 0) {
       
        if(isset($_POST['search_text'])){
            $date_start  = $_POST['date_start'];
            $date_end    = $_POST['date_end'];
 
            $condition = 'status = 1';
            if($_POST['search_text'] != ''){
                $arr = explode(' ', $_POST['search_text']);
                $condition .= ' and (';
                foreach($arr as $val){
                    $condition .= 'event_name like "%'.$val.'%" or ';
                }
                $condition = rtrim($condition, 'or ').')';
            }
            if($date_start!=''){
                $date_start = $this->formatDate($date_start, '/'); 
                $condition .= ' and time_start >= "'.$date_start.'"';
            } 
            if($date_end!='')  {
                $date_end = $this->formatDate($date_end, '/'); 
                $condition .= ' and time_end <= "'.$date_end.' 23:59:59"';
            } 
            if($check_load != 0) {
                return $condition;
            }
            $count = $this->ajaxModel->getCountRecord('ep_event', $condition);
            $data = $this->ajaxModel->getEventData(EVENT_GUIDE_LIMIT, 0, $condition);
            $mess = ' "'.$_POST['search_text'].'" ';

            $html = '';
            if($count>0):
                $html .="   <div class='row'>";
                $html .="       <h2 style='margin: 72px 0 36px;'>Results <span class='counter'>(".$count.")</span></h2>";
                $html .="   </div>";
                $html .="   <div class='row'>";
                $html .="       <div style='display: none;' id='page_dt' total = '".$count."' limit = '".EVENT_GUIDE_LIMIT."' lastId = '".count($data)."'></div>";
                $html .="       <ul class='all-guide' id='event-guide'>";
            foreach($data as $val):
                $html .="           <li>";
                $html .="               <a href='?controller=event&id=".$val['id']."' class='item-guide'>";
                $html .="                   <div class='photo'>";
                $html .="                       <img width='100%' src='".$val['event_sub_img']."'>";
                $html .="                   </div>";
                $html .="                   <div class='wrapper'>";
                $html .="                       <h3 class='name'>".$val['event_name']."</h3>";
                $html .="                       <span class='category'>Learn More</span>";
                $html .="                   </div>";
                $html .="               </a>";
                $html .="           </li>";
            endforeach;
                $html .="       </ul>";
                $html .="       <div class='load_more'>";
                $html .="           <div class='load'>";
                $html .=                $this->get_animate_rotate();
                $html .="           </div>";
                $html .="           <button onclick='load_more_eventG(1);' class='btn btn-warning'>Load More ...</button>";
                $html .="       </div>";
                $html .="   </div>";
            else:
                $html .="       <div class='row'>";
                $html .="           <h3  style='margin: 24px 0; text-align: center;'>No result for ".$mess." !</h3>";
                $html .="       </div>";
            endif;
            echo $html;
        }
    }
    // ================ Event Single ==============
    public function submit_addToCard() {
        if(isset($_POST['event_id'])){
            $event_id = $_POST['event_id']??0;
            $price   = $_POST['ticket_price']??0;
            $gen_num = $_POST['gen_num']??0;
            $vip_num = $_POST['vip_num']??0;
            if($gen_num != 0){
                $_SESSION['cart'][$event_id][0]['number'] = $gen_num;
                $_SESSION['cart'][$event_id][0]['price'] = $price;
            }
            if($vip_num != 0){
                $_SESSION['cart'][$event_id][1]['number'] = $vip_num;
                $_SESSION['cart'][$event_id][1]['price'] = $price + 20;
            }
            $html = '';
            if (isset($_SESSION['cus_id'])) : 
                $html .=" <div class='info' onclick='FadeIn('.info .info-box', 200);'>";
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
                    $html .=" <span class='order_notice-quantity' style='left: -5px;'>".count($_SESSION['cart'])."</span>";
                endif;
                $html .="     <img height='40px' src='".$_SESSION['avatar']."' alt='IMG'>";
                $html .="     <div class='info-box'>";
                $html .="         <div>";
                $html .="             <div class='info-head'>";
                $html .="                 <div><img height='40px' src='".$_SESSION['avatar']."' alt=''></div>";
                $html .="                 <div class='cus_name'>".$_SESSION['cus_name']."</div>";
                $html .="             </div>";
                $html .="             <div class='info-bot'>";
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
                    $html .="                 <a href='?controller=cart'><i class='fas fa-cart-arrow-down' style='color: orange;'></i>&nbsp;&nbsp;<i class='fas fa-circle'></i><span>CHECK OUT</span></a>";
                else:
                    $html .="                 <a href='?controller=cart'><i class='fas fa-cart-arrow-down' style='color: orange;'></i>&nbsp;&nbsp;<span>CHECK OUT</span></a>";
                endif;
                $html .="                 <a href='?controller=account'><i class='fas fa-cog' style='color: #0a9928;'></i>&nbsp;&nbsp;<span>YOUR ACCOUNT</span></a>";
                $html .="                 <a href='?controller=auth&action=logout'><i class='fas fa-sign-out-alt'></i>&nbsp;&nbsp;<span>LOGOUT</span></a>";
                $html .="             </div>";
                $html .="         </div>";
                $html .="     </div>";
                $html .=" </div>";
            else : 
                $html .=" <div class='check-out'>";
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
                    $html .=" <span class='order_notice-quantity' style='right: 2px; padding: 2px 6px;'>".count($_SESSION['cart'])."</span>";
                endif;
                $html .="     <a href='?controller=cart' class='top-bar_hov'><span>CheckOut</span> <i class='fas fa-cart-arrow-down'></i></a>";
                $html .=" </div>";
                $html .=" <div class='login'><a href='?controller=auth' class='top-bar_hov'><span>LOGIN</span> <i class='fas fa-sign-in-alt'></i></a></div>";
            endif; 
            echo $html;
        }  
    }
    public function view_more_comment($feedback_id = 0) {
        if($_REQUEST['event_id'] <= 0 || !is_numeric($_REQUEST['event_id'])) return;
        if($feedback_id == 0){
            $condition = 'event_id = "'.$_REQUEST['event_id'].'"';
            $comment_data = $this->ajaxModel->getComment_event(9999, 3, $condition);
        }else{
            $condition = 'a.id = '.(int)$feedback_id;
            $comment_data = $this->ajaxModel->getComment_event(0, 0, $condition);
        }
        $html = '';
        if(count($comment_data) == 0) return;
        foreach ($comment_data as $val) : 
            $date = date_format(date_create($val['created']), 'Y-m-d H:i:s');
            $html .=" <div class='ava_name_cmt' id = 'cmt-".$val['id']."'>";
            $html .="     <figure class='comment_ava'>";
            $html .="         <img src='". $val['avatar']."' style='border-radius: 50%;'>";
            $html .="     </figure>";
            $html .="     <div class='name_cmt'>";
            $html .="         <p class='name'>".$val['cus_name']."</p>";
            $html .="         <p class='content_cmt'>".$val['comment']."</p>";
            $html .="         <span class='time_ago_cmt'><time class='time_ago' datetime='".$date."'> </time></span>";
            if(isset($_SESSION['cus_id']) && $val['customer_id'] == $_SESSION['cus_id']): 
                $html .="         <span onclick='del_comment(".$val['id'].")' class='del_cmt'>Delete</span>";
            endif;
            $html .="     </div>";
            $html .=" </div>";
       endforeach;
       echo $html;
    }
    public function cre_comment() {
        if(isset($_REQUEST['event_id'])){
            if($_REQUEST['event_id'] <= 0) return;
            $comment = trim($_REQUEST['comment']);
            if($comment!=''){
                $data = [
                    'event_id'=>$_REQUEST['event_id'],
                    'customer_id'=>$_SESSION['cus_id'],
                    'comment' =>$comment,
                ];
                $id = $this->ajaxModel->store($data, 'ep_feedback');
                $this->view_more_comment($id);
            }
        }
    }
    public function del_comment() {
        if(isset($_POST['cmt_id'])){
            $condition = 'id = '.(int)$_POST['cmt_id'];
            $this->ajaxModel->destroy($condition, 'ep_feedback');
        }
    }
    // ================ Cart ======================
    public function change_num_ticket_cart() {
        if(isset($_POST['event_id'])){
            $_SESSION['cart'][$_POST['event_id']][$_POST['type']]['number'] = $_POST['ticket_num'];
        }
    }
    public function del_cart_item() {
        if(isset($_POST['event_id'])){
            if(count($_SESSION['cart'][$_POST['event_id']]) == 2){
                unset($_SESSION['cart'][$_POST['event_id']][$_POST['type']]);
            }else{
                unset($_SESSION['cart'][$_POST['event_id']]);
            }
        }elseif(isset($_POST['del'])){
            unset($_SESSION['cart']);
        }
        $column = ['id', 'event_name', 'event_sub_img', 'event_intro', 'ticket_num', 'ticket_price'];
        if(!empty($_SESSION['cart'])){
            $list_id = implode(', ', array_keys($_SESSION['cart']));
            $data = $this->ajaxModel->getEventDetail($list_id, $column);
        }else{
            $data = [];
        } 
        return $this->view('frontend.ajax.cart.cart_tbody', [
            'data' => $data,
        ]); 
    }
    public function load_cart() {
        $column = ['id', 'event_name', 'event_sub_img', 'event_intro', 'ticket_num', 'ticket_price'];
        if(!empty($_SESSION['cart'])){
            $list_id = implode(', ', array_keys($_SESSION['cart']));
            $data = $this->ajaxModel->getEventDetail($list_id, $column);
        }else{
            $data = [];
        }
        return $this->view('frontend.cart.index', [
            'data' => $data,
        ]);
    }
    public function load_order() {
        if(isset($_SESSION['cus_id'])){
            $id = $_SESSION['cus_id'];
            $condition = 'customer_id = "'.$id.'" and a.status in (1, 2)';
            $all_data = $this->ajaxModel->get_cusOrder(0, 0, $condition);
            $count_row = count($all_data);
            $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
            $this->paging['order'] = $this->load_library('Pagination');
            $this->paging['order']->setValue($count_row, $page, ORDER_FRONT_LIMIT, "");
            $cusOrder = $this->ajaxModel->get_cusOrder(ORDER_FRONT_LIMIT, $this->paging['order']->offset, $condition);
            // var_dump($cusOrder);die;
            $cus_odrDetail = [];
            $total_moneyAll = 0;
            if(!empty($cusOrder)){
                foreach ($cusOrder as $val){
                    $cus_odrDetail[] = $this->ajaxModel->get_ordDetail($id, $val['id']);
                }
                foreach ($all_data as $val){
                    $total_moneyAll+=$val['total_money'];
                }
            }
            return $this->view('frontend.ajax.cart.order', [
                'cusOrder'=>$cusOrder,
                'cus_odrDetail'=>$cus_odrDetail,
                'paging_order'=>$this->paging['order'],
                'total_order'=>$count_row,
                'total_moneyAll'=>$total_moneyAll,
            ]);
        }
    }   
    public function order_paging() {
        if(isset($_SESSION['cus_id'])){
            $id = $_SESSION['cus_id'];
            if(isset($_POST['type']) && $_POST['type'] == '0'){
                $condition = 'customer_id = "'.$id.'" and a.status in (1, 2)';
            }else{
                $condition = 'customer_id = "'.$id.'" and a.status in (-1, 3)';
            }
            $all_data = $this->ajaxModel->get_cusOrder(0, 0, $condition);
            $count_row = count($all_data);
            $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
            $this->paging['order'] = $this->load_library('Pagination');
            $this->paging['order']->setValue($count_row, $page, ORDER_FRONT_LIMIT, "");
            $cusOrder = $this->ajaxModel->get_cusOrder(ORDER_FRONT_LIMIT, $this->paging['order']->offset, $condition);
    
            $cus_odrDetail = [];
            $total_moneyAll = 0;
            if(!empty($cusOrder)){
                foreach ($cusOrder as $val){
                    $cus_odrDetail[] = $this->ajaxModel->get_ordDetail($id, $val['id']);
                }
                foreach ($all_data as $val){
                    $total_moneyAll+=$val['total_money'];
                }
            }
            return $this->view('frontend.ajax.cart.order_paging', [
                'cusOrder'=>$cusOrder,
                'cus_odrDetail'=>$cus_odrDetail,
                'paging_order'=>$this->paging['order'],
                'total_order'=>$count_row,
                'total_moneyAll'=>$total_moneyAll,
                'type'=>$_POST['type'],
            ]);
        }
    }
    public function order_cancel() {
        if(isset($_POST['order_id'])){
            $condition = 'id = "'.$_POST['order_id'].'"';
            $this->ajaxModel->updateField(['status' => '0'], $condition, 'ep_order');
            echo 'You have successfully canceled.';
        }
    }
    public function load_payment() {
        if(empty($_SESSION['cus_id'])){
            return $this->redirect_login('?controller=cart');
        }elseif(empty($_SESSION['cart'])){
            echo '<script>location = "?controller=cart";</script>';
            return false;
        }else{
            $condition = 'id = '.$_SESSION['cus_id'];
            $data_info = $this->ajaxModel->findAny(['cus_name', 'gender', 'phone', 'address'], $condition, 'ep_customer');
            if(count($data_info) > 0){
                if($data_info[0]['phone'] == '' || $data_info[0]['address'] == '')
                    $check_info = true;
                else
                    $check_info = false;
            }
            $column = ['id', 'event_name', 'event_sub_img', 'event_intro', 'ticket_num', 'ticket_price'];
            $data = [];
            if(!empty($_SESSION['cart'])){
                $list_id = implode(', ', array_keys($_SESSION['cart']));
                $data = $this->ajaxModel->getEventDetail($list_id, $column);
            }
            $method_pay = $this->ajaxModel->findAny(['*'], 'status = 1', 'ep_order_method');
            return $this->view('frontend.ajax.cart.payment', [
                'check_info'=>$check_info,
                'data_info'=>$data_info[0],
                'method_pay'=>$method_pay,
                'data'=>$data,
            ]);
        }
    }
    public function change_address_payment() {
        if(isset($_POST)){
            array_shift($_POST);
            $data = $_POST;
            $_SESSION['cus_name'] = $data['cus_name'];
            $condition = 'id = "'.$_SESSION['cus_id'].'"';
            $this->ajaxModel->updateField($data, $condition, 'ep_customer');
            echo 'Successful address change.';
        }
    }
    public function order_ticket() {
        if(isset($_POST)){
            
            $data['customer_id'] = $_SESSION['cus_id'];
            $data['order_method_id'] = $_POST['order_method_id'];
            $data['note'] = $_POST['note'];

            $condition = 'order_code like "%OD%"';
            $max_order_code = $this->ajaxModel->select_max('order_code', 'ep_order', $condition);
            $max_code = (int)(str_replace('OD', '', $max_order_code['order_code'])) + 1;
            if ($max_code < 10)
                $data['order_code'] = 'OD00000' . ($max_code);
            else if ($max_code < 100)
                $data['order_code'] = 'OD0000' . ($max_code);
            else if ($max_code < 1000)
                $data['order_code'] = 'OD000' . ($max_code);
            else if ($max_code < 10000)
                $data['order_code'] = 'OD00' . ($max_code);
            else if ($max_code < 100000)
                $data['order_code'] = 'OD0' . ($max_code);
            else if ($max_code < 1000000)
                $data['order_code'] = 'OD' . ($max_code);

            $order_id = $this->ajaxModel->store($data, 'ep_order');
            
            foreach($_SESSION['cart'] as $event_id => $ord_detail_data){
                foreach($ord_detail_data as $type => $value){
                    $data_detail = [
                        'order_id' => $order_id,
                        'even_id'  => $event_id,
                        'type'     => $type,
                        'number'   => $value['number'],
                        'price'    => $value['price'],
                    ];
                    $this->ajaxModel->store($data_detail, 'ep_order_detail');
                }
            }
            unset($_SESSION['cart']);
        }
    }
    // ========== Account ==============
    public function load_setting() {
        if(isset($_POST['type'])){
            $condition = 'id = "'.$_SESSION['cus_id'].'"';
            $data = $this->ajaxModel->getDataUser($condition);
            $arr = explode('@', $data[0]['email']);
            if(count($arr) == 2)
                $data[0]['email'] = substr($arr[0], 0, 2).'*******@'.$arr[1];
            else $data[0]['email'] = '*********@****';
            $type = $_POST['type'];
            $link = 'frontend.ajax.account.'.$type;
            return $this->view($link, [
                'data'=>$data[0]??[],
            ]);
        }
    }
    public function load_account() {
        $condition = 'id = "'.$_SESSION['cus_id'].'"';
        $data = $this->ajaxModel->getDataUser($condition);
        $arr = explode('@', $data[0]['email']);
        if(count($arr) == 2)
            $data[0]['email'] = substr($arr[0], 0, 2).'*******@'.$arr[1];
        else $data[0]['email'] = '*********@****';
        return $this->view('frontend.ajax.account.main_setting', [
            'data'=>$data[0]??[],
        ]);
    }
    public function change_password_account() {
        if(isset($_POST['last_pass'])){
            $condition = 'id = "'.$_SESSION['cus_id'].'"';
            $pass = $this->ajaxModel->findAny(['password'], $condition, 'ep_customer');
            $hash = $pass[0]['password'];
            if(password_verify($_POST['last_pass'], $hash)){
                $new_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
                $this->ajaxModel->updateField(['password'=>$new_pass], $condition, 'ep_customer');
                echo 'Change password successfully';
            }else{
                echo 'Password is incorrect';
            }
        }
    }
    public function check_email_account() {
        if(isset($_POST['current_email'])){
            $condition = 'id = "'.$_SESSION['cus_id'].'"';
            $data = $this->ajaxModel->getDataUser($condition)[0];
            if($_POST['current_email'] == $data['email']){

                $html  ="   <div class='acc_inp'>";
                $html .="       <label for='token'>Enter verification code</label>";
                $html .="       <span style='display: block; width: 100%;'>Please check the code in your email. This code consists of 6 numbers.</span>";
                $html .="       <input oninput='remove_error(\".token-error\");' id='token' type='text' class='form-control' placeholder='Enter verification code'>";
                $html .="       <span class='token-error _error'></span>";
                $html .="   </div>";
                $html .="   <div class='acc_inp'>";
                $html .="       <label for=''>Enter new email address</label>";
                $html .="       <input oninput='remove_error(\".new_email-error\");' id='new_email' type='email' class='form-control' placeholder='Enter your new email'>";
                $html .="       <span class='new_email-error _error'></span>";
                $html .="   </div>";
                $html .="   <div class='acc_inp'>";
                $html .="       <button onclick='change_email_account();' class='btn btn-warning' type='button'>Continue</button>";
                $html .="   </div>";
                echo $html;

                if($data['token'] == 0) $token = $this->rand_str(6, 'int');
                else $token = $data['token'];
                if($this->sanitize_my_email($data['email'])){
                    $content = "Hello ".$data['cus_name'].",\r\n\n\tWe have received your change email request.\r\n\tEnter the following code to change your email: $token";
                    mail($data['email'], "Change Email", "$content", "From: son.nc.993@aptechlearning.edu.vn\r\n");
                    $condition = 'email = "'.$data['email'].'" and username not like "%@%"';
                    if($data['token'] == 0){
                        $this->ajaxModel->updateField(['token'=>$token], $condition, 'ep_customer');
                    }
                }
                
            }else{
                echo 'Email is incorrect.';
            }
        }
    }
    public function change_email_account() {
        if(isset($_POST['token'])){
            $token = (int)($_POST['token']);
            $new_email = $_POST['new_email'];
            $condition = 'token = "'.$token.'" and id = "'.$_SESSION['cus_id'].'"';
            $count = $this->ajaxModel->getRecord('ep_customer', $condition);
            if($count == 0){
                echo 'Verification incorrect';
            }else {
                $condition1 = 'email = "'.$new_email.'" and username not like "%@%"';
                $check_email = $this->ajaxModel->getRecord('ep_customer', $condition1);
                if($check_email == 0){
                    $this->ajaxModel->updateField(['email'=>$new_email, 'token'=>'0'], $condition, 'ep_customer');
                    echo 'Email address has been changed.';
                }else{
                    echo 'This email is already in use by someone else, please choose another email.';
                }
            }
        }
    }
    public function change_name_account() {
        if(isset($_POST['cus_name'])){
            array_shift($_POST);
            $data = $_POST;
            $_SESSION['cus_name'] = $data['cus_name'];
            $condition = 'id = "'.$_SESSION['cus_id'].'"';
            $this->ajaxModel->updateField($data, $condition, 'ep_customer');
            echo 'Change information successfully.';
        }
    }
    public function change_avatar_account() {
        if(isset($_FILES['avatar'])){
            $upload = $this->load_library('Upload_img');
            $folder_up = 'avatar';
            $upload_path = UPLOAD_PATH.$folder_up;
            $upload->set_upload_path($upload_path);
            $upload->set_max_filesize(2048);
            if($upload->do_upload('avatar')){
                $condition = 'id = "'.$_SESSION['cus_id'].'" and avatar not like "%/default-avatar%"';
                $this->dropImg(['avatar'], 'ep_customer', $condition);
                $condition = 'id = "'.$_SESSION['cus_id'].'"';
                $data['avatar']  = $upload->get_path_dir(DEFAULT_IMG_DIR.$folder_up);
                $this->ajaxModel->updateField($data, $condition, 'ep_customer');
                $_SESSION['avatar'] = $data['avatar'];
                echo $data['avatar'];
            }else{
                echo $upload->get_error();
            }   
        }
    }
    // ======================================== \\
    public function dropImg($column = [], $table, $condition, $limit = 999, $offset = 0) {
        $column_list = $this->ajaxModel->ColumnList($table);
        if($table && $condition && in_array($column[0], $column_list)){
            $all_img = $this->ajaxModel->findField($column, $table, $limit, $offset, $condition);
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
    public function redirect_login($url = '') {
        // xem nguoi dung co dang nhap trong 3p k?
        // neu trong 3p nguoi dung ma dang nhap thi chuyen huong den link redirect
        // neu k thi redirect ve home
        if(isset($_POST['url'])){
            $url = $_POST['url'];
        }
        setcookie('redirect_url', $url, time() + 5*60);
        echo '<script>location = "?controller=auth";</script>';
        return;
    }
    public function rand_str($n, $type = 'string') {
        $str = "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXVCBNM";
        if($type == 'int'){
            $str = "0123456789";
        }
        $str = str_shuffle($str);
        return substr($str, 0, $n); 
    }
    function sanitize_my_email($field) {
        // Loại bỏ ký tự không hợp lệ
        $field = filter_var($field, FILTER_SANITIZE_EMAIL);
 
        // Xác thực Email
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
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

    public function category_lock() {
        $condition = 'status = 0';
        $listCategory_id = $this->ajaxModel->findAny(['id'], $condition, 'ep_sea_group');
        $listCategory_id = $this->find_category_post($listCategory_id);
        $listCategory_id = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($listCategory_id)), 0);
        return array_unique($listCategory_id);
    }

    public function get_animate_rotate() {
        $html = "<div id='ani-rotate' class='rotate-no-fixed'>";
            $html .= "<span class='sk-circle1 sk-child'></span>";
            $html .= "<span class='sk-circle2 sk-child'></span>";
            $html .= "<span class='sk-circle3 sk-child'></span>";
            $html .= "<span class='sk-circle4 sk-child'></span>";
            $html .= "<span class='sk-circle5 sk-child'></span>";
            $html .= "<span class='sk-circle6 sk-child'></span>";
            $html .= "<span class='sk-circle7 sk-child'></span>";
            $html .= "<span class='sk-circle8 sk-child'></span>";
            $html .= "<span class='sk-circle9 sk-child'></span>";
            $html .= "<span class='sk-circle10 sk-child'></span>";
            $html .= "<span class='sk-circle11 sk-child'></span>";
            $html .= "<span class='sk-circle12 sk-child'></span>";
        $html .= "</div>";
        return $html;
    }
    public function formatDate($data, $fr = '/', $to = '-') {
        $dateArr = explode(' ', $data);
        $time    = isset($dateArr[1])?" $dateArr[1]":'';
        return implode($to, array_reverse(explode($to, str_replace($fr, $to, $dateArr[0])))).$time;
    }
}