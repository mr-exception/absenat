<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Drivers\Time;


class Epic extends Model{
    protected $primary = 'id';
    protected $table = 'epics';
    protected $fillable = [ 'title', 'description', 'project_id', 'start_date', 'finish_date', 'status' ];

    const PENDING       = 1;
    const INPROGRESS    = 2;
    const FINISHED      = 3;
    public function getStatusStrAttribute(){
        return __('geneneral.epics.status_str.' . $this->status);
    }
    public function project(){
        return $this->belongsTo('App\Models\Project', 'project_id');
    }
    public function sprints(){
        return $this->hasMany('App\Models\Sprint', 'epic_id');
    }
    public function getSprintsCountAttribute(){
        return $this->sprints()->count();
    }
    public function getProgressPercentageAttribute(){
        return 20;
    }
    public function getStartDateStrAttribute(){
        return Time::jdate('Y/m/d', $this->start_date);
    }
    public function getFinishDateStrAttribute(){
        return Time::jdate('Y/m/d', $this->finish_date);
    }
    public function getTimePeriodAttribute(){
        return $this->start_date_str . ' - ' . $this->finish_date_str;
    }

    public function getStartDateDayAttribute(){
        return Time::jdate('d', $this->start_date, 'none', 'Asia/Tehran', 'en');
    }
    public function getStartDateMonthAttribute(){
        return Time::jdate('m', $this->start_date, 'none', 'Asia/Tehran', 'en');
    }
    public function getStartDateYearAttribute(){
        return Time::jdate('Y', $this->start_date, 'none', 'Asia/Tehran', 'en');
    }

    public function getFinishDateDayAttribute(){
        return Time::jdate('d', $this->finish_date, 'none', 'Asia/Tehran', 'en');
    }
    public function getFinishDateMonthAttribute(){
        return Time::jdate('m', $this->finish_date, 'none', 'Asia/Tehran', 'en');
    }
    public function getFinishDateYearAttribute(){
        return Time::jdate('Y', $this->finish_date, 'none', 'Asia/Tehran', 'en');
    }
}
