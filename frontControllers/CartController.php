<?php

class CartController extends BaseController{

    private $eventModel;

    public function __construct() {
        $this->eventModel = $this->load_model_public('EventModel');
    }

    public function index() {
      
        $column = ['id', 'event_name', 'event_sub_img', 'event_intro', 'ticket_num', 'ticket_price'];
        if(!empty($_SESSION['cart'])){
            $list_id = implode(', ', array_keys($_SESSION['cart']));
            $data = $this->eventModel->getEventDetail($list_id, $column);
        }else{
            $data = [];
        }
       
        return $this->view('frontend.cart.index', [
            'data' => $data,
        ]);
    }
}