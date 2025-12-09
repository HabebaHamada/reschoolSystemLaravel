<?php

namespace App\Repositories;

use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Collection;

class SchoolClassRepository
{
    protected $model;

    public function __construct(SchoolClass $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?SchoolClass
    {
        return $this->model->find($id);
    }

    public function create(array $data): SchoolClass
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $schoolClass = $this->find($id);
        if ($schoolClass) {
            return $schoolClass->update($data);
        }
        return false;
    }
    public function delete(int $id): bool
    {
        $schoolClass = $this->find($id);
        if ($schoolClass) {
            return $schoolClass->delete();
        }
        return false;
    }

    public function getClassWithStudents(int $id): ?SchoolClass
    {
        return $this->model->with('students')->find($id);
    }
 


}