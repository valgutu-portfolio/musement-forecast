<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    protected int $perPage = 10;

    protected Model $model;

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function get(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $fillable)
    {
        $object = $this->model->create($fillable);
        return $this->get($object->id);
    }

    public function update(int $id, array $fillable): bool
    {
        $object = $this->get($id);
        $object->fill($fillable);
        return $object->save();
    }

    public function delete(int $id): bool
    {
        $object = $this->get($id);
        return $this->model
            ->where('id', $object->id)
            ->delete();
    }
}
