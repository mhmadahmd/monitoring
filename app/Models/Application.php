<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'domain',
        'ip',
        'img',
        'note',
        'category',
        'status',
    ];

    
    public function categoryR()
    {
    return $this->belongsTo('App\Models\Category', 'category');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
