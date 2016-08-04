<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
		'created_at',
		'created_user_id',
		'is_updated',
		'updated_at',
		'updated_user_id',
		'is_deleted',
		'deleted_at',
		'deleted_at',
		'deleted_user_id',
		'ref_user_type_id',
//		'facebook_information_id',
		'ip_address',
		'device_id'
	];

	public static function all($columns = array('*')) {
		return parent::with('refUserType', 'facebookInformation')->get();
	}

	/**
	 * Get the refUserType record associated with the Secret.
	 */
	public function refUserType()
	{
		return $this->hasOne('App\RefUserType', 'id', 'ref_user_type_id');
	}

	/**
	 * Get the facebookInformation record associated with the Secret.
	 */
	public function facebookInformation()
	{
		return $this->hasOne('App\FacebookInformation', 'id', 'facebook_information_id');
	}




}
