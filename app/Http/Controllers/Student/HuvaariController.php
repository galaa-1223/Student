<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Huvaari;
// use App\Models\Teachers;
use App\Models\Fond;

class HuvaariController extends Controller
{
    public function index()
    {
        $pageTitle = 'Хичээлийн хуваарь';
        $pageName = 'huvaari';
        
        // $teacher = Teachers::select('teachers.id', 'teachers.ner', 'teachers.ovog', 'teachers.image','teachers.code', 'teacher_mergejil.ner as mergejil')
        //                     ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
        //                     ->orderBy('ner', 'asc')
        //                     ->findOrFail($id);

        // $fonds = Fond::select('fond.id as fid', 'fond.t_id', 'fond.tsag as tsag', 'teachers.id', 'angi.ner as angi', 'angi.course as course', 'angi.buleg as buleg', 'angi.tovch', 'hicheel.ner as hicheel', 'hicheel.tovch as hicheel_tovch')
        //                     ->join('teachers', 'teachers.id', '=', 'fond.t_id')
        //                     ->join('angi', 'angi.id', '=', 'fond.a_id')
        //                     ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
        //                     ->orderBy('angi', 'asc')
        //                     ->where('fond.t_id', 21)->get();
        $huvaariud = Huvaari::select('huvaari.*', 'angi.ner AS angi_ner', 'angi.tovch AS angi_tovch', 'angi.b_id AS angi_bagsh', 'angi.m_id AS angi_mergejil', 'hicheel.ner as hicheel', 'hicheel.tovch as hicheel_tovch')
                            ->join('fond', 'fond.id', '=', 'huvaari.f_id')
                            ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
                            ->join('angi', 'angi.id', '=', 'fond.a_id')
                            ->where('angi.id', Auth::guard('student')->user()->a_id)->get();

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            // 'teacher' => $teacher,
            // 'fonds' => $fonds,
            'huvaariud' => $huvaariud,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function add()
    {
        $pageTitle = 'Хичээл нэмэх';
        $pageName = 'huvaari';

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function bagsh($id)
    {
        $pageTitle = 'Багшийн хуваарь';
        $pageName = 'huvaari';

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/huvaari', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('student')->user()
        ]);
    }
}
