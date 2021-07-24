<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IBaseRepository
{
    public function all(): Collection;

    public function get(int $id);

    public function create(array $fillable);

    public function update(int $id, array $fillable): bool;

    public function delete(int $id): bool;
}
