<?php

class FeedbackController extends BaseController
{
    private $feedbackModel;
    private $paging;

    public function __construct()
    {
        $this->feedbackModel = $this->load_model('FeedbackModel');
        $this->paging['feed_back'] = $this->load_library('Pagination');
    }

    public function index()
    {
        $condition = '';
        if(isset($_REQUEST['search_submit']) && $_REQUEST['keyword']!=''){   
            $condition = 'cus_name like "%'.$_REQUEST['keyword'].'%" or event_name like "'.$_REQUEST['keyword'].'%"';
            $url = 'controller=feedback&search_submit=1&keyword='.$_REQUEST['keyword'].'&';
        }else{
            $url = 'controller=feedback&';
        }
        
        //tạo limit first
        $all_data = $this->feedbackModel->getFeedbackData(0, 0, $condition);
        $count_row = count($all_data);
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $this->paging['feed_back']->setValue($count_row, $page,FEEDBACK_LIMIT, $url);

        $dataFeedb = $this->feedbackModel->getFeedbackData(FEEDBACK_LIMIT, $this->paging['feed_back']->offset, $condition);

        $this->view('backend.feedback.index',[
            'data' => $dataFeedb,
            'keyword' => $_REQUEST['keyword']??'',
            'fBack_paging' => $this->paging['feed_back'] 
        ]);
    }
    public function DeleteDataFeedback()
    {
        if(isset($_GET['id'])){
            $condition = 'id = "'.$_GET['id'].'"';
            $this->feedbackModel->deleteData($condition, "ep_feedback");
            header('location: ?controller=feedback');
        }
    }
 
    
}