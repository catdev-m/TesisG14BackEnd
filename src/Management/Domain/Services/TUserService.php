<?php
namespace Memories\Management\Domain\Services;

use App\Models\Result;
use Exception;
use Memories\Management\Domain\Entities\Rol;
use Memories\Management\Domain\Entities\RolUser;
use Memories\Management\Domain\Interfaces\ITUserRepository;

class TUserService{

    private ITUserRepository $userRepository;

    public function __construct(ITUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function fetchUsers(){
        $result = new Result();
        try{
            $users = $this->userRepository->fetchAll();

            $result->success = true;
            $result->message = 'Sucess request';
            $result->data = $users;
        }catch(Exception $ex){

            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data = null;
        }

        return $result;
    }

    /**
     * Recupera los roles asociados a un usuario
     * @param string
     * @return App\Models\Result;
    */
    public function fetchRolesByUser(string $userId):Result{
        $result = new Result();
        try{
            $res = $this->userRepository->searchRolesByUserId($userId);

            $result->success = true;
            $result->message = 'Success request';
            $result->data = $res;
        }catch(Exception $ex){
            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data = null;
        }
        return $result;
    }

    /**
     * Agrega un rol a un usuario proporcionado
     * @param Memories\Management\Domain\Entities\Rol
     * @param string
     * @return App\Models\Result;
     */
    public function addRolToUser(RolUser $rolUser):Result{
        $result = new Result();
        try{
            $res = $this->userRepository->insertUserRol($rolUser);

            $result->success = $res;
            $result->message = "Rol added sucessfull";
            $result->data = $res;

        }catch(Exception $ex){
            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data = false;
        }
        return $result;
    }

    /**
     * Agrega un rol a un usuario proporcionado
     * @param Memories\Management\Domain\Entities\Rol
     * @param string
     * @return App\Models\Result;
     */
    public function removeRolFromUser(RolUser $rolUser):Result{
        $result = new Result();
        try{
            $res = $this->userRepository->removeUserRol($rolUser);

            $result->success = $res;
            $result->message = "Rol remove sucessfull";
            $result->data = $res;

        }catch(Exception $ex){
            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data = false;
        }
        return $result;
    }
}

