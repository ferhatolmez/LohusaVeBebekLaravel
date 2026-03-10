<?php

namespace App\Policies;

use App\Models\LohusaForm;
use App\Models\User;

class LohusaFormPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view lohusa forms');
    }

    public function view(User $user, LohusaForm $lohusaForm): bool
    {
        return $user->can('view lohusa forms');
    }

    public function create(User $user): bool
    {
        return $user->can('create lohusa forms');
    }

    public function update(User $user, LohusaForm $lohusaForm): bool
    {
        return $user->can('update lohusa forms');
    }

    public function delete(User $user, LohusaForm $lohusaForm): bool
    {
        return $user->can('delete lohusa forms');
    }

    public function export(User $user, ?LohusaForm $lohusaForm = null): bool
    {
        return $user->can('export lohusa forms');
    }
}
