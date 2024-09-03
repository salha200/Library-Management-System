<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow_records extends Model
{
    use HasFactory;
    protected $fillable=[
'book_id',
'user_id',
'borrowed_at',
'due_date',
'returned_at'
    ];
    public function user(){

        return $this->belongsTo(User::class);
    }
    public function book(){

        return $this->belongsTo(Book::class);
    }
}