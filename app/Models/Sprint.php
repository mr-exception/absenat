<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model{
    protected $primary = 'id';
    protected $table = 'sprints';
    protected $fillable = [ 'title', 'description', 'start_date', 'finish_date', 'epic_id', 'status' ];

    public function epic(){
        return $this->belongsTo('App\Models\Epic');
    }

    
    const PENDING       = 1;
    const INPROGRESS    = 2;
    const FINISHED      = 3;
    public function getStatusStrAttribute(){
        return __('geneneral.epics.status_str.' . $this->status);
    }
}
