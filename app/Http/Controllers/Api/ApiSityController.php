<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiSityController extends Controller
{
    public function refresh()
    {

        DB::table('sities')->delete();

        $arSitiesHh = json_decode(file_get_contents('https://api.hh.ru/areas'), true);
        if(!empty($arSitiesHh[0]['areas'])){
            foreach ($arSitiesHh[0]['areas'] as $region) {
                foreach($region['areas'] as $sity){
                    $arSities[] = [
                        'name_en' => mb_strtolower($this->translit($sity['name'])),
                        'name_ru' => $sity['name']
                    ];
                }
            }
            $countItems = DB::table('sities')->insertOrIgnore($arSities);
        }

        $response = [
            'status' => 'ok',
            'total_items' => $countItems
        ];

        return $response;

    }

    public function add(Request $request){

        foreach($request->all() as $keyOneItem => $oneItem){
            try{
                Validator::make($oneItem, [
                    'name' => 'string|unique:sities,name_ru|max:150',
                ]);

                $arSity = [
                    'name_en' => mb_strtolower($this->translit($oneItem['name'])),
                    'name_ru' => $oneItem['name']
                ];

                DB::table('sities')->insert($arSity);
            }
            catch(\Throwable $ex)
            {
                $response = [
                    'status' => 'error',
                    'message' => 'error in element ' . $keyOneItem + 1,
                    'system_message' => $ex->getMessage()
                ];
                return $response;
            }
        }

        $response = [
            'status' => 'ok',
            'message' => $keyOneItem + 1 . ' elements added'
        ];

        return $response;
    }

    public function delete(Request $request){

        foreach($request->all() as $keyOneItem => $oneItem){
            $del = DB::table('sities')->where('name_ru', '=', $oneItem)->delete();
            $countDelElems[] = $del == true ? 1 : 2;
        }
        $countDel = 0;
        $arCount = array_count_values($countDelElems);
        if(!empty($arCount[1]))$countDel = $arCount[1];

        $response = [
            'status' => 'ok',
            'message' => $countDel . ' items removed',
        ];

        return $response;
    }


    protected function translit($str)
    {
        $tr = array(
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
            'Д' => 'D', 'Е' => 'E', 'Ж' => 'J', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS', 'Ч' => 'CH',
            'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '', 'Ы' => 'YI', 'Ь' => '',
            'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a', 'б' => 'b',
            'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ж' => 'j',
            'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
            'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h',
            'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => 'y',
            'ы' => 'yi', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'Ё' => 'E', 'Є' => 'E', 'Ї' => 'YI', 'ё' => 'e', 'є' => 'e', 'ї' => 'yi',
            ' ' => '_', '/' => '_'
        );
        if (preg_match('/[^A-Za-z0-9_\-]/', $str)) {
            $str = strtr($str, $tr);
            $str = preg_replace('/[^A-Za-z0-9_\-.]/', '', $str);
        }
        return $str;
    }
}
