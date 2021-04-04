<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use App\Models\Settings;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function index()
    {

        $pageTitle = 'Хувийн мэдээлэл';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function password()
    {

        $pageTitle = 'Нууц үг солих';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/password', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('student')->user()
        ]);
    }

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::guard('student')->user()->password))) {
            return redirect()->back()->with("error2","Таны одоогийн нууц үг таны оруулсан нууц үгтэй таарахгүй байна. Дахин оролдоно уу.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error2","Шинэ нууц үг нь таны одоогийн нууц үгтэй ижил байж болохгүй. Өөр нууц үг сонгоно уу.");
        }

        $request->validate([
            'new-password' => 'between:8,255|required_with:new-password-confirm|same:new-password-confirm',
            'new-password-confirm' => 'required|between:8,255'
        ]);

        $user = Auth::guard('student')->user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success2","Нууц үг амжилттай өөрчлөгдсөн!");

    }

    public function changePicture(Request $request, $id)
    {
        if ($request->hasFile('image')) {

            $student = Students::findOrFail($id);

            if($student->image != null){
                $imagePath = public_path('/uploads/students/'.$student->image);
                $imageThumbPath = public_path('/uploads/students/thumbs/'.$student->image);

                if(file_exists($imagePath))
                {
                    unlink($imagePath);
                    unlink($imageThumbPath);
                }
            }

            $date = Str::slug(Carbon::now());
            $imageName = Str::slug('123') . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/students/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/students/thumbs/' .$imageName.'.jpg'));
            
            
            $student->image = $imageName.'.jpg';
            $student->save();
        }

        return redirect()->route('student-settings')->with('success', 'Оюутны зураг амжилттай солигдлоо!'); 
    }

    public function huvaari()
    {

        $pageTitle = 'Хуваарь тохиргоо';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('student/pages/'.$pageName.'/huvaari', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('student')->user()
        ]);
    }
}
