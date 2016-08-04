<?php namespace App;
use App\RefUniversity;
use Illuminate\Database\Eloquent\Model;

class Secret extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'secrets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'ref_university_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'is_updated',
        'updated_at',
        'updated_user_id',
        'is_deleted',
        'deleted_at',
        'deleted_at',
        'deleted_user_id',
        'ref_university_id'
    ];

    public static function all($columns = array('*')) {
        return parent::with('university')->get();
    }

    /**
     * Get the university record associated with the Secret.
     */
    public function university()
    {
        return $this->hasOne('App\RefUniversity', 'id', 'ref_university_id');
    }

}
