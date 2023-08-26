<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'gambar',
        'namamakanan',
        'khasdaerah'
    ];
    
    public function tutorials()
    {
    return $this->hasMany(Tutorial::class);
    }
}
