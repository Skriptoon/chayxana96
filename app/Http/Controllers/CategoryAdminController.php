<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;

class CategoryAdminController extends CategoryController
{
    public function get($menu = null) {
        $category = parent::get()->get();
        
        $sort = $this->getSort();
        $sort = json_decode($sort->sort);

        $categories = [];
        foreach($category as $item) {
            $categories[$item->id] = $item; 
        }

        $sortCategory = [];
        for($i = 0; $i < count($sort); $i++) {
            for($k = 0; $k < count($sort[$i]); $k++) {
                if(isset($categories[$sort[$i][$k]])) {
                    $sortCategory[$i][] = $categories[$sort[$i][$k]];
                } 
            }
        }

        foreach($categories as $key => $val) {
            if(array_search($key, $sort[$val->menu - 1]) === false)
                $sortCategory[$val->menu - 1][] = $val;
        }

        return $sortCategory;
    }

    public function save(Request $request) {
        $sort = parent::get()->updateOrInsert(
            ['id' => $request->id],
            ['name' => $request->name,
            'id_name' => $this->translit($request->name),
            'menu' => $request->menu]
        );
    }

    public function delete(Request $request) {
        $sort = parent::get()->where('id', '=', $request->id)->delete();
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
