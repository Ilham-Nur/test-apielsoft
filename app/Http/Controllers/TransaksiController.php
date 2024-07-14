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
            'base_uri' => 'https://app.api.elsoft.id/admin/api/v1/stockissue/',
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
            $response = $this->client->request('GET', 'list', [
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
}