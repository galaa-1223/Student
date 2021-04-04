<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Models\Settings;
use App\Models\Notification;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;

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
        if (Schema::hasTable('settings')) {
            foreach (Settings::all() as $setting) {
                Config::set('settings.'.$setting->key, $setting->value);
            }
        }

        view()->composer('*', function ($view) 
        {
            if (Auth::guard('student')->check()) {

                $student = Students::select('students.*', 'angi.ner as angi', 'angi.tovch as angi_tovch', 'angi.buleg as angi_buleg', 'angi.course as angi_course', 'angi.m_id', 'angi.b_id', 'teachers.ner as bagsh', 'teachers.ovog as bagsh_ovog')
                            ->join('angi', 'angi.id', '=', 'students.a_id')
                            ->join('teachers', 'teachers.id', '=', 'angi.b_id')
                            ->where('students.id', Auth::guard('student')->user()->id)->first();

                $view->with('student', $student);
            }else {
                $view->with('student', null);
            }

            $notifications = Notification::select('activity_log.description', 'activity_log.updated_at', 'biggs.name as name', 'biggs.email as email')
                            ->join('biggs', 'biggs.id', '=', 'activity_log.causer_id')
                            ->limit(5)
                            ->orderBy('updated_at', 'desc')->get();
    
            $view->with('notifications', $notifications );    
        });  
    }
}
