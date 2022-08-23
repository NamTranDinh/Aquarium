<?php

class PostController extends BaseController{
    private $postModel;
    private $paging;

    var $limit = POST_LIMIT;

    public function __construct() {
        $this->postModel            = $this->load_model('PostModel');
        $this->paging['posts']      = $this->load_library('Pagination');
        $this->paging['category']   = $this->load_library('Pagination');
    }

    public function index() {
        $count_row = count($this->postModel->getPostData());
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['posts']->setValue($count_row, $page, $this->limit, "");
        $data = $this->postModel->getPostData($this->limit, $this->paging['posts']->offset);
        
        $this->view('backend.post_manage.index', [
            'data' => $data,
            'category'=>$this->get_category(),
            'paging_posts'=>$this->paging['posts']
        ]);
    }

    public function load_group() {
        $count_row = count($this->postModel->getPostGrData());
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['category']->setValue($count_row, $page, $this->limit, "");
        $data = $this->postModel->getPostGrData($this->limit, $this->paging['category']->offset);
        
        $list_cate_id = $this->postModel->findField(['id'] , 'ep_sea_group', POST_LIMIT, $this->paging['category']->offset);
        $i=0;
        foreach($list_cate_id as $value){
            $list_groupId = $this->find_category_post([['id'=>$value['id']]]);
            $list_groupId = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($list_groupId)), 0);
            $total_post = 0;
            foreach($list_groupId as $val){
                $condition = 'sea_group_id = "'.$val.'"';
                $list_post =  $this->postModel->findAny(['sea_id'], $condition, 'ep_sea_animal');
                $total_post += count($list_post);
            }
            $data[$i]['total_subcategory'] = count($list_groupId)-1;
            $data[$i]['total_posts'] = $total_post;
            $data[$i]['sub_cate_id'] = $list_groupId;
            $i++;
        }

        $this->view('backend.ajax.post_manage.post_group', [
            'data' => $data,            
            'category'=>$this->get_category(),
            'paging_category'=>$this->paging['category']
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
 
}