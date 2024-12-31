<?php

namespace App\Domain\Segment\Policies;

use App\Domain\Segment\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SegmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Segment $segment): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Segment $segment): bool
    {
    }

    public function delete(User $user, Segment $segment): bool
    {
    }

    public function restore(User $user, Segment $segment): bool
    {
    }

    public function forceDelete(User $user, Segment $segment): bool
    {
    }
}
