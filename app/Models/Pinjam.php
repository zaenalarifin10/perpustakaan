<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;
    protected $table = 'pinjam';
    protected $primaryKey = 'id';
    protected $fillable = ['id_book','id_user','name','telepon','judul_buku','sisa_buku','dipinjam','stok','status'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function book()
    {
        return $this->belongsTo(Books::class, 'id_book');
    }
    
}
