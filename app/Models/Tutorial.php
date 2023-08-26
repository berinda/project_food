<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    public function menu()
    {
        return $this->belongsTo(Menu::class,'menuId');
    }
    use HasFactory;
     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'menuId',
        'tutorialmemasak',
    ];
}
