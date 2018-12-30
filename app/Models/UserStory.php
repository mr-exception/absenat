<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStory extends Model{
    protected $primary = 'id';
    protected $table = 'user_stories';
    protected $fillable = [ 'title', 'description', 'sprint_id', 'points', 'poritory' ];

    public function tasks(){
        return $this->hasMany('App\Models\Task', 'user_story_id');
    }
    public function tasks_count(){
        return $this->tasks()->count();
    }
}
