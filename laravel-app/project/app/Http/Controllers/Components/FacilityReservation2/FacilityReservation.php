<?php 
namespace App\Http\Controllers\Components\FacilityReservation;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;

class FacilityReservation
{
    function __construct() {
        $this->model = new MainModel();
        $this->module = Helpers::last_segment();
        $this->session = Helpers::session()['session'];
        Helpers::getView('FacilityReservation');
        $this->maintable = 'tbl_complaints';
        $this->primary = 'complain_id';
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
        if (!$row) {
            $sql = 'SELECT * FROM '.$this->maintable.' WHERE '.$this->primary.' = ?';
            $param = [$id];
            $row =  $this->model->getRow($sql, $param);
        }
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
            'footer' => ''// '<button type="submit" class="btn btn-primary btn-sm">Save</button>',
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
        // $data['respondent_name'] = $respondent_name;
        $data['date_complain'] = date(SQLDATE);
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
            ['field' => 'complain_id','value'=> $post['id']]
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
        $sql = "SELECT a.*,b.* FROM ".$this->maintable." as a INNER JOIN tbl_users as b on a.owner_id = b.user_id  WHERE a.deleted = 0 ";
        $result =  $this->model->getResults($sql, []);  
        $data = [];
        $x = 1;
        if ($result) {
            foreach ($result as $key => $R) {
                $crdentials = '
                                 data-id = "'.$R->complain_id.'"
                             ';
                 if ($R->status == 'PENDING') {
                     $status = 'info';
                 }elseif ($R->status == 'ACCEPTED') {
                     $status = 'success';
                 }else{
                     $status = 'warning';
                 }
                $data[] = [
                 '#' => $x++,
                 'respondent_name' => $R->first_name.' '.$R->middle_name.' '.$R->last_name,
                 'desc' => $R->desc,
                 'date_complain' => date(LONGDATE,strtotime($R->date_complain)),
                 'type' => 'Complain',
                 'status' => Helpers::status_badge($R->status,$status),
                 'action' => '
                         <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                         </button>
                         <div class="dropdown-menu dropdown-menu-right">
                         <a class="dropdown-item" href="javascript:void(0);" '.$crdentials.' id = "viewAccount"><span class="fe fe-16 fe-edit"></span> View</a>
                         </div>
                 ',
                ];
             }
        }


        $sql = "SELECT a.*,b.* FROM tbl_maintinance as a INNER JOIN tbl_users as b on a.user_id = b.user_id  WHERE a.deleted = 0";
        $result =  $this->model->getResults($sql, []);  
  
        $x = 1;
        if ($result) {
            foreach ($result as $key => $R) {
                $crdentials = '
                                 data-id = "'.$R->maintinance_id.'"
                             ';
                 if ($R->status == 'PENDING') {
                     $status = 'info';
                 }elseif ($R->status == 'ACCEPTED') {
                     $status = 'success';
                 }else{
                     $status = 'warning';
                 }
                $data[] = [
                 '#' => $x++,
                 'respondent_name' => $R->first_name.' '.$R->middle_name.' '.$R->last_name,
                 'desc' => $R->desc,
                 'date_complain' => date(LONGDATE,strtotime($R->date_requested)),
                 'type' => 'Request Maintinance',
                 'status' => Helpers::status_badge($R->status,$status),
                 'action' => '
                         <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                         </button>
                         <div class="dropdown-menu dropdown-menu-right">
                         <a class="dropdown-item" href="javascript:void(0);" '.$crdentials.' id = "viewAccount"><span class="fe fe-16 fe-edit"></span> View</a>
                         </div>
                 ',
                ];
             }
        }
        return Helpers::generateDataTable($data);
    }
}