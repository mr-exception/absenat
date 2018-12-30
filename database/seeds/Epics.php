<?php

use Illuminate\Database\Seeder;

use App\Models\Sprint;
use App\Models\Epic;
use App\Models\Project;

class Epics extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $project = Project::create([
            'title' => 'project title',
            'description'   => 'project description',
            'level_id'      => 1,
            'owner_id'      => 1,
            
        ]);
        $epic = Epic::create([
            'title' => 'epic title',
            'description'   => 'epic descriptions',
            'start_date'    => 0,
            'finish_date'   => 50000,
            'project_id'    => $project->id
        ]);
        $sprint = Sprint::create([
            'title' => 'sprint title',
            'description'   => 'sprint description',
            'start_date'    => 0,
            'finish_date'   => 15000,
            'epic_id'       => $epic->id,
        ]);
    }
}
