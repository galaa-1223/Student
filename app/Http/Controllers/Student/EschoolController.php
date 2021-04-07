<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

use App\Models\Fond;
use App\Models\BulegSedev;
use App\Models\Aguulga;
use App\Models\Files;

class EschoolController extends Controller
{
    public function index()
    {
        $pageTitle = 'Eschool';
        $pageName = 'eschool';
        $fond = Fond::select('fond.id as fid', 'fond.t_id', 'fond.tsag as tsag', 'fond.slug as slug', 'teachers.id', 'angi.ner as angi', 'angi.course as course', 'angi.buleg as buleg', 'angi.tovch', 'hicheel.ner as hicheel', 'hicheel.tovch as hicheel_tovch')
                            ->join('teachers', 'teachers.id', '=', 'fond.t_id')
                            ->join('angi', 'angi.id', '=', 'fond.a_id')
                            ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
                            ->orderBy('hicheel.ner', 'asc')
                            ->where('fond.a_id', Auth::guard('student')->user()->a_id)->get();
        

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'fonds' => $fond,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function sedevs($slug)
    {
        $pageTitle = 'Бүлэг сэдэв';
        $pageName = 'eschool';

        $fond = Fond::select('fond.id as fid', 'fond.t_id', 'fond.tsag as tsag', 'fond.slug as slug', 'teachers.id', 'angi.ner as angi', 'angi.course as course', 'angi.buleg as buleg', 'angi.tovch', 'hicheel.ner as hicheel', 'hicheel.tovch as hicheel_tovch')
                            ->join('teachers', 'teachers.id', '=', 'fond.t_id')
                            ->join('angi', 'angi.id', '=', 'fond.a_id')
                            ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
                            ->orderBy('hicheel.ner', 'asc')
                            ->where('fond.a_id', Auth::guard('student')->user()->a_id)
                            ->where('slug', '=', $slug)->firstOrFail();
        $bulegs = BulegSedev::where('slug', '=', $slug)
                            ->orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/sedevs', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'fond' => $fond,
            'bulegs' => $bulegs,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function sedev($slug, $id)
    {
        $pageTitle = 'Бүлэг сэдэв';
        $pageName = 'eschool';

        $fond = Fond::select('fond.id as fid', 'fond.t_id', 'fond.tsag as tsag', 'fond.slug as slug', 'teachers.id', 'angi.ner as angi', 'angi.course as course', 'angi.buleg as buleg', 'angi.tovch', 'hicheel.ner as hicheel', 'hicheel.tovch as hicheel_tovch')
                            ->join('teachers', 'teachers.id', '=', 'fond.t_id')
                            ->join('angi', 'angi.id', '=', 'fond.a_id')
                            ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
                            ->orderBy('hicheel.ner', 'asc')
                            ->where('fond.a_id', Auth::guard('student')->user()->a_id)
                            ->where('slug', '=', $slug)->firstOrFail();
        $buleg = BulegSedev::where('slug', '=', $slug)
                            ->where('id', '=', $id)
                            ->orderBy('created_at', 'desc')->first();
        $aguulgas = Aguulga::where('slug', '=', $slug)
                            ->where('buleg', '=', $id)
                            ->where('a_id', '=', Auth::guard('student')->user()->a_id)
                            ->orderBy('created_at', 'desc')->get();
        $files = Files::All();

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/sedev', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'fond' => $fond,
            'buleg' => $buleg,
            'aguulgas' => $aguulgas,
            'files' => $files,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function sedevAdd($slug)
    {
        $pageTitle = 'Бүлэг сэдэв нэмэх';
        $pageName = 'eschool';

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/sedev_add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'slug' => $slug,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function sedevSave(Request $request, $slug)
    {
        $sedev = new BulegSedev;

        $sedev->ner = Str::ucfirst($request->ner);
        $sedev->slug = $request->slug;

        $sedev->save();

        return redirect()->route('student-eschool-sedev', $slug)->with('success', 'Бүлгийн сэдэв амжилттай нэмэгдлээ!'); 

    }

}
