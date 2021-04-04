<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Auth;

use App\Models\Teachers;
use App\Models\Tenhim;
use App\Models\MergejilBagsh;
use App\Models\Fond;

class TeachersController extends Controller
{

    public function index()
    {
        $pageTitle = 'Багш';
        $pageName = 'teachers';
        $teachers = Fond::select('fond.*', 'teachers.ner', 'teachers.ovog', 'teacher_mergejil.ner as mergejil', 'tenhim.tovch as tenhim', 'hicheel.ner as hicheel')
                            ->join('teachers', 'teachers.id', '=', 'fond.t_id')
                            ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
                            ->join('tenhim', 'tenhim.id', '=', 'teachers.t_id')
                            ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
                            ->where('fond.a_id', Auth::guard('student')->user()->a_id)->get();

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teachers' => $teachers,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function add()
    {
        $pageTitle = 'Багш нэмэх';
        $pageName = 'teachers';

        $tenhim = Tenhim::orderBy('created_at', 'desc')->get();
        $mergejil = MergejilBagsh::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'tenhims' => $tenhim,
            'mergejils' => $mergejil,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function store(Request $request)
    {

        $member = new Teachers;

        if ($request->hasFile('image')) {

            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->code) . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/teachers/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/teachers/thumbs/' .$imageName.'.jpg'));
            $member->image = $imageName.'.jpg';
        }

        $member->ner = Str::ucfirst($request->get("ner"));
        $member->ovog = Str::ucfirst($request->get("ovog"));
        $member->urag = Str::ucfirst($request->get("urag"));
        $member->code = $request->get("code");
        $member->register = $request->get("register");
        $member->huis = $request->get("huis");
        $member->tursun = $request->get("tursun");
        $member->email = $request->get("email");
        $member->password = $request->get("password");
        $member->t_id = $request->get("t_id");
        $member->mb_id = $request->get("mb_id");
        $member->phone = $request->get("phone");
        $member->address = $request->get("address");


        $member->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teachers')->with('success', 'Багш амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Багш амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Багш засварлах';
        $pageName = 'teachers';

        $teacher = Teachers::findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teacher' => $teacher,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function update(Request $request, $id)
    {
        $member = Teachers::findOrFail($id);

        if ($request->hasFile('image')) {

            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->code) . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/teachers/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/teachers/thumbs/' .$imageName.'.jpg'));
            $member->image = $imageName.'.jpg';
        }

        $member->ner = Str::ucfirst($request->get("ner"));
        $member->ovog = Str::ucfirst($request->get("ovog"));
        $member->urag = Str::ucfirst($request->get("urag"));
        $member->code = $request->get("code");
        $member->register = $request->get("register");
        $member->huis = $request->get("huis");
        $member->tursun = $request->get("tursun");
        $member->email = $request->get("email");
        $member->password = $request->get("password");
        $member->phone = $request->get("phone");
        $member->address = $request->get("address");
        $member->updated_at = Carbon::now();

        $member->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teachers')->with('success', 'Багш засварлагдлаа нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Багш засварлагдлаа нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        $member = Teachers::findOrFail($id);
        $member->delete();

        return redirect()->route('teachers')->with('success', 'Багш устгагдлаа нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        $member = Teachers::findOrFail($request->get("t_id"));
        $member->delete();
        return redirect()->route('student-teachers')->with('success', 'Багш амжилттай устгалаа!'); 
    }

}
