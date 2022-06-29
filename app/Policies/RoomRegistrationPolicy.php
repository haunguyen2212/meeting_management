<?php

namespace App\Policies;

use App\Models\RoomRegistration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomRegistrationPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, RoomRegistration $roomRegistration)
    {
        return $user->id === $roomRegistration->register_id;
    }


    public function create(User $user)
    {
        //
    }

    public function update(User $user, RoomRegistration $roomRegistration)
    {
        //
    }

    public function delete(User $user, RoomRegistration $roomRegistration)
    {
        if($roomRegistration->status != 0){
            return false;
        }
        return $user->id === $roomRegistration->register_id;
    }

    public function restore(User $user, RoomRegistration $roomRegistration)
    {
        //
    }


    public function forceDelete(User $user, RoomRegistration $roomRegistration)
    {
        //
    }
}
