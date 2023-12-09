<?php

namespace Memories\Organization\Domain\Contracts;

use Illuminate\Support\Collection;
use Memories\Organization\Domain\Entities\Faculty;

interface IFacultyRepository{

    /**
     * Obtiene todas las facultades que se encuentran en la
     * tabla correspondiente
     * @return Illuminate\Support\Collection;
     */
    function searchAll():Collection;

    /**
     * Crea el registro de la facultad correspondiente.
     * @param Memories\Org\Domain\Entities\Faculty;
     * @return Illuminate\Support\Collection;
     */
    function create(Faculty $faculty):Faculty;

    /**
     * Actualiza el registro de la facultad correspondiente
     * @param Memories\Org\Domain\Entities\Faculty;
     * @return Illuminate\Support\Collection;
     */
    function update(Faculty $faculty):Faculty;

    /**
     * Busca una facultad por su facultyId
     * @param   string
     * @return Memories\Organization\Domain\Entities\Faculty;
     */
    function findById(string $facultyId):Faculty;

}
