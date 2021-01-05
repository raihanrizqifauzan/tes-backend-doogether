<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Session extends Model
{
    protected $table = "session";
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    protected $primaryKey = "ID";

    protected $fillable = [
        'userID', 'name', 'description', 'start', 'duration',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'userID', 'ID');
    }
}
