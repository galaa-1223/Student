<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $pageTitle = 'Үйл явдал';
        $pageName = 'events';

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('student')->user()
        ]);
    }
}
