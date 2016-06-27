<?php 

namespace EliteTelecom\Watchtower\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Db\User;
use EliteTelecom\Watchtower\Models\Permission;

class Role extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'special'];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Db\User');
    }
    
    /**
     * The users that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany('EliteTelecom\Watchtower\Models\Permission');
    }
    
}
