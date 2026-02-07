<?php 
namespace App\Http\Controllers\Components\BusinessOwnerReport;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;

class BusinessOwnerReport 
{
    function __construct() {
        $this->model = new MainModel();
        $this->module = Helpers::last_segment();
        Helpers::getView('BusinessOwnerReport');
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
        $sql = 'SELECT * FROM tbl_users WHERE user_id = ?';
        $param = [$id];
        $row =  $this->model->getRow($sql, $param);
        $d['data'] = $row;
        return [
            'data' =>  view('modal-content.view', $d)->render()
        ];
    }
    public function deleteDataUser(){
        $post = Helpers::post();
        $data['deleted'] = 1;
        $where = [
            ['field' => 'user_id','value'=> $post['id']]
        ];
        $res = $this->model->updateWhere('tbl_users', $where, $data);
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
        $sql = "SELECT * FROM tbl_users WHERE user_role = 2 and deleted = 0";
        $result =  $this->model->getResults($sql, []);  
        $data = [];
        $x = 1;
        foreach ($result as $key => $R) {
           $crdentials = '
                            data-id = "'.$R->user_id.'"
                        ';
            if ($R->status == 'PENDING') {
                $status = 'primary';
            }elseif ($R->status == 'ACCEPTED') {
                $status = 'success';
            }else{
                $status = 'warning';
            }
           $data[] = [
            '#' => $x++,
            'username' => $R->username,
            'email' => $R->email,
            'full_name' => $R->first_name.' '.$R->middle_name.' '.$R->last_name,
            'bday' => $R->bday,
            'phone_number' => $R->phone_number,
            'address' => $R->address,
            'gender' => $R->gender,
            'status' => Helpers::status_badge($R->status,$status),
            'action' => '
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary btn-sm btn-round dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" role="menu" style="">
                            <li>
                            <a class="dropdown-item bg-primary"  '.$crdentials.' id = "viewAccount" href="javascript:void(0);" style="color:white !important"><i class="far fa-eye"></i> View</a>

                            '.($R->status == 'PENDING' ? '
                            <a class="dropdown-item bg-success" '.$crdentials.' id = "acceptAccount" href="javascript:void(0);" style="color:white !important"><i class="fas fa-check-circle"></i> Accept</a>
                            <a class="dropdown-item bg-warning" '.$crdentials.' id = "declineAccount" href="javascript:void(0);" style="color:white !important"><i class="far fa-times-circle"></i> Decline</a>
                            ' : '').'

                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item bg-danger" href="javascript:void(0);" '.$crdentials.' id = "deleteData" style="color:white !important"><i class="fas fa-trash-alt"></i> Delete</a>
                            </li>
                        </ul>
                    </div>
            ',
           ];
        }
        return Helpers::generateDataTable($data);
    }
    public function acceptUser(){
        $post = Helpers::post();
        extract($post);
        $sql = 'SELECT * FROM tbl_users WHERE user_id = ?';
        $param = [$id];
        $row =  $this->model->getRow($sql, $param);
        $full_name =  $row->first_name.' '.$row->middle_name.' '.$row->last_name;
        $data['to_email'] = $row->email;
        $data['to_full_name'] = $full_name;
        $data['subject'] = 'Message From DTI Negosyo Center';
        $data['msg'] = 'Hello '.$full_name.', Your Application has been Accepted you can now login your account. Please click the link <a href="'.env('APP_URL').'auth/view/sign-in">Click me!</a>';
        $mail = Helpers::emailSender($data);
        if ($mail['success']) {
            $response['msg'] = $full_name.' application has been accepted successfully!';
            $response['success'] = true;
            $res['status'] = 'ACCEPTED';
            $res['id'] = $id;
            $this->updateStatus($res);
            return response()->json($response);
        }else{
            return $mail;
        }
    }
    public function declineUser(){
        $post = Helpers::post();
        extract($post);
        $sql = 'SELECT * FROM tbl_users WHERE user_id = ?';
        $param = [$id];
        $row =  $this->model->getRow($sql, $param);
        $full_name =  $row->first_name.' '.$row->middle_name.' '.$row->last_name;
        $data['to_email'] = $row->email;
        $data['to_full_name'] = $full_name;
        $data['subject'] = 'Message From DTI Negosyo Center';
        $data['msg'] = 'Hello '.$full_name.', Your Application has been declined';
        $mail = Helpers::emailSender($data);
        if ($mail['success']) {
            $response['msg'] = $full_name.' application has been declined successfully!';
            $response['success'] = true;
            $res['status'] = 'DECLINED';
            $res['id'] = $id;
            $this->updateStatus($res);
            return response()->json($response);
        }else{
            return $mail;
        }
    }
    public function updateStatus($res){
        $data['status'] = $res['status'];
        $where = [
            ['field' => 'user_id','value'=> $res['id']]
        ];
        $this->model->updateWhere('tbl_users', $where, $data);
    }
}