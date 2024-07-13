<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class MasterController extends Controller
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
        $accessToken = Session::get('access_token');
        $refreshToken = Session::get('refresh_token');
        $name = Session::get('loggedInUser') ?? exit(header("Location: " . route('login')));

        return view('master.indexmaster', compact('accessToken', 'refreshToken', 'name'));
    }

    public function list()
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

            $data = json_decode($response->getBody()->getContents(), true);
            return response()->json($data, $response->getStatusCode());

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addProduct(Request $request)
    {
        $accessToken = Session::get('access_token');
    
        $company = $request->input('company'); 
        $code = $request->input('code'); 
        $itemGroup = $request->input('itemGroup'); 
        $itemType = $request->input('itemType'); 
        $title = $request->input('title'); 
        $itemAccountGroup = $request->input('itemAccountGroup'); 
        $itemUnit = $request->input('itemUnit'); 
        $isActive = $request->input('isActive');

        $companyHash = 'd3170153-6b16-4397-bf89-96533ee149ee'; 
        $itemTypeHash = '3adfb47a-eab4-4d44-bde9-efae1bec8543'; 
        $itemGroupHash = '55692914-7402-4dd8-adec-40a823222b3e'; 
        $itemAccountGroupHash = '4fc9683e-f22b-47c6-9525-b054ba24ea42'; 
        $itemUnitHash = '5daf6a23-472d-4921-9945-57674d5fd1aa'; 

        $data = [
            'Company' => $companyHash,
            'ItemType' => $itemTypeHash,
            'Code' => $code,
            'Label' => $title,
            'ItemGroup' => $itemGroupHash,
            'ItemAccountGroup' => $itemAccountGroupHash,
            'ItemUnit' => $itemUnitHash,
            'IsActive' => $isActive === '1' ? 'true' : 'false'
        ];

        try {
            $response = $this->client->post('item', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer {$accessToken}",
                ],
                'json' => $data
            ]);
            return response()->json([
                'message' => 'Product added successfully',
                'api_response' => json_decode($response->getBody()->getContents())
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error('Error sending data to API', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Error sending data to API', 'error' => $e->getMessage()], 400);
        }
    }
    
    public function deleteproduct(Request $request)
    {
        $accessToken = Session::get('access_token');
        $refreshToken = Session::get('refresh_token');
        $oid = $request->input('id');
        // $oid = '4b327a24-d0f3-49ce-9112-52a658892e56';

        // dd($oid);


        try {

            if (empty($oid)) {
                return response()->json([
                    'error' => 'ID is required.',
                ], 400);
            }
            $response = $this->client->request('DELETE', "data/item/delete", [
                'query' => ['Oid' => $oid],
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
}
