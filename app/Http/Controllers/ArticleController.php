<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Controllers\Controller;
use Cache;
use DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        switch($sort){
            case "new":
                $result = Article::orderBy('date', 'desc')->get(['id', 'title', 'hash', 'date', 'views', 'favorites', 'shares']);
                break;
            case "view":
                $result = Article::orderBy('views', 'desc')->get(['id', 'title', 'hash', 'date', 'views', 'favorites', 'shares']);
                break;
            case "like":
                $result = Article::orderBy('favorites', 'desc')->get(['id', 'title', 'hash', 'date', 'views', 'favorites', 'shares']);
                break;
            case "share":
                $result = Article::orderBy('shares', 'desc')->get(['id', 'title', 'hash', 'date', 'views', 'favorites', 'shares']);
                break;
            default:
                $result = Article::get(['id', 'title', 'hash', 'date', 'views', 'favorites', 'shares']);
        }
	
        $n = 0;
        foreach ($result as $value) {
            $tags = DB::table('article_tags')->where('hash', $value['hash'])->get(['keyword']);
            $tags = implode(",", array_pluck($tags, 'keyword'));
            $result[$n]['tags'] = $tags;
            $n++;
        }
        return response()->json($result);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request)
    {
        $hash = $request->input('hash');
        $result = Article::where('hash', $hash)->get(['url','views','favorites','shares']);
        return response()->json($result);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function header(Request $request)
    {
        $hash = $request->input('hash'); 
        $result = Article::where('hash', $hash)->get(['title', 'date', 'hash']);
        $n = 0;
        foreach ($result as $value) {
            $tags = DB::table('article_tags')->where('hash', $value['hash'])->get(['keyword']);
            $tags = implode(",", array_pluck($tags, 'keyword'));
            $result[$n]['tags'] = $tags;
            $n++;
        }
        return response()->json($result);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        $date = $request->input('date');
        $hash = $request->input('hash');
        $result = file_get_contents(dirname(__FILE__).'/../../../public/storage/'.$date.'/'.$hash.'.html', true);
        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $user = $request->input('email');
        $provisional_id = $request->input('provisional_id');
        $hash = $request->input('hash');
        if (empty($user)) {
          $key = $provisional_id.'+'.$hash;
        } else {
          $key = $user.'+'.$hash;
        }
        if (empty(Cache::get($key))) {
            Cache::put($key, 1, 4320);
            DB::table('articles')
                ->where('hash', $hash)
                ->increment('views');            
        }
        return response('', 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter()
    {
        $result = DB::table('article_tags')->groupBy('keyword')->get(['id', 'keyword', 'hash']);
        return response()->json($result);
    }
}
