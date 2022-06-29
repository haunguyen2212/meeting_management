<?php

namespace App\Providers;

use App\Models\Member;
use App\Models\RoomRegistration;
use App\Models\User;
use App\Policies\RoomRegistrationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        RoomRegistration::class => RoomRegistrationPolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define('edit-info', function(User $user, Member $member){
            return $user->id === $member->account_id;
        });
    }
}
