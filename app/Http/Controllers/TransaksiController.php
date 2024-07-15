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

    public function deletetransaksi(Request $request)
    {
        $accessToken = Session::get('access_token');
        $refreshToken = Session::get('refresh_token');
        $oid = $request->input('id');

        try {
            if (empty($oid)) {
                return response()->json([
                    'error' => 'ID is required.',
                ], 400);
            }

            // Include the OID directly in the path
            $response = $this->client->request('DELETE', "stockissue/{$oid}", [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Accept' => 'application/json',
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            return response()->json([
                'status' => $statusCode,
                'data' => $content,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updatetransaksi(Request $request)
    {
        $accessToken = Session::get('access_token');
        $oid = $request->input('id');
        $codeedit = $request->input('code');
        $dateedit = $request->input('date');
        $noteedit = $request->input('note');

        $companyHash = 'd3170153-6b16-4397-bf89-96533ee149ee';
        $accountHash = 'bc54db2f-4b44-4401-be7d-31c21effa9c1';
        $statusHash = '09128d8c-a364-4dc7-bd3b-a2d15d8fefc5';

        try {
            if (empty($oid)) {
                return response()->json([
                    'error' => 'ID is required.',
                ], 400);
            }

            $response = $this->client->request('POST', "stockissue/{$oid}", [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'Oid' => $oid,
                    'Company' => $companyHash,
                    'Code' => $codeedit,
                    'Date' => $dateedit,
                    'Account' => $accountHash,
                    'Status' => $statusHash,
                    'Note' => $noteedit,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            return response()->json([
                'status' => 'success',
                'data' => $content, // Sesuaikan dengan data yang ingin dikirim kembali
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}