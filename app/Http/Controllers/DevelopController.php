<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Controllers\Controller;

class DevelopController extends Controller
{
    public function get(Request $request)
    {
        $code = $request->input('code');
        if (empty($code)) {
            return view("develop");
        } else {
            /* Oauth */
            $url = "https://opst.backlog.jp/api/v2/oauth2/token";
            $curl = curl_init($url);
            $params = array(
                'grant_type' => "authorization_code",
                'code' => $code,
                'client_id' => 'Uysni4pyGITEIrQLxPxhkwVgyqqfH0cw',
                'client_secret' => 'yrngUlUMifahOW2Fa80B9UQkLAzlOge5LeeFTX3peowGHuvDfaIzySG45kEFT1WH'
            );
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($curl), true);
            /* GET User Info */
            $url = "https://opst.backlog.jp/api/v2/users/myself";
            $curl = curl_init($url);
            if (isset($result["access_token"])) {
                $access_token = $result["access_token"];
                $header = 'Authorization: Bearer '.$access_token;
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array($header));
                curl_setopt($curl, CURLOPT_HTTPGET, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $result_user_info = json_decode(curl_exec($curl), true);
                $mail_address = $result_user_info["mailAddress"];
                $article_dates = Article::select('date')->groupBy('date')->get()->toArray();
                $article_lists = Article::select('date', 'hash', 'title')->get()->toArray();
                $tables = DB::select('SHOW TABLES');
                $columns_array = array();
                foreach ($tables as $table_array) {
                   $table = array_flatten($table_array)[0];
                   $columns = DB::getSchemaBuilder()->getColumnListing($table);
                   $columns_array[$table] = $columns;
                }
                return view("develop", array(
                    'access_token' => $access_token,
                    'mail_address' => $mail_address,
                    'article_dates' => $article_dates,
                    'article_lists' => $article_lists,
                    'tables' => $tables,
                    'columns' => $columns_array
                ));
            } else {
                return view("develop");
            }
        }
    }
    public function getData(Request $request)
    {
        $table = $request->input('table');
        $result = DB::table($table)->get();
        return response()->json($result);
    }
}
