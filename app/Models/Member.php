<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Drivers\Time;

class Member extends Model{
    protected $primary = 'id';
    protected $table = 'members';
    protected $fillable = [ 'project_id', 'user_id', 'permission' ];

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    const DEVELOPER = 1;
    const SCRUM_MASTER = 2;
    const PRODUCT_OWNER = 3;
    const MANAGER = 4;
    const OWNER = 5;

    public function getPermissionStrAttribute(){
        return __('general.permissions.' . $this->permission);
    }

    public function getCreatedAtStrAttribute(){
        $passed = time() - strtotime($this->created_at);
        $passed = intval($passed / (24 * 3600));
        if($passed > 0)
            return Time::jdate('Y/m/d', strtotime($this->created_at)) . " ($passed روز گذشته)";
        else
            return Time::jdate('Y/m/d', strtotime($this->created_at));
    }
}
