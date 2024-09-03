<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
protected $fillable=[
'title',
'author',
'description',
'published_at',
'is_borrowed',
'average_rating',
'category_id', 
'is_available'
];
public function borrow():HasMany
{

    return $this->hasMany(Borrow_records::class);
}
public function category()
{
    return $this->belongsTo(Category::class);
}
}
