<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use App\User;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * グループ一覧取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->input('category');
        $result = Group::where('category', $category)->get(['id', 'name']);
        return response()->json($result);
    }

    /**
     * グループ所属者取得
     *
     * @return \Illuminate\Http\Response
     */
    public function staff(Request $request)
    {
        $result = [];
        $category = $request->input('category');
        $id = $request->input('id');
        $group_result = Group::where('id', $id)->get(['id', 'name']);
        $user_result = User::where("".$category."_id", $id)->get(['email', 'first_name', 'last_name']);
        foreach ($group_result as $group) {
            $group_result = array_add(['id' => $group['id']], 'name', $group['name']."の全メンバー");
            array_push($result, $group_result);
        }
        foreach ($user_result as $user) {
            if (empty($user['last_name'])) {
              $last_name = "";
            } else {
              $last_name = $user['last_name'];
            }
            if (empty($user['first_name'])) {
              $first_name = "";
            } else {
              $first_name = $user['first_name'];
            }
            if (empty($user['last_name']) && empty($user['first_name'])) {
              $last_name = $user['email'];
            }
            array_push($result, ['id' => $user['email'], 'name' => $last_name.' '.$first_name]);
        }
        return response()->json($result);
    }

}
