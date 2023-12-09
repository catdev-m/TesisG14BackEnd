<?php
namespace Memories\Organization\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Memories\Organization\Domain\Contracts\IFacultyRepository;
use Memories\Organization\Infrastructure\Repositories\FacultyRepository;
use Memories\Organization\Domain\Services\FacultyService;

class OrganizationProvider extends ServiceProvider{

    public function register(): void
    {
        //======================================================================
        $this->app->scoped(FacultyService::class,function(Application $app){
            return new FacultyService($app->make(IFacultyRepository::class));
        });
        $this->app->bind(IFacultyRepository::class,FacultyRepository::class);


    }

    public function boot():void{

    }
}
