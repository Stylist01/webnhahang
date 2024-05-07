<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Ingredient;
use App\Model\Dish;
use App\Model\Recipe;
use App\Model\Position;
use App\Model\Blog;
use App\Permission;
use App\Model\Policy;
use App\Model\Post;
use App\Model\Personnel;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the category for the blog User.
     * 
     * @return Relationships
     */
    public function category()
    {
        return $this->hasMany(Category::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function company()
    {
        return $this->hasMany(Company::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function table()
    {
        return $this->hasMany(Table::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function ingredient()
    {
        return $this->hasMany(Ingredient::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function dish()
    {
        return $this->hasMany(Dish::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function recipe()
    {
        return $this->hasMany(Recipe::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function position()
    {
        return $this->hasMany(Position::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function blog()
    {
        return $this->hasMany(Blog::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function policy()
    {
        return $this->hasMany(Policy::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function post()
    {
        return $this->hasMany(Post::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function personnel()
    {
        return $this->hasMany(Personnel::class, 'id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function bill()
    {
        return $this->hasMany(Bill::class, 'id');
    }

    /**
     * Hàm lấy danh sách tất cả các vai trò (giống như nhóm tài khoản)
     */
    public function role(){
        return $this->belongsTo(Role::class, 'role_id','id');
    }

    // hàm kiểm tra user hiện tại có được gán 1 quyền nào đó hay không,
    // nếu có thì trả về true
    public function hasPermission(Permission $permission){
//        echo $permission->name;

        $check = !!optional(optional($this->role)->permission)->contains($permission);
//        var_dump($check);
//        die();
        return $check;
    }
}

