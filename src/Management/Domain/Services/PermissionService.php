<?php
namespace Memories\Management\Domain\Services;

use App\Models\Result;
use Exception;
use Memories\Management\Domain\Entities\PermissionRol;
use Memories\Management\Domain\Interfaces\IPermissionRepository;

class PermissionService{
    private IPermissionRepository $repository;

    function __construct(IPermissionRepository $permissionRepository)
    {
        $this->repository = $permissionRepository;
    }

    public function getAllPermissions():Result{
        $result = new Result();
        try{
            $res = $this->repository->fetchAll();

            $result->success = true;
            $result->message = 'success';
            $result -> data = $res;

        }catch(Exception $ex){

            $result->success = false;
            $result->message = $ex->getMessage();
            $result -> data = null;
        }

        return $result;
    }

    public function addPermissionToRol(PermissionRol $permissionRol):Result{
        $result = new Result();
        try{
            $res = $this->repository->addRolPermission($permissionRol);

            $result->success=true;
            $result->message = 'sucess';
            $result->data = $res;
        }catch(Exception $ex){
            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data= null;
        }
        return $result;
    }

    public function removePermissionFromRol(PermissionRol $permissionRol):Result{
        $result = new Result();

        try{
            $res = $this->repository->removeRolPermission($permissionRol);

            $result->success=true;
            $result->message = 'sucess';
            $result->data = $res;

        }catch(Exception $ex){
            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data= null;
        }
        return $result;
    }

    public function searchRolePermissions(string $rolCode):Result{
        $result = new Result();

        try{
            $res = $this->repository->getPermissionByRolId($rolCode);

            $result->success=true;
            $result->message = 'sucess';
            $result->data = $res;

        }catch(Exception $ex){
            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data= null;
        }

        return $result;
    }
}
