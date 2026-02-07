<?php 
namespace App\Http\Controllers\Components\LoanRequest;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;
class LoanRequest 
{
    function __construct() {
        $this->model = new MainModel();
        $this->module = Helpers::last_segment();
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
    
}