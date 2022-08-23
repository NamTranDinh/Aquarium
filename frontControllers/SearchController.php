<?php 

class SearchController extends BaseController{

    private $searchModel;
    private $paging;

    public function __construct() {
        $this->searchModel = $this->load_model_public('SearchModel');
    }

    public function index() {
        if(isset($_GET['s'])){
            $s = $this->htmlEntities(trim(strtolower($_GET['s'])));
            if($s == 'animal'){
                header('location: ?controller=post&action=all');
            }elseif($s == 'event'){
                header('location: ?controller=event&action=all');
            }else{
                if($s == ''){
                    return $this->view('frontend.home.search', [
                        'data_search'=>[],
                        'total'=>0,
                    ]);
                }
                $keyword = explode(' ', $s);
                $condition = 'name like "%'.$s.'%" or ';
           
                foreach($keyword as $val){
                    $condition .= 'name like "%'.$val.'%" or excerpt like "%'.$val.'%" or ';
                }

                $list_groupId_lock = $this->category_lock();
                $list_groupId_lock = implode(', ', $list_groupId_lock);
                if($list_groupId_lock) $animal_condition = ' and sea_group_id not in ('.$list_groupId_lock.')';
                else $animal_condition = '';
                $all_data = $this->searchModel->getDataSearch(0, 0, rtrim($condition, 'or '), $animal_condition);
                $count_row = count($all_data);
                $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
                $this->paging['search'] = $this->load_library('Pagination');
                $this->paging['search']->setValue($count_row, $page, SEARCH_GLOBAL_LIMIT, "");
                $data_search = $this->searchModel->getDataSearch(SEARCH_GLOBAL_LIMIT, $this->paging['search']->offset, rtrim($condition, 'or '), $animal_condition);

                return $this->view('frontend.home.search', [
                    'data_search'=>$data_search,
                    'total'=>$count_row,
                    'paging_search' =>$this->paging['search'],
                ]);
            }
        } else{
            header('Location: /Aquarium/views/frontend/');
            exit();
        }

    }
    function htmlEntities($str) {
        $str = str_replace('&', "&amp;", $str);
        $str = str_replace('<', "&lt;", $str);
        $str = str_replace('>', "&gt;", $str);
        $str = str_replace('"', "&quot;", $str);
        $str = str_replace('\'', "&lsquo;", $str);
        return $str;
    }
    public function find_category_post($id = []) {
        $data = array();
        foreach($id as $val){
            $condition = 'parent_id = "'.$val['id'].'"';
            $result = $this->searchModel->findAny(['id'], $condition, 'ep_sea_group');
            $data[] = $val;
            $child = $this->find_category_post($result);
            if(!empty($child)) array_push($data, $child);
        }
        return $data;
    }

    public function category_lock() {
        $condition = 'status = 0';
        $listCategory_id = $this->searchModel->findAny(['id'], $condition, 'ep_sea_group');
        $listCategory_id = $this->find_category_post($listCategory_id);
        $listCategory_id = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($listCategory_id)), 0);
        return array_unique($listCategory_id);
    }
}