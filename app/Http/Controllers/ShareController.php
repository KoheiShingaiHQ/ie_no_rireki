<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Http\Requests;
use Carbon\Carbon;
use DB;

class ShareController extends Controller
{
    /**
     * Check User Existence.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $today = Carbon::now()->format('Ymd');
        $email = $request->input('email');
        $hash = $request->input('hash');
        $id = $request->input('id');
        $group = $request->input('group');
        if (ctype_digit($id)) { // true: 全体
            $id = 'all';
            DB::table('user_shares')->where([['from_user','=',$email],['hash','=',$hash],['to_group','=',$group]])->delete();
        } else { // false: 個別
            DB::table('user_shares')->where([['from_user','=',$email],['hash','=',$hash],['to_user','=','all'],['to_group','=',$group]])->delete();
        }
        $record = DB::table('user_shares')->where([['from_user','=',$email],['hash','=',$hash],['to_user','=',$id],['to_group','=',$group]])->get();
        if (count($record) == 0) {
            DB::table('user_shares')->insert([
                'from_user' => $email,
                'hash' => $hash,
                'to_user' => $id,
                'to_group' => $group,
                'date' => $today
            ]);
        }
        $count = count(DB::table('user_shares')->where('hash','=',$hash)->groupBy('from_user')->get());
        Article::where('hash', $hash)->update(['shares' => $count]);
        return response('', 201);
    }

    /**
     * Check User Existence.
     *
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        $email = $request->input('email');
        $hash = $request->input('hash');
        $result = DB::table('user_shares')->where([['from_user','=',$email],['hash','=',$hash]])->get(['to_user', 'to_group']);
        $n = 0;
        foreach ($result as $value) {
            if ($result[$n]->to_user == 'all') {
                $result[$n]->to_user = $result[$n]->to_group;
            }
            $n++;
        }
        return response()->json(array_pluck($result, 'to_user'));
    }
}
