<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTemplate extends Model{
    protected $primary = 'id';
    protected $table = 'project_templates';
    protected $fillable = [ 'title', 'members_limit', 'epics_limit', 'sprints_limit', 'price' ];
}
