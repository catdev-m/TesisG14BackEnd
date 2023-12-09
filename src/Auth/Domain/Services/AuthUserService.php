<?php
namespace Memories\Auth\Domain\Services;


use Exception;
use App\Models\Result;
use Memories\Auth\Domain\Interfaces\IUserRepository;


class AuthUserService
{
    private IUserRepository $userRepository;

    function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getMenusAndPemrissions(string $email){
        $result = new Result();
        try{
            if( $email==null ||$email  == '')
                throw new Exception('Email is required');

            $user = $this->userRepository->getUserByEmail($email);

            if($user == null)
                throw new Exception("User not found");

            $roles = $this->userRepository->getRoles($user->getUserId());
            $menus = $this->userRepository->getMenus($roles);
            $permissions = $this->userRepository->getPermissions($roles);

            $result->success = true;
            $result->message = 'Sucess data';
            $result->data = [
                'user'=>$user,
                'menus'=>$menus,
                'permissions'=>$permissions
            ];
            return $result;
        }catch(Exception $ex){
            $result->success = false;
            $result->message = $ex->getMessage();
            $result->data = null;
        }
        return $result;
    }
}
