<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $table = 'book';

    protected $primaryKey = 'id';

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pinjam(){
        return $this->hasMany(Pinjam::class);
    }

}
