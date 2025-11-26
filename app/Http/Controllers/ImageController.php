<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function uploadform()
    {
        return view('upload-image');
    }


    public function upload(Request $request)
    {
        

        // 1. اعتبارسنجی
        $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                function ($attribute, $value, $fail) {
                    $filename = $value->getClientOriginalName();
                    if (Storage::disk('public')->exists('profile/' . $filename)) {
                        $fail("this file has been uploaded");
                    }
                }
            ]
        ]);

        //پاک کردن پروفایل قبلی
        if (auth()->user()->profile_path) {
            Storage::disk('public')->delete(auth()->user()->profile_path);
        }

        // ذخیره نام سمت کاربر
        $originalName = $request->image->getClientOriginalName();

        // 2. آپلود فایل و گرفتن مسیر
        $path = $request->image->storeAs('profile' , $originalName , 'public');

        // 3. ذخیره مسیر در کاربر جاری (لاگین‌شده)
        
        auth()->user()->update(['profile_path' => $path]);

        // 4. ریدایرکت با پیام موفقیت
        return redirect('/')->with('success', 'profile successfully uploaded.');
    }
}
