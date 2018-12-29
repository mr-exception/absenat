<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Epic extends Model{
    protected $primary = 'id';
    protected $table = 'epics';
    protected $fillable = [ 'title', 'description', 'project_id', 'start_date', 'finish_date', 'status' ];

    public function project(){
        return $this->belongsTo('App\Models\Project', 'project_id');
    }
}
