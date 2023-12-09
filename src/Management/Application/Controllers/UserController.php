<?php

namespace Memories\Management\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Memories\Management\Domain\Entities\RolUser;
use Memories\Management\Domain\Mappers\RolUserMapper;
use Memories\Management\Domain\Services\TUserService;

class UserController extends Controller{

    private TUserService $userService;

    public function __construct(TUserService $userService)
    {
        $this->userService = $userService;
    }

    public function fetchAllUsers(){
        $res = $this->userService->fetchUsers();
        return response()->json($res->toArray());
    }

    public function addRolToUser(Request $request, string $userId){
        $rolUser = RolUserMapper::fromRequestToEntity($request, $userId);
        $res = $this->userService->addRolToUser($rolUser);
        return response()->json($res->toArray());
    }

    public function  removeRolOfUser(Request $request, string $userId){
        $rolUser = RolUserMapper::fromRequestToEntity($request, $userId);
        $res = $this->userService->removeRolFromUser($rolUser);
        return response()->json($res->toArray());
    }

    public function fetchRolesByUser(string $userId){
        $roles = $this->userService->fetchRolesByUser($userId);
        return response()->json($roles->toArray());
    }



}
