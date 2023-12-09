<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

use Memories\Management\Domain\Interfaces\IMenuRepository;
use Memories\Management\Domain\Interfaces\IPermissionRepository;
use Memories\Management\Domain\Interfaces\IRolRepository;
use Memories\Management\Domain\Interfaces\ITUserRepository;
use Memories\Auth\Domain\Interfaces\IUserRepository;


use Memories\Management\Domain\Services\MenuService;
use Memories\Management\Domain\Services\PermissionService;
use Memories\Management\Domain\Services\RolService;
use Memories\Management\Domain\Services\TUserService;
use Memories\Auth\Domain\Services\AuthService;
use Memories\Auth\Domain\Services\AuthUserService;


use Memories\Management\Infrastructure\Repositories\MenuRepository;
use Memories\Management\Infrastructure\Repositories\RolRepository;
use Memories\Management\Infrastructure\Repositories\PemissionRepository;
use Memories\Auth\Infrastructure\Repositories\UserRepository;
use Memories\management\Infrastructure\Repositories\TUserRepository;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Management injection
        $this->app->scoped(RolService::class,function(Application $app){
                return new RolService($app->make(IRolRepository::class));
            }
        );
        $this->app->bind(IRolRepository::class,RolRepository::class);
        //==================================================================================
        $this->app->scoped(MenuService::class,function(Application $app){
            return new MenuService($app->make(IMenuRepository::class));
        });
        $this->app->bind(IMenuRepository::class,MenuRepository::class);
        //===================================================================================
        $this->app->scoped(PermissionService::class,function(Application $app){
            return new PermissionService($app->make(IPermissionRepository::class));
        });
        $this->app->bind(IPermissionRepository::class,PemissionRepository::class);

        //===================================================================================
        $this->app->scoped(AuthService::class,function(Application $app){
            return new AuthService();
        });
        //====================================================================================
        $this->app->scoped(AuthUserService::class,function(Application $app){
            return new AuthUserService($app->make(IUserRepository::class));
        });
        $this->app->bind(IUserRepository::class,UserRepository::class);
        //====================================================================================
        $this->app->scoped(TUserService::class,function(Application $app){
            return new TUserService($app->make(ITUserRepository::class));
        });
        $this->app->bind(ITUserRepository::class,TUserRepository::class);
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
