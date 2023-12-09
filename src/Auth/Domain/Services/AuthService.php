<?php

namespace Memories\Auth\Domain\Services;

use App\Models\Result;
use Exception;
use Memories\Auth\Domain\Entities\Auth as MemoriesAuth;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
class AuthService
{
    /**
     *  Generate token bearer for API autorization.
     * @return App\Models\Result;
     */
    public function loginUser(MemoriesAuth $credentials){
        $result = new Result();
       // dd(bcrypt('secret$2023'));
        try{
            $token = auth()->attempt($credentials->toArray());

            if(! $token)
                throw new Exception("Bad credentials");

            $result->success= true;
            $result->message="success login";
            $result->data=[
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' =>  auth('api')->factory()->getTTL() * 60,
            ];
        }catch(Exception $ex){
            $result->success = false;
            $result->message= $ex->getMessage();
            $result->data = null;
        }
        return $result;
    }
}
