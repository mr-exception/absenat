<?php

use Illuminate\Database\Seeder;

use App\Models\ProjectTemplate;

class ProjectTemplates extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        ProjectTemplate::create([
            'title'         => 'golden',
            'members_limit' => 4,
            'epics_limit'   => 0,
            'sprints_limit' => 0,
            'price'         => 0,
        ]);
        ProjectTemplate::create([
            'title'         => 'golden',
            'members_limit' => 10,
            'epics_limit'   => 0,
            'sprints_limit' => 0,
            'price'         => 0,
        ]);
        ProjectTemplate::create([
            'title'         => 'golden',
            'members_limit' => 25,
            'epics_limit'   => 0,
            'sprints_limit' => 0,
            'price'         => 0,
        ]);
    }
}
