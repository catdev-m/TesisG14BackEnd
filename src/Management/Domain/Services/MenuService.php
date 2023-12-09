<?php
namespace Memories\Management\Domain\Services;

use Memories\Management\Domain\Interfaces\IMenuRepository;
use App\Models\Result;
use Exception;
use Illuminate\Support\Collection;

class MenuService{

    private $menuRepository;
    
    public function __construct(IMenuRepository $menuRepository)
    {   
        $this->menuRepository = $menuRepository;
    }

    public function getMenuList():Result{
        $res = new Result();
        try{
            $list = $this->menuRepository->getAll();
            $res->message= "Solicitud exitosa";
            $res->success = true;
            $res->data= $list;
        }catch(Exception $ex){
            $res->message = $ex->getMessage();
            $res->success = false;
            $res->data = null;
        }
        return $res;
    }

    public function getMenusByRol(string $rolId):Result{
        $result = new Result();
        try{
            $res = $this->menuRepository->searchMenusByRolId($rolId);
            
            $result->message = "success";
            $result->success=true;
            $result->data= $res;


        }catch(Exception $ex){
            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data=null;
        }
        return $result;
    }
}