<?php

namespace Memories\Organization\Domain\Services;

use App\Models\Result;
use Exception;
use Memories\Organization\Domain\Contracts\IFacultyRepository;
use Memories\Organization\Domain\Entities\Faculty;

class FacultyService{

    private $factultyRepository;

    public function __construct(IFacultyRepository $repository)
    {
        $this->factultyRepository = $repository;
    }

    public function fetchFaculties(){
        $result= new Result();
        try{
            $res = $this->factultyRepository->searchAll();
            $result->success = true;
            $result->message="Sucess request";
            $result->data= $res;
        }catch(Exception $ex){
            $result->success= false;
            $result->message = $ex->getMessage();
            $result->data= null;
        }
        return $result;
    }

    public function saveFaculty(Faculty $faculty){
        $result= new Result();
        try{
            $res = $this->factultyRepository->create($faculty);
            $result->success = true;
            $result->message="Sucess request";
            $result->data= $res;
        }catch(Exception $ex){
            $result->success= false;
            $result->message = $ex->getMessage();
            $result->data= null;
        }
        return $result;
    }

    public function updateFaculty(Faculty $faculty){
        $result= new Result();
        try{
            $res = $this->factultyRepository->update($faculty);
            $result->success = true;
            $result->message="Sucess request";
            $result->data= $res;
        }catch(Exception $ex){
            $result->success= false;
            $result->message = $ex->getMessage();
            $result->data= null;
        }
        return $result;
    }
}
