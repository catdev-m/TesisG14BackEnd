<?php
namespace Memories\Management\Application\Controllers;

use Illuminate\Http\Request;
use Memories\Management\Domain\Services\PermissionService;
use Illuminate\Routing\Controller as BaseController;
use Memories\Management\Domain\Mappers\RolPermissionMapper;

class PermissionController extends BaseController{
    private ?PermissionService $service;

    function __construct(PermissionService $service)
    {
        $this->service= $service;
    }

    public function fetchAll(){
        $res = $this->service->getAllPermissions();
        return response()->json($res->toArray());
    }

    public function addPermissionToRol(Request $request, string $rolCode){
        $rolPermission = RolPermissionMapper::fromRequestToEntity($request);
        $res = $this->service->addPermissionToRol($rolPermission);

        return response()->json($res->toArray());
    }

    public function removePermissionFromRol(Request $request, string $rolCode){
        $rolPermission = RolPermissionMapper::fromRequestToEntity($request);
        $res = $this->service->removePermissionFromRol($rolPermission);

        return response()->json($res->toArray());
    }

    public function searchRolPermissions(string $rolCode){
        $res = $this->service->searchRolePermissions($rolCode);
        return response()->json($res->toArray());
    }
}
