<?php 

class PostController extends BaseController{
    private $postModel;

    public function __construct() {
        $this->postModel = $this->load_model_public("PostModel");
    }

    public function index() {
        if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])){
            $condition = "a.status = 1 and sea_id = ".$_REQUEST['id'];

            $list_groupId_lock = $this->category_lock();
            $list_groupId_lock = implode(', ', $list_groupId_lock);
            if($list_groupId_lock) $condition .= ' and sea_group_id not in ('.$list_groupId_lock.')';
            
            $data = $this->postModel->getPostData($condition);
            if(count($data) == 0){
                header('location: /Aquarium/views/frontend/404');
                exit();
            }
            $description = $this->postModel->getPostDescription("sea_id = '".$_REQUEST['id']."'");
            return $this->view('frontend.event-post.single_post', [
                'data'       => $data,
                'description'=> $description
            ]);
        }else{
            header('location: /Aquarium/views/frontend/404');
            exit();
        }
    }
    public function all() {
        $condition = 'status = 1';
        if(isset($_GET['cid'])){
            $check_conn = 'status = 1 and id = "'.$_GET['cid'].'"';
            $check_lock = $this->postModel->findAny(['id'], $check_conn, 'ep_sea_group');
            if(!isset($check_lock[0]['id']) || !is_numeric($_GET['cid'])){
                header('Location: /Aquarium/views/frontend/404');
                exit();
            }
            $listCategory_id = $this->find_category_post([['id'=>$_GET['cid']]]);
            $listCategory_id = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($listCategory_id)), 0);
            $list_id = implode(', ', $listCategory_id);
            $condition .= ' and sea_group_id in ('.$list_id.')';
        }
        $list_groupId_lock = $this->category_lock();
        $list_id = implode(', ', $list_groupId_lock);
        if($list_id) $condition .= ' and sea_group_id not in ('.$list_id.')';
   
        $count_row = $this->postModel->getCountRecord('ep_sea_animal', $condition);
        $condition = str_replace('status', 'a.status', $condition);
        $data = $this->postModel->getAnimalGuideData(ANIMAL_GUIDE_LIMIT, 0, $condition);
        $category_data = $this->get_category();
        foreach($category_data as $key => $value){
            if(in_array($value['id'], $list_groupId_lock)){
                unset($category_data[$key]);
            }
        }
        return $this->view('frontend.event-post.all_animal', [
            'data' => $data,
            'count' => $count_row,
            'cate_id' => $_GET['cid']??0,
            'category' => $category_data
        ]);
    }

    public function categories() {
        $category_data = $this->get_category();
        $list_category_lock = $this->category_lock();    
        $list_id = implode(', ', $list_category_lock);
        foreach($category_data as $key => $value){
            if(in_array($value['id'], $list_category_lock)){
                unset($category_data[$key]);
                continue;
            }
            $list_groupId = $this->find_category_post([['id'=>$value['id']]]);
            $list_groupId = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($list_groupId)), 0);
            $total_post = 0;
            foreach($list_groupId as $val){
                $condition = 'sea_group_id = "'.$val.'" and status = 1';
                if($list_id) $condition .= ' and sea_group_id not in ('.$list_id.')';
                $list_post =  $this->postModel->findAny(['sea_id'], $condition, 'ep_sea_animal');
                $total_post += count($list_post);
            }
            $category_data[$key]['total_posts'] = $total_post;
        }
        return $this->view('frontend.event-post.all_category', [
            'category' => $category_data
        ]);
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
        $category_data = $this->postModel->get_category_data();
        return $this->category($category_data, $parent_id, 0);
    }

    public function find_category_post($id = []) {
        $data = array();
        foreach($id as $val){
            $condition = 'parent_id = "'.$val['id'].'"';
            $result = $this->postModel->findAny(['id'], $condition, 'ep_sea_group');
            $data[] = $val;
            $child = $this->find_category_post($result);
            if(!empty($child)) array_push($data, $child);
        }
        return $data;
    }

    public function category_lock() {
        $condition = 'status = 0';
        $listCategory_id = $this->postModel->findAny(['id'], $condition, 'ep_sea_group');
        $listCategory_id = $this->find_category_post($listCategory_id);
        $listCategory_id = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($listCategory_id)), 0);
        return array_unique($listCategory_id);
    }

}