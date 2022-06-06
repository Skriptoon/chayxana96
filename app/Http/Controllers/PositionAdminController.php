<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PositionAdminController extends PositionController
{
    public function get() {
        $position = $this->modelPositions::select(DB::raw('`menu__positions`.*, `menu__categories`.`menu`'))
        ->join('menu__categories', 'menu__positions.id_category', '=', 'menu__categories.id')->get();

        $positions = [];

        foreach($position as $item) {
            $positions[$item->id] = $item;
        }

        return $this->sort($positions);
    }

    public function updateSort($request) {
        $sort = $this->modelSort::updateOrInsert(
            ['type' => 'position'],
            ['sort' => $request->sort]
        );
    }

    public function save(Request $request) {
        Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required',
            'price' => 'required|integer',
            'menu' => 'required',
            'desc' => 'max:250'],
            ['name.required' => 'Обязательное поле',
            'price.required' => 'Обязательное поле',
            'price.integer' => 'Цена не может содержать буквы',
            'desc.max' => 'Не более 250 символов'])->validate();

        if($request->has('main_page'))
            $main_page = 1;
        else
            $main_page = 0;

        $data = ['name' => $request->name,
            'id_category' => $request->menu,
            'desc' => $request->desc,
            'price' => $request->price,
            'main_page' => $main_page];

        if($request->hasFile('menu_img')) {
            $path = $request->menu_img->store('images', 'public');
            $data['img'] = $path;
        }

        $sort = $this->modelPositions::updateOrInsert(['id' => $request->id], $data);
    }

    public function delete(Request $request) {
        $sort = $this->modelPositions::where('id', $request->id)->delete();
    }
}
