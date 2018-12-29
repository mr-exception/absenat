<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\ProjectTemplate;
use App\Models\Project;
use App\Models\Member;

use App\Http\Requests\Projects\Create as CreateProjectRequest;

class Projects extends Controller{
    public function create(Request $request){
        return view('projects.create',[
            'project_templates' => ProjectTemplate::all(),
        ]);
    }

    public function store(CreateProjectRequest $request){
        $project = new Project;
        $project->owner_id = Auth::user()->id;
        $project->fill($request->only([
            'title', 'description',
            'level_id', 'visibility',
        ]));
        $project->save();
        Member::create([
            'user_id'       => Auth::user()->id,
            'project_id'    => $project->id,
            'permission'    => Member::OWNER,
        ]);
        return redirect()->route('projects.show', ['project' => $project]);
    }

    public function show(Request $request, Project $project){
        return view('projects.show', [
            'project'   => $project
        ]);
    }
}
