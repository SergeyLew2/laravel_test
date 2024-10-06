<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MainController extends Controller
{
    public function index()
    {

        $session_sity = session('sity');
        if(!empty($session_sity)){
            return redirect()->action([MainController::class, 'index_session'],  $session_sity);
        }
        $sities =  DB::table('sities')->get();

        return view('pages.sity_content', ["sities" => $sities]);
    }

    public function about()
    {

        $session_sity = session('sity');
        if($session_sity){
            return redirect()->action([MainController::class, 'about_session']);
        }

        return view('pages.about_content');
    }

    public function news()
    {

        $session_sity = session('sity');
        if($session_sity){
            return redirect()->action([MainController::class, 'news_session']);
        }

        return view('pages.news_content');
    }

    public function index_session($sity)
    {
        $sity_ru = DB::table('sities')->where('name_en', $sity)->value('name_ru');
        session(['sity' => $sity, 'sity_ru' => $sity_ru]);
        $sities = DB::table('sities')->get();

        return view('pages.sity_content', ['sities' => $sities]);
    }

    public function about_session($sity)
    {
        $sity_ru = DB::table('sities')->where('name_en', $sity)->value('name_ru');
        session(['sity' => $sity, 'sity_ru' => $sity_ru]);
        return view('pages.about_content');
    }

    public function news_session($sity)
    {
        $sity_ru = DB::table('sities')->where('name_en', $sity)->value('name_ru');
        session(['sity' => $sity, 'sity_ru' => $sity_ru]);
        return view('pages.news_content');
    }

    public function session_reset()
    {
        session()->forget(['sity', 'sity_ru']);
        return redirect()->action([MainController::class, 'index']);
    }
}
