<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * => Tables (User => Category)
     * Relations:
     * 1- One-To-One => hasOne(Category)
     * 2- One-To-Many => hasMany(Category)
     * 3- Many-To-Many => ?
     * 
     * Inverse of relation:
     * 1- One-To-One => belongsTo(User)
     */

    /**
     * Define Relations in Elouqent:
     * 1- Create new function
     * 2- New function name should be related to the relation type
     *      - Example:
     *          -hasMany - Plural - categories
     *          -hasOne -  Singular - category
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
