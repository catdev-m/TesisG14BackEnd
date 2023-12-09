<?php

namespace Memories\Management\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Memories\Management\Domain\Services\RolService;
use Memories\Management\Domain\Mappers\RolMapper;
use Memories\Management\Domain\Mappers\RolMenuMapper;

class RolController extends BaseController{

    private RolService $rolService;

    public function __construct(RolService $service){
        $this->rolService = $service;
    }

    public function listRoles()
    {
        $result = $this->rolService->listRoles();
        return response()->json($result->toArray());
    }

    public function createRol(Request $request){

        $rol = RolMapper::fromRequest($request,null);
        $result = $this->rolService->createRol($rol);

        return response()->json($result->toArray());
    }

    public function updateRol(Request $request,string $rolId){

        $rol = RolMapper::fromRequest($request,null);

        $result = $this->rolService->updateRol($rol,$rolId);

        return response()->json($result->toArray());
    }

    public function addMenuForRol(Request $request,string $rolId){

        $rolMenu = RolMenuMapper::fromRequest($request);
        $result = $this->rolService->addRolMenu($rolMenu,$rolId);
        return response()->json($result->toArray());
    }

    public function removeMenuForRol(Request $request, string $rolId){

        $rolMenu = RolMenuMapper::fromRequest($request);
        $result = $this->rolService->removeRolMenu($rolMenu,$rolId);
        return response()->json($result->toArray());
    }
}
