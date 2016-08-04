<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookInformation extends Model {

    public $timestamps = false;

    protected $fillable = ['expires_at', 'user_id', 'token'];

    

}
