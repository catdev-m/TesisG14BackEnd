<?php

namespace Memories\Organization\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Memories\Organization\Domain\Contracts\IFacultyRepository;
use Memories\Organization\Domain\Entities\Faculty;
use Memories\Organization\Domain\Mappers\FacultyMapper;

class FacultyRepository implements IFacultyRepository{

    public function searchAll():Collection{
        $raw = DB::table('faculties')
                    ->get();
        return FacultyMapper::fromRawToCollection($raw);
    }

    public function create(Faculty $faculty):Faculty{
        DB::table('faculties')
                ->insert([
                    'faculty_id'=> $faculty->getFacultyId(),
                    'name'=>$faculty->getName(),
                    "created_at"=>$faculty->getCreatedAt(),
                    "updated_at"=>$faculty->getUpdatedAt(),
                    "description"=>$faculty->getDescription(),
                    "active"=>$faculty->isActive()
                ]);
        return $this->findById($faculty->getFacultyId());
    }

    public function update(Faculty $faculty):Faculty{
        DB::table('faculties')
            ->where('faculty_id','=',$faculty->getFacultyId())
            ->update([
                'name'=>$faculty->getName(),
                "updated_at"=>$faculty->getUpdatedAt(),
                "description"=>$faculty->getDescription(),
                "active"=>$faculty->isActive()
            ]);
        return $this->findById($faculty->getFacultyId());
    }

    public function findById(string $facultyId): Faculty
    {
        $raw = DB::table('faculties')
                ->where('faculty_id','=',$facultyId)
                ->first();
        return FacultyMapper::fromRawToEntity($raw);
    }
}
