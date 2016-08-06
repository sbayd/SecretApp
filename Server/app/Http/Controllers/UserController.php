<?php namespace App\Http\Controllers;
use App\FacebookInformation;
use Response;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function all()
	{
		$users = User::all();

		return Response::json( $users );
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function login(Request $request) {

		$user = new User;

		$user->device_id 	= $request->device_id;
		$user->ip_address 	= ip2long($request->ip());
		$user->name 		= $request->name;
		$user->is_updated	= false;
		$user->is_deleted	= false;
//		dd(long2ip (ip2long($user->ip_address)));

		if ( $request->ref_user_type_id == 1 ) { // Anonymous login

		} else if ( $request->ref_user_type_id == 2 ) { // facebook login

			$facebookInformation = new FacebookInformation([
				'expires_at' => $request->expires_at,
				'user_id' => $request->fb_user_id,
				'token' => $request->fb_token
			]);
			$facebookInformation->save();

			$user->facebook_information_id = $facebookInformation->id;
			$user->device_id = $request->device_id;

			if ( $facebookInformation->id == null ) {
				return Response::json([
					'Error' => 'Unauthorized'
				], 403);
			}
		} else {
			return Response::json([
				'Error' => 'HttpNotFound'
			], 400);
		}

		$user->save();

		return Response::json([
			'Success' => 'Successfully Logged In',
			'user_name' => $user->name,
		], 200);

	}

}
