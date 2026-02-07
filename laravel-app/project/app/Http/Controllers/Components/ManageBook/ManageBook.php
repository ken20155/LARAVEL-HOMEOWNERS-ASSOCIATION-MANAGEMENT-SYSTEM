<?php 
namespace App\Http\Controllers\Components\ManageBook;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;

class ManageBook
{
    function __construct() {
        $this->model = new MainModel();
        $this->module = Helpers::last_segment();
        $this->session = Helpers::session()['session'];
        Helpers::getView('ManageBook');
        $this->maintable = 'tbl_booking';
        $this->primary = 'book_id';
    }
    public static function js(){
        return [
            'js/sample'
        ];
    }
    public function defaultPage($params){
        $data = [];
        return [
            'test' => 'ken'
        ];
    }
    public function viewDataUser(){
        $post = Helpers::post();
        extract($post);
        $sql = 'SELECT * FROM '.$this->maintable.' WHERE '.$this->primary.' = ?';
        $param = [$id];
        $row =  $this->model->getRow($sql, $param);
        $d['data'] = $row;
        return [
            'action' => 'Edit',
            'body' =>  view('modal-content.view', $d)->render(),
            'footer' =>  ''//'<button type="submit" class="btn btn-primary btn-sm">Save</button>',
        ];
    }
    public function addNewUser(){
        $post = Helpers::post();
        extract($post);
        $d['data'] = false;
        return [
            'action' => 'Add New',
            'body' =>  view('modal-content.view', $d)->render(),
            'footer' =>  '<button type="submit" class="btn btn-primary btn-sm">Save</button>',
        ];
    }
    public function crudAction(){
        $post = Helpers::post();
        if ($post['action'] == 'add') {
            return $this->createUser($post);
        }else{
            return $this->updateUser($post);
        }
    }
    public function createUser($post){
        extract($post);
        $data['facility_type'] = $facility_type;
        $data['date'] = $date;
        $data['time_start'] = $time_start;
        $data['time_end'] = $time_end;
        $data['added_date'] = date(SQLDATE);
        $data['desc'] = $desc;
        $session = $this->session;
        $data['owner_id'] = $session['user_id'];
        $res = $this->model->insert($this->maintable, $data);
        if ($res) {
            $response['success'] = true;
            $response['exist'] = false;
            $response['msg'] = 'Successfully Added!';
        }
        return $response;
    }
    public function updateUser($post){
        extract($post);
        $data['facility_type'] = $facility_type;
        $data['date'] = $date;
        $data['time_start'] = $time_start;
        $data['time_end'] = $time_end;
        $data['desc'] = $desc;

        $where = [
            ['field' => $this->primary,'value'=> $primary_id]
        ];
        $res = $this->model->updateWhere($this->maintable, $where, $data);
        if ($res) {
            $response['success'] = true;
            $response['exist'] = false;
            $response['msg'] = 'Successfully Updated!';
        }else{
            $response['success'] = true;
            $response['exist'] = false;
            $response['msg'] = 'Successfully Updated!';
        }
        return $response;
    }
    public function deleteDataUser(){
        $post = Helpers::post();
        $data['deleted'] = 1;
        $where = [
            ['field' => 'book_id','value'=> $post['id']]
        ];
        $res = $this->model->updateWhere($this->maintable, $where, $data);
        if ($res) {
            $response['success'] = true;
            $response['msg'] = 'Deleted Successfully';
        }else{
            $response['success'] = false;
            $response['msg'] = 'Error';
        }
        return response()->json($response);
    }
    public function listUsers(){
        $post = Helpers::post();
        $session = $this->session;
        $sql = "SELECT a.*,b.*,a.status as statustest FROM ".$this->maintable." as a INNER JOIN tbl_users as b on a.owner_id = b.user_id  WHERE a.deleted = 0";
        $result =  $this->model->getResults($sql, []);  
        $data = [];
        $x = 1;
        if ($result) {
            foreach ($result as $key => $R) {
                $crdentials = '
                                 data-id = "'.$R->book_id.'"
                             ';
                $btn = '';
                $view = '<a class="dropdown-item" href="javascript:void(0);" '.$crdentials.' data-action = "VIEW" id = "viewAccount"><i class="mdi mdi-eye"></i> View</a>';
                $accepted = '<a class="dropdown-item triggeredStatus" href="javascript:void(0);" '.$crdentials.' data-action = "ACCEPTED" data-msg="Accept"  id = "acceptNow"><i class="mdi mdi-check-circle"></i> Accept</a>';
                $on_progress = '<a class="dropdown-item triggeredStatus" href="javascript:void(0);" '.$crdentials.' data-action = "ON PROGRESS" data-msg="On Progress" ><i class="mdi mdi-av-timer"></i> On Progress</a>';
                $completed = '<a class="dropdown-item triggeredStatus" href="javascript:void(0);" '.$crdentials.' data-action = "COMPLETED" data-msg="Complete" ><i class="mdi mdi-checkbox-marked-circle-outline"></i> Complete</a>';
                $declined = '<a class="dropdown-item triggeredStatus" href="javascript:void(0);" '.$crdentials.' data-action = "DECLINED" data-msg="Decline" ><i class="mdi mdi-close"></i> Decline</a>';
                 switch ($R->statustest) {
                    case 'PENDING':
                        $status = 'info';
                        $btn .= $view.$accepted.$declined;
                        break;
                    case 'ACCEPTED':
                        $status = 'primary';
                         $btn .= $view.$on_progress.$declined;
                        break;
                    case 'ON PROGRESS':
                        $status = 'secondary';
                         $btn .= $view.$completed.$declined;
                        break;
                    case 'COMPLETED':
                        $status = 'success';
                         $btn .= $view;
                         break;
                    case 'DECLINED':
                        $status = 'danger';
                         $btn .= $view;
                        break;
                 }
                $data[] = [
                 '#' => $x++,
                 'full_name' => $R->first_name.' '.$R->middle_name.' '.$R->last_name,
                 'facility_type' => $R->facility_type,
                 'date' => date(LONGDATE,strtotime($R->date)),
                 'time' => Helpers::timeFormat($R->time_start).' - '.Helpers::timeFormat($R->time_end),
                 'status' => Helpers::status_badge($R->statustest,$status),
                 'action' => '
                         <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                         </button>
                         <div class="dropdown-menu dropdown-menu-right">
                            '.$btn.'
                         </div>
                 ',
                ];
            }
        }
        return Helpers::generateDataTable($data);
    }
    public function triggeredStatus(){
        $post = Helpers::post();
        $data['status'] = $post['action'];
        $where = [
            ['field' => 'book_id','value'=> $post['id']]
        ];
        $res = $this->model->updateWhere($this->maintable, $where, $data);
        if ($res) {
            $response['success'] = true;
            $response['msg'] = 'Accepted Successfully';
        }else{
            $response['success'] = false;
            $response['msg'] = 'Error';
        }
        return response()->json($response);
    }
}