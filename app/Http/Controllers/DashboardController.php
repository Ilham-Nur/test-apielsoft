<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
class DashboardController extends Controller
{   
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://app.api.elsoft.id/admin/api/v1/',
        ]);
    }
    public function index()
    {
        // $sessionLogin = session('loggedInUser');
        // $sessionLogin['username'] ?? exit(header("Location: " . route('login')));
        // $username = $sessionLogin['username'];
        $accessToken = Session::get('access_token');
        $refreshToken = Session::get('refresh_token');
        $name = Session::get('loggedInUser') ?? exit(header("Location: " . route('login')));

        

        return view('dashboard/dashboardindex', compact('accessToken', 'refreshToken', 'name'));
    }

    public function datalist()
    {
        $accessToken = Session::get('access_token');
        $refreshToken = Session::get('refresh_token');
        $name = Session::get('loggedInUser');

        try {
            $response = $this->client->request('GET', 'item/list', [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                ],
            ]);

            $response2 = $this->client->request('GET', 'stockissue/list', [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                ],
            ]);

            $data1 = json_decode($response->getBody()->getContents(), true);
            $data2 = json_decode($response2->getBody()->getContents(), true);

            $data = [
                'item_list' => $data1,
                'stock_issue' => $data2,
            ];

            return response()->json($data, $response->getStatusCode());

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}