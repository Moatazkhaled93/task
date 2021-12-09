<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GrideRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\updateClientRequest;
use App\Services\ClientsService;
use Illuminate\Http\JsonResponse;
use App\Helpers\HttpStatusCodes;

class ClientsController extends Controller {
    /**
     * get Clients instance .
     * @param ClientsService $clientsService
     * @return JsonResponse
     */

    public function index(GrideRequest $request, ClientsService $clientsService) {
        try {
            $clients = $clientsService->index($request->validated());
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success($clients, 'clients listed successfully');
    }

    /**
     * get Clients instance .
     * @param ClientsService $clientsService
     * @return JsonResponse
     */

    public function show(ClientsService $clientsService ,$id) {
        try {
            $client = $clientsService->show($id);
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success($client, 'get client  successfully');
    }

    /**
     * create Clients instance .
     * @param ClientsService $clientsService
     * @return JsonResponse
     */

    public function store(StoreClientRequest $request, ClientsService $clientsService) {
        try {
            $client = $clientsService->store($request->validated());
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success($client, 'store client successfully');
    }

        /**
     * create Clients instance .
     * @param ClientsService $clientsService
     * @return JsonResponse
     */

    public function update(updateClientRequest $request, ClientsService $clientsService,$id) {
        try {
            $client = $clientsService->update($request->validated(),$id);
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success($client, 'update client successfully');
    }

    /**
     * get Clients instance .
     * @param ClientsService $clientsService
     * @return JsonResponse
     */

    public function destroy(ClientsService $clientsService ,$id) {
        try {
            $client = $clientsService->destroy($id);
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success('', 'destroy client  successfully');
    }

}