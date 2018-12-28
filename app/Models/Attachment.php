<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model{
    protected $primary = 'id';
    protected $table = 'attachments';
    protected $fillable = [ 'file', 'caption', 'type', 'target_id' ];

    const TASK = 1;
    const SPRINT = 2;
    const EPIC = 3;
    const PROJECT = 4;
    const COMMENT = 5;

    public function task(){
        return $this->belongsTo('App\Models\Task');
    }

    public function sprint(){
        return $this->belongsTo('App\Models\Sprint');
    }

    public function epic(){
        return $this->belongsTo('App\Models\Epic');
    }

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function comment(){
        return $this->belongsTo('App\Models\Comment');
    }
}
