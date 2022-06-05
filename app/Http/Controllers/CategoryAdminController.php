<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Validator;

class CategoryAdminController extends CategoryController
{
    public function get() {
        $category = $this->modelCategory::get();

        $categories = [];
        foreach($category as $item) {
            $categories[$item->id] = $item;
        }
        return $this->sort($categories);
    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(Request $request) {
        Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required',
            'menu' => 'required'],
            ['name.required' => 'Обязательное поле'])->validate();

        $sort = $this->modelCategory::updateOrInsert(
            ['id' => $request->id],
            ['name' => $request->name,
            'id_name' => $this->translit($request->name),
            'menu' => $request->menu]
        );
    }

    public function delete(Request $request) {
        $sort = $this->modelCategory::where('id', '=', $request->id)->delete();
    }

    public function updateSort(Request $request) {
        $sort = $this->modelSort::updateOrInsert(
            ['type' => 'category'],
            ['sort' => $request->sort]
        );
    }

    private function translit($value)
    {
        $converter = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
        );

        $value = mb_strtolower($value);
        $value = strtr($value, $converter);
        $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
        $value = mb_ereg_replace('[-]+', '-', $value);
        $value = trim($value, '-');

        return $value;
    }
}
