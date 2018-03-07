<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use DB;
use Exception;

class FavoriteController extends Controller
{
	/**
	 * Insert a favorite article
	 *
	 * @return post or get response
	 */
	public function insert(Request $request)
	{
		// Get parameter
		$email = $request->input('email');
		$hash = $request->input('hash');
		if($email == '' || $hash == '')
		{
			// Bad request
			return response('', 400);
		}
		// DB Insert
		try {
			DB::transaction(function() use($email, $hash)
			{
				// check
				$favorite_id = DB::table('user_favorites')
					->select('id')
					->where('from_user', $email)
					->where('hash', $hash)
					->exists();
				if( ! $favorite_id)
				{
					// Bad request
					throw new Exception('User not found.');
				}
				DB::table('user_favorites')
					->insert([
						'from_user' => $email,
						'hash'      => $hash,
						'date'      => Carbon::now()
					]);
				$hash_count = DB::table('articles')
					->where('hash', $hash)
					->count();
				DB::table('article')
					->where('hash', $hash)
					->update(['updated_at' => Carbon::now()])
					->increment('favorites');
			});
			// success
			return response('', 201);
		} catch (Exception $e) {
			// DB error
			return response('', 500);
		}
	}

	/**
	 * Select a favorite article
	 *
	 * @return post or get response
	 */
	public function select(Request $request)
	{
		// Get parameter
		$email = $request->input('email');
		$hash = $request->input('hash');
		if($email == '' || $hash == '')
		{
			// Bad request
			return response('', 400);
		}
		$favorite_id = 0;
		// DB Insert
		try {
			DB::transaction(function() use($email, $hash)
			{
				$favorite_id = DB::table('user_favorites')
					->select('id')
					->where('from_user', $email)
					->where('hash', $hash);
			});
		} catch (Exception $e) {
			// DB error
			return response('', 500);
		}
		// success
		if($favorite_id > 0)
		{
			return response()->json(['favorites' => 'true']);
		}
		else
		{
			return response()->json(['favorites' => 'false']);
		}
	}

}
