<?php

class EventController extends BaseController{
    
    private $eventModel;
    private $paging;

    public function __construct() {
        $this->eventModel = $this->load_model('EventModel');
        $this->paging['event'] = $this->load_library('Pagination');
    }

    public function index() {
        $count_row = count($this-> eventModel->getEventData());
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['event']->setValue($count_row, $page, EVENT_LIMIT, "");
        $data = $this->eventModel->getEventData(EVENT_LIMIT, $this->paging['event']->offset);
        return $this->view('backend.event.index', [
            'data'  =>  $data,
            'paging_event'=>$this->paging['event']
        ]);
    }
    
}