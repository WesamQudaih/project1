<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * User extends Auth/User {}
 * Auth/User extends Model
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Appended Model Attribute
    public function fullMobile(): Attribute
    {
        return new Attribute(get: fn () => $this->mobile != "" ? "+00" . $this->mobile : "No Mobile");
    }

    /**
     * => Tables (User => Category)
     * Relations:
     * 1- One-To-One => hasOne(Category)
     * 2- One-To-Many => hasMany(Category)
     * 3- Many-To-Many => ?
     * 
     * Inverse of relation:
     * 1- One-To-One => hasOne(Category)
     */

    /**
     * Define Relations in Elouqent:
     * 1- Create new function
     * 2- New function name should be related to the relation type
     *      - Example:
     *          -hasMany - Plural - categories
     *          -hasOne -  Singular - category
     *          -belongsTo -  Singular - category
     */

    /// 1 => * : hasMany
    public function categories()
    {
        return $this->hasMany(Category::class, 'user_id', 'id');
    }
}
