<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Check User Existence.
     *
     * @return \Illuminate\Http\Response
     */
    public function oauth(Request $request)
    {
        $email = $request->input('email');
        $users = User::where('email', $email)->first();

        if (count($users) == 0) {
            User::insert([
                'email' => $email, 
                'created_at' => date("Y-m-d H:i:s")
            ]);
            return response('', 201);
        } else {
            return response('', 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        $email = $request->input('email');
        $users = User::where('email', $email)->first();

        return response()->json($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $email = $request->input('email');
        $column = $request->input('key');
        $value = $request->input('value');
        DB::table('users')->where('email', $email)->update([$column => $value]);
        return response('', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
