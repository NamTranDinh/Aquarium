<?php

class OrdersController extends BaseController {

    private $ordersModel;
    private $paging;

    public function __construct() {
        $this->ordersModel = $this->load_model('OrdersModel');
        $this->paging['orders'] = $this->load_library('Pagination');
    }

    public function index() {

        $all_data = $this->ordersModel->getDataOrder();
        $count_row = count($all_data);
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
        $this->paging['orders']->setValue($count_row, $page, ORDERS_LIMIT, "");
        $dataOrders = $this->ordersModel->getDataOrder(ORDERS_LIMIT, $this->paging['orders']->offset);
        
        $dataOrdDetail = [];
        $total_moneyAll = 0;
        if(!empty($dataOrders)){
            foreach ($dataOrders as $val){
                $dataOrdDetail[] = $this->ordersModel->getDataOdrDetail($val['id']);   
            }
            foreach ($all_data as $val){
                $total_moneyAll+=$val['total_money'];
            }
        }
        // $last_week = date('Y-m-d', strtotime('-1 week'));
        // $condition = '(a.status in(1) and order_date > "'.$last_week.'") or order_update like "0000%"';
        $condition = 'a.status = 1 or order_update like "0000%"';
        $dataOrdNotice = $this->ordersModel->getDataOdrNotice(ORDERS_NOTICE_LIMIT, 0, $condition);
 
        $total_unprocessed = $this->ordersModel->getCountRecord('ep_order', 'status = 1 and check_view = 0');
        $total_notice = $this->ordersModel->getCountRecord('ep_order', 'status = 1');
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
 

}