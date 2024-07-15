<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
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

        return view('transaksi/indextransaksi', compact('accessToken', 'refreshToken', 'name'));
    }

    public function listtransaksi()
    {
        $accessToken = Session::get('access_token');
        $refreshToken = Session::get('refresh_token');
        $name = Session::get('loggedInUser');

        try {
            $response = $this->client->request('GET', 'stockissue/list', [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return response()->json($data, $response->getStatusCode());

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addtransaksi(Request $request)
    {
        $accessToken = Session::get('access_token');
       
        $company = $request->input('company'); 
        $code = $request->input('code'); 
        $date = $request->input('date'); 
        $account = $request->input('account'); 
        $note = $request->input('note'); 

        $companyHash = 'd3170153-6b16-4397-bf89-96533ee149ee';
        $accountHash = 'bc54db2f-4b44-4401-be7d-31c21effa9c1';
        
        $data = [
            'Company' => $companyHash,
            'Code' => $code,
            'Date' => $date,
            'Account' => $accountHash,
            'Note' => $note,
        ];

        try {
            $response = $this->client->post('stockissue', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer {$accessToken}",
                ],
                'json' => $data
            ]);
            return response()->json([
                'message' => 'Transaction added successfully',
                'api_response' => json_decode($response->getBody()->getContents())
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error('Error sending data to API', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Error sending data to API', 'error' => $e->getMessage()], 400);
        }



        
    } 
}