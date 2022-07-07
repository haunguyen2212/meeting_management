<?php

namespace App\Providers;

use App\Models\Member;
use App\Models\RoomRegistration;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $today = Carbon::now()->format('Y-m-d H:i:s');
        Paginator::useBootstrap();
        if(!$this->app->runningInConsole()){
            $num_assignment = RoomRegistration::where('status', 1)
                ->whereNull('supporter_id')
                ->where('test_time', '>', $today)
                ->count();
            $num_approval = RoomRegistration::where('status', 0)
                ->where('test_time', '>', $today)
                ->count();
            $registration_overdue = RoomRegistration::where('status', 0)->where('test_time', '<', $today)->get();
            foreach($registration_overdue as $value){
                $value->update([
                    'approval_time' => $today,
                    'status' => '-1',
                    'feedback' => 'Quá hạn phê duyệt',
                ]);
            }
            
            View::share(compact('num_assignment', 'num_approval'));
        }
    }
}
