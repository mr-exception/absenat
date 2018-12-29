<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{
    protected $primary = 'id';
    protected $table = 'projects';
    protected $fillable = [ 'title', 'description', 'visibility', 'status', 'owner_id', 'level_id' ];

    public function level(){
        return $this->belongsTo('App\Models\ProjectTemplate');
    }
    public function hard_owner(){
        return $this->belongsTo('App\User');
    }
    public function members(){
        return $this->belongsToMany('App\User', 'members', 'project_id', 'user_id')->withPivot('permission');
    }
    public function members_pivot(){
        return $this->hasMany('App\Models\Member', 'project_id');
    }
}
