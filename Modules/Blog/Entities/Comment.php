<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment'
    ];

    protected $appends = [
        'author'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'user_id'
    ];

    public function getAuthorAttribute(){
        $record =  $this->user()->first();
        return $record->name;
    }
    public function user(){
        $record =  $this->hasOne(User::class,'id','user_id');
        return $record;
    }

}
