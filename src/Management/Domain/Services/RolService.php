<?php
namespace Memories\Management\Domain\Services;

use Memories\Management\Domain\Interfaces\IRolRepository;
use App\Models\Result;
use Carbon\Carbon;
use Exception;
use Memories\Management\Domain\Entities\Rol;
use Memories\Management\Domain\Entities\RolMenu;

class RolService{

    private $rolRepository;

    public function __construct(IRolRepository $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }

    public function listRoles(){
        $result = new Result();
        try{
            $list = $this->rolRepository->list();
            $result->message = 'success';
            $result->success = true;
            $result->data = $list;
        }catch(Exception $ex){
            $result->message = $ex->getMessage();
            $result->success = false;
            $result->data = null;
        }
        return $result;
    }

    public function createRol(Rol $rol){

        $result = new Result();

        try{
            $alreadyRol = $this->rolRepository->searchByIdOrName($rol->getName(),$rol->getRolId());
            if($alreadyRol != null)
                throw new Exception('El rol ya existe.');

            $rol->setDateCreated(Carbon::now());
            $rol->setDateUpdated(Carbon::now());
            $this->rolRepository->create($rol);

            $savedRol = $this->rolRepository->findById($rol->getRolId());

            $result->message = 'Success';
            $result->success = true;
            $result->data = $savedRol;

        }catch(Exception $ex){
            $result->message = $ex->getMessage();
            $result->success = false;
            $result->data = null;
        }
        return $result;
    }

    public function updateRol(Rol $rol,string $rolId):Result{
        $res = new Result();
        try{
            if($rol->getRolId() != $rolId)
                throw new Exception("Inconsistencia en datos especificados.");

            $piv = $this->rolRepository->serachByNameWithoutId($rol->getName(),$rolId);

            if($piv !=null)
                throw new Exception("El nombre ya existe para otro rol");

            $current = $this->rolRepository->findById($rol->getRolId());

            if($current == null)
                throw new Exception("no se ha encontrado el rol especificado.");
            if($current->getRolId() != $rol->getRolId())
                throw new Exception("El rol y el objeto encontrado no conicide");

            $current->setName($rol->getName());
            $current->setIsActive($rol->isActive());
            $current->setDescription($rol->getDescription());

            if($this->rolRepository->update($current)){
                $res->message   ="Rol actualizado con exito.";
                $res->success   = true;
                $res->data      = $current;
            }

        }catch(Exception $ex){
            $res->message= $ex->getMessage();
            $res->success = false;
            $res->data =null;
        }

        return $res;
    }

    public function addRolMenu(RolMenu $rolMenu,string $rolCode){
        $result = new Result();

        try{
            if($rolMenu->getRolCode() != $rolCode)
                throw new Exception("Entidad no es consistentente");

            $this->rolRepository->addMenuRol($rolMenu);

            $result->success = true;
            $result->message = "Ok";
            $result->data   = true;
        }catch(Exception $ex){
            $result->message = $ex->getMessage();
            $result->success = false;
            $result->data   = null;
        }
        return $result;
    }

    public function removeRolMenu(RolMenu $menuRol, string $rolId){
        $result = new Result();
        try{
            if($menuRol->getRolCode() != $rolId)
                throw new Exception('Error de inconsistencia');
            $this->rolRepository->removeMenuRol($menuRol);

            $result->success = true;
            $result->message = "Ok";
            $result->data   = true;
        }catch(Exception $ex){
            $result->message = $ex->getMessage();
            $result->success = true;
            $result->data   = null;
        }
        return $result;
    }

}
