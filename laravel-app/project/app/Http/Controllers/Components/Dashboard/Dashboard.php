<?php 
namespace App\Http\Controllers\Components\Dashboard;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Dashboard
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
    
    public function testText(){
        $client = new Client();

        $form_params =[
            'api_key' => 'Hu7320eYzznUDf4WSu_WpqA2SBPdap',
            'api_secret' => 'gd6RV6E6dEujceYHe74g5P4uzA9IdT',
            'from' => 'MVDSMS',
            'to' => '+639361776112',
            'text' => 'PAK YOU!',
        ];
        // try {
            // Send the POST request
            $response = $client->request('POST', 'https://api.movider.co/v1/sms', [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => $form_params,
                'verify' => false,
            ]);
    
            // Decode the response JSON
            $data = json_decode($response->getBody(), true);
    
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => $e->getMessage(),
        //     ], 500);
        // }
    }
    
}