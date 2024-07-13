<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('ver reportes');
    }

    public function view(User $user, Report $report)
    {
        return $user->can('ver reportes');
    }

    public function create(User $user)
    {
        return $user->can('crear reportes');
    }

    public function update(User $user, Report $report)
    {
        return $user->can('actualizar reportes');
    }

    public function delete(User $user, Report $report)
    {
        return $user->can('borrar reportes');
    }
}
