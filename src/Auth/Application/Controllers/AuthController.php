<?php
namespace Memories\Auth\Application\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Memories\Auth\Domain\Services\AuthService;
use Memories\Auth\Domain\Mappers\AuthMapper;
use Memories\Auth\Domain\Services\AuthUserService;

class AuthController extends Controller
{
    private ?AuthService $service;
    private ?AuthUserService $userService;

    function __construct(AuthService $authService,AuthUserService $userService)
    {
        $this->service = $authService;
        $this->userService = $userService;
    }

    public function login(Request $request){

        $credentials =  AuthMapper::fromRequestToEntity($request);
        $res = $this->service->loginUser($credentials);

        return response()->json($res);
    }

    public function menusAndPemisions(Request $request){
        $email = $request->string('email');

        $res = $this->userService->getMenusAndPemrissions($email);

        return response()->json($res);
    }
}
