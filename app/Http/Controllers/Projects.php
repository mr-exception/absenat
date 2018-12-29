<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\ProjectTemplate;
use App\Models\Project;
use App\Models\Member;

use App\Http\Requests\Projects\Create as CreateProjectRequest;
use App\Http\Requests\Projects\Edit as EditProjectRequest;

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

    public function edit(Request $request, Project $project){
        return view('projects.edit', [
            'project'   => $project
        ]);
    }
    public function update(EditProjectRequest $request, Project $project){
        $project->fill($request->only([
            'title',
            'description',
            'visibility',
            'status',
        ]))->save();
        return redirect()->route('projects.edit', ['project' => $project])->with(['edit_was_successfull' => true]);
    }

    public function destroy(Request $request, Project $project){
        $project->delete();
        return redirect()->route('home');
    }

    public function close(Request $request, Project $project){
        $project->status = Project::CLOSED;
        $project->save();
        return redirect()->back();
    }

    public function open(Request $request, Project $project){
        $project->status = Project::OPEN;
        $project->save();
        return redirect()->back();
    }

    public function removeMember(Request $request, Member $member){
        $project = $member->project;
        if(Auth::user()->id == $member->user_id && $member->permission == Member::OWNER)
            return redirect()->route('projects.show', ['project' => $project])->with(['cant_remove_self' => true]);
        $member->delete();
        return redirect()->route('projects.show', ['project' => $project]);
    }

    public function changeMemberPermission(Request $request, Member $member){
        $permission = $request->permission;
        if(Auth::user()->id == $member->user_id && $member->permission == Member::OWNER)
            return redirect()->route('projects.show', ['project' => $member->project])->with(['cant_change_self' => true]);
        $member->permission = $permission;
        return redirect()->route('projects.show', ['project' => $member->project]);
    }
}
