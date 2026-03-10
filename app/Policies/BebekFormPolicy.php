<?php

namespace App\Policies;

use App\Models\BebekForm;
use App\Models\User;

class BebekFormPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view bebek forms');
    }

    public function view(User $user, BebekForm $bebekForm): bool
    {
        return $user->can('view bebek forms');
    }

    public function create(User $user): bool
    {
        return $user->can('create bebek forms');
    }

    public function update(User $user, BebekForm $bebekForm): bool
    {
        return $user->can('update bebek forms');
    }

    public function delete(User $user, BebekForm $bebekForm): bool
    {
        return $user->can('delete bebek forms');
    }

    public function export(User $user, BebekForm $bebekForm): bool
    {
        return $user->can('export bebek forms');
    }
}
