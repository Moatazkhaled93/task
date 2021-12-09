<?php

namespace App\Services;

use App\Repository\Eloquent\ClientRepository;

class ClientsService {

    private $clientRepository;

    public function __construct(ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
    }

    public function index($data) {

        return $this->clientRepository->all();
    }
    public function show($id) {

        return $this->clientRepository->find($id);
    }
    
    public function store($data) {

        return $this->clientRepository->create($data);
    }

    public function update($data,$id) {

        return $this->clientRepository->update($data,$id);
    }

    public function destroy($id) {

        return $this->clientRepository->delete($id);
    }

}
