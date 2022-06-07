<?php

namespace App\Http\Controllers;

use \App\Models\Banner;
use Illuminate\Http\Request;;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function get() {
        return Banner::get();
    }

    public function save(Request $request) {
        Validator::make($request->all(), ['id' => 'required|integer'])->validate();

        if($request->has('main_page'))
            $main_page = 1;
        else
            $main_page = 0;

        $data = ['header' => $request->header,
            'text' => $request->text];

        if($request->hasFile('banner_img')) {
            $path = $request->banner_img->store('images/banners', 'public');
            $data['img'] = $path;
        }

        $sort = Banner::updateOrInsert(['id' => $request->id], $data);
    }

    public function delete(Request $request) {
        $sort = Banner::where('id', $request->id)->delete();
    }
}
