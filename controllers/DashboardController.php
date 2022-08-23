<?php
class DashboardController extends BaseController{
    
    private $dashboardModel;
   
    public function __construct() {
        $this->dashboardModel = $this->load_model('DashboardModel');
    }

    public function index() {
        $date = $this->currentDay();
        $data = $this->dashboardModel->all_activity();

        $condition = 'order_date between "'.$date['f_week'].'"and"'.$date['e_week'].' 23:59:59"';
        $week_sale = $this->dashboardModel->getSales($condition);
        $data['week_sale'] = $week_sale['total_all'];

        $condition = 'order_date between "'.$date['f_month'].'"and"'.$date['e_month'].' 23:59:59"';
        $month_sale = $this->dashboardModel->getSales($condition);
        $data['month_sale'] = $month_sale['total_all'];

        $condition = 'order_date between "'.$date['f_quarter'].'"and"'.$date['e_quarter'].' 23:59:59"';
        $quarter_sale = $this->dashboardModel->getSales($condition);
        $data['quarter_sale'] = $quarter_sale['total_all'];

        for ($i=0; $i <= 6; $i++) { 
            $condition = 'order_date like "'.date('Y-m-d', strtotime('monday this week + '.$i.' day')).'%"';
            $data['day_chart'][$i] = $this->dashboardModel->getSales($condition);
            // echo $condition; echo '<br>';
            if($data['day_chart'][$i]['total_all'] === NULL){
                $data['day_chart'][$i]['total_all'] = 0;
            }
        }
        // echo '<pre>';
        // print_r($data['day_chart']);die;

        $j = 7; $index = 0;
        for ($i=1; $i <= 22; $i+=7) { 
            if($i==22){
                $j=(int)substr($date['e_month'], -2, 2);
            }
            $start = date('Y-m-d', strtotime(date('Y')."-".date('m').'-'.$i));
            $end   = date('Y-m-d', strtotime(date('Y')."-".date('m').'-'.$j));
            $condition = 'order_date between "'.$start.'"and"'.$end.' 23:59:59"';
            $data['month_chart'][$index] = $this->dashboardModel->getSales($condition);

            if($data['month_chart'][$index]['total_all'] === NULL){
                $data['month_chart'][$index]['total_all'] = 0;
            }
            $j+=7; $index++;
        }

        for ($i=$date['start_quarter']; $i <= $date['end_quarter']; $i++) { 
            
            $start = date('Y-m-01', strtotime(date('Y')."-".$i));
            $end   = date('Y-m-t', strtotime(date('Y')."-".$i));
            $condition = 'order_date between "'.$start.'"and"'.$end.' 23:59:59"';
            $data['quarter_chart'][$i] = $this->dashboardModel->getSales($condition);
            if($data['quarter_chart'][$i]['total_all'] === NULL){
                $data['quarter_chart'][$i]['total_all'] = 0;
            }
        }
        // echo '<pre>';
        // var_dump($data['day_chart']);
        $this->view('backend.dashboard.index', [
            'data' => $data,
        ]);
    }

    public function currentDay() {
        $quarter = ceil(date('m')/3);
        $date['start_quarter'] =  $start_quarter = 1+($quarter-1)*3;
        $date['end_quarter'] =  $end_quarter = 3+($quarter-1)*3;
        $date['f_quarter'] = date('Y-m-01', strtotime(date('Y')."-".$start_quarter));
        $date['e_quarter'] = date('Y-m-t', strtotime(date('Y')."-".$end_quarter));
        $date['f_month'] = date('Y-m-01', strtotime(date('Y')."-".date('m')));
        $date['e_month'] = date('Y-m-t', strtotime(date('Y')."-".date('m')));
        $date['f_week'] = date("Y-m-d", strtotime('monday this week'));;
        $date['e_week'] = date("Y-m-d", strtotime('sunday this week'));;

        return $date;
    }

    public function test() {
        
        return $this->view('backend.ttest.index');
    }

}