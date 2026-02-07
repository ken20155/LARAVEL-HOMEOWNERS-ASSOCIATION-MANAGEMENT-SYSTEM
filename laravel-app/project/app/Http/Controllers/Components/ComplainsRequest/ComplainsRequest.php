<?php 
namespace App\Http\Controllers\Components\ComplainsRequest;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;

class ComplainsRequest
{
    function __construct() {
        $this->model = new MainModel();
        $this->module = Helpers::last_segment();
        $this->session = Helpers::session()['session'];
        Helpers::getView('ComplainsRequest');
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
        if ($moduletype == 2) {
            $sql = 'SELECT *,maintinance_id as primary_id FROM tbl_maintinance WHERE '.$primaryid.' = ?';
        }else{
            $sql = 'SELECT *,complain_id as primary_id FROM tbl_complaints WHERE '.$primaryid.' = ?';
        }
        $row =  $this->model->getRow($sql, [$id]);
        $d['data'] = $row;
        return [
            'action' => $action,
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
        $data = [];
        $complainList = [];
        if ($session['user_role'] == 1) {
            $complainList = $this->complainList();
        }
        $maintenanceList = $this->maintenanceList();
        $data_array_merge = array_merge($complainList,$maintenanceList);
        $x = 1;
        foreach ($data_array_merge as $key => $R) {
            $crdentials = '
                    data-id = "'.$R['primary_value'].'"
                    data-primaryid = "'.$R['primary_id'].'"
                    data-moduletype = "'.$R['module_type'].'"
                ';
            $btn = '';
            $view = '<a class="dropdown-item" href="javascript:void(0);" '.$crdentials.' data-action = "VIEW" id = "viewAccount"><i class="mdi mdi-eye"></i> View</a>';
            $accepted = '<a class="dropdown-item triggeredStatus" href="javascript:void(0);" '.$crdentials.' data-action = "ACCEPTED" data-msg="Accept"  id = "acceptNow"><i class="mdi mdi-check-circle"></i> Accept</a>';
            $on_progress = '<a class="dropdown-item triggeredStatus" href="javascript:void(0);" '.$crdentials.' data-action = "ON PROGRESS" data-msg="On Progress" ><i class="mdi mdi-av-timer"></i> On Progress</a>';
            $completed = '<a class="dropdown-item triggeredStatus" href="javascript:void(0);" '.$crdentials.' data-action = "COMPLETED" data-msg="Complete" ><i class="mdi mdi-checkbox-marked-circle-outline"></i> Complete</a>';
            $declined = '<a class="dropdown-item triggeredStatus" href="javascript:void(0);" '.$crdentials.' data-action = "DECLINED" data-msg="Decline" ><i class="mdi mdi-close"></i> Decline</a>';
            switch ($R['status']) {
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
                'com_name' => $R['com_name'],
                'respondent_name' => $R['respondent_name'],
                'desc' => $R['desc'],
                'date_complain' => $R['date_complain'],
                'type' => $R['type'],
                'status' => Helpers::status_badge($R['status'],$status),
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
        return Helpers::generateDataTable($data);
    }
    public function complainList(){
        $sql = "SELECT a.*,b.*,a.status as statustest FROM ".$this->maintable." as a INNER JOIN tbl_users as b on a.owner_id = b.user_id  WHERE a.deleted = 0 ";
        $result =  $this->model->getResults($sql, []);  
        $data = [];
        $x = 1;
        if ($result) {
            foreach ($result as $key => $R) {

                $data[] = [
                'primary_value' => $R->complain_id,
                'primary_id' => 'complain_id',
                'module_type' => 1,
                'com_name' => $R->first_name.' '.$R->middle_name.' '.$R->last_name,
                'respondent_name' => $R->respondent_name,
                'desc' => $R->desc,
                'date_complain' => date(LONGDATE,strtotime($R->date_complain)),
                'type' => 'Complain',
                'status' => $R->statustest,
                ];
            }
        }
       
        return $data;
    }
    public function maintenanceList(){
        $sql = "SELECT a.*,b.*,a.status as statustest FROM tbl_maintinance as a INNER JOIN tbl_users as b on a.user_id = b.user_id  WHERE a.deleted = 0";
        $result =  $this->model->getResults($sql, []);  
        $data = [];
        if ($result) {
            foreach ($result as $key => $R) {

                $data[] = [
                'primary_value' => $R->maintinance_id,
                'primary_id' => 'maintinance_id',
                'module_type' => 2,
                'com_name' => '',
                'respondent_name' => $R->first_name.' '.$R->middle_name.' '.$R->last_name,
                'desc' => $R->desc,
                'date_complain' => date(LONGDATE,strtotime($R->date_requested)),
                'type' => 'Request Maintenance',
                'status' => $R->statustest,
                ];
            }
        }
       
        return $data;
    }
    public function acceptNow(){
        $post = Helpers::post();
        $data['status'] = 'ACCEPTED';
        $where = [
            ['field' => $post['primaryid'],'value'=> $post['id']]
        ];
        if ($post['primaryid'] == 'maintinance_id') {
            $res = $this->model->updateWhere('tbl_maintinance', $where, $data);

        }else{
            $res = $this->model->updateWhere($this->maintable, $where, $data);

        }
        if ($res) {
            $response['success'] = true;
            $response['msg'] = 'Accepted Successfully';
        }else{
            $response['success'] = false;
            $response['msg'] = 'Error';
        }
        return response()->json($response);
    }
    public function triggeredStatus(){
        $post = Helpers::post();
        $data['status'] = $post['action'];
        $where = [
            ['field' => $post['primaryid'],'value'=> $post['id']]
        ];
        if ($post['moduletype'] == 2) {
           $table = 'tbl_maintinance';
        }else{
           $table = 'tbl_complaints';  
        }
        $res = $this->model->updateWhere($table, $where, $data);
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