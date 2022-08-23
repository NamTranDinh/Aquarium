<?php 

class EventController extends BaseController{

    private $eventModel;

    public function __construct() {
        $this->eventModel = $this->load_model_public('EventModel');
    }

    public function index() {
        if(isset($_REQUEST['id'])  && is_numeric($_REQUEST['id'])){
            $data = $this->eventModel->getEventDetail($_REQUEST['id']);
            if(count($data) == 0 ){
                header('location: /Aquarium/views/frontend/404');
                exit();
            }
            $condition = 'event_id = "'.$_REQUEST['id'].'"';
            $description = $this->eventModel->getEventDescription($condition);

            $total = count($this->eventModel->getComment_event(0, 0, $condition));
            $comment_data = $this->eventModel->getComment_event(3, 0, $condition);

            $this->view('frontend.event-post.single_event', [
                'data'=>$data[0],
                'description'=>$description,
                'comment_data'=>$comment_data,
                'total'=>$total,
            ]);
        }else {
            header('location: /Aquarium/views/frontend/404');
            exit();
        }
    }

    public function all() {
        $condition = 'status = 1';
        $count_row = $this->eventModel->getCountRecord('ep_event', $condition);
        $data = $this->eventModel->getEventData(EVENT_GUIDE_LIMIT, 0, $condition);

        $this->view('frontend.event-post.all_event', [
            'data'=>$data,
            'count' => $count_row,
        ]);
    }
}