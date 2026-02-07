<?php 
namespace App\Http\Controllers\Components\TicketTransactions;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;
use Illuminate\Support\Facades\Hash;
class TicketTransactions 
{
    function __construct() {
        $this->model = new MainModel();
        $this->module = Helpers::last_segment();
        Helpers::getView('TicketTransactions');
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
            'action' => 'Edit',
            'body' =>  view('modal-content.view', $d)->render(),
            'footer' =>  '<button type="submit" class="btn btn-primary btn-sm">Save</button>',
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
        $sql = 'SELECT * FROM tbl_users WHERE username = ?';
        $param = [$username];
        $result =  $this->model->getRow($sql, $param);
        if ($result) {
            $response['success'] = false;
            $response['exist'] = true;
            $response['msg'] = 'Username already exist';
        }else{
            $data['first_name'] = $first_name;
            $data['middle_name'] = $middle_name;
            $data['last_name'] = $last_name;
            $data['bday'] = $bday;
            $data['email'] = $email;
            $data['phone_number'] = $phone_number;
            $data['address'] = $address;
            $data['gender'] = $gender;
            $data['username'] = $username;
            $data['password'] = Hash::make($password);
            $res = $this->model->insert('tbl_users', $data);
            if ($res) {
                $response['success'] = true;
                $response['exist'] = false;
                $response['msg'] = 'Successfully Added!';
            }
        }
        return $response;
    }
    public function updateUser($post){
        extract($post);
        $data['first_name'] = $first_name;
        $data['middle_name'] = $middle_name;
        $data['last_name'] = $last_name;
        $data['bday'] = $bday;
        $data['email'] = $email;
        $data['phone_number'] = $phone_number;
        $data['address'] = $address;
        $data['gender'] = $gender;
        $data['username'] = $username;
        if (isset($password) && $password != null && $password != '') {
            $data['password'] = Hash::make($password);
        }
        $where = [
            ['field' => 'user_id','value'=> $user_id]
        ];
        $res = $this->model->updateWhere('tbl_users', $where, $data);
        if ($res) {
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
        if ($result) {
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
                //  'action' => '
                //          <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                //              Action
                //          </button>
                //          <div class="dropdown-menu dropdown-menu-right">
                //          <a class="dropdown-item" href="javascript:void(0);" '.$crdentials.' id = "viewAccount"><span class="fe fe-16 fe-edit"></span> Edit</a>
                //          <a class="dropdown-item" href="javascript:void(0);" '.$crdentials.' id = "deleteData"><span class="fe fe-16 fe-trash-2"></span>  Delete</a>
                //          </div>
                //  ',
                 'action' => '
                 <div class="flex items-center space-x-4 text-sm">

                    <button
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-teal-600 border border-transparent rounded-full active:bg-teal-600 hover:bg-teal-700 focus:outline-none focus:shadow-outline-teal"
                            aria-label="Edit"
                            >
                            <svg  class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                            </svg>
                            

                            </button>
                            <button
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            aria-label="Edit"
                            >
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                ></path>
                            </svg>
                            </button>
                            <button
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-full active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
                            aria-label="Edit"
                            >
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                              ></path>
                            </svg>
                            </button>
                            
                        </div>
                            
                 ',
                ];
             }
        }
        return Helpers::generateDataTable([]);
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