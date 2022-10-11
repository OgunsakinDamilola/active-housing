<?php

namespace Ogunsakindamilola\ActiveHousing;

use Exception;
use GuzzleHttp\Client;

class ReqResClient
{
    private $requestUrl, $method, $guzzleClient, $response, $requestParam;
    private $endpoint = 'https://reqres.in/api';

    public function __construct($resource, $method = "GET", $requestParam = [])
    {
        $this->requestUrl = $this->endpoint . $resource;
        $this->method = $method;
        $this->requestParam = $requestParam;
    }

    public function handle()
    {
        try {
            $this->initiateGuzzleClient();
            $this->buildRequestResponse();
            $this->validateResponse();
            return $this->buildSuccessResponseData();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
                'meta_data' => null
            ];
        }
    }

    private function initiateGuzzleClient()
    {
        $this->guzzleClient = new Client(['headers' => ['Accept' => 'application/json']]);
    }

    private function validateResponse(){
        if($this->response->getStatusCode() >= 400){
            throw new Exception('Unable to complete request');
        }
    }

    private function buildRequestResponse()
    {
        if($this->method == "GET"){
            $this->response = $this->guzzleClient->request($this->method, $this->requestUrl);
        }
        if($this->method == "POST"){
            $this->response = $this->guzzleClient->request($this->method, $this->requestUrl, $this->requestParam);
        }
    }

    private function buildSuccessResponseData()
    {
        $responseBody = json_decode($this->response->getBody(), true);
        unset($responseBody['support']);
        $metaData = $responseBody;
        unset($metaData['data']);
        return [
            'success' => true,
            'message' => 'Request successful',
            'data' => $responseBody['data'],
            'meta_data' => $metaData
        ];
    }
}
