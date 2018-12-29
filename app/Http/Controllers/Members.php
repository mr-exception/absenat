<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Project;
use App\Models\Member;
use App\User;

use App\Http\Requests\Members\Create as CreateMemberRequest;

class Members extends Controller{
    public function create(Request $request, Project $project){
        return view('members.create', [
            'project'   => $project,
        ]);
    }
    public function store(CreateMemberRequest $request){
        $user = User::where('email', $request->email)->first();
        $member = Member::where('user_id', $user->id)->where('project_id', $request->project_id)->first();
        $project = Project::where('id', $request->project_id)->first();
        if($member){
            $member->permission = $request->permission;
            $member->save();
            return redirect()->route('projects.show', ['project' => $project])->with([
                'member_updated'    => true,
                'username'          => $user->username,
            ]);
        }else{
            Member::create([
                'project_id'    => $request->project_id,
                'user_id'       => $user->id,
                'permission'    => $request->permission,
            ]);
            return redirect()->route('projects.show', ['project' => $project])->with([
                'member_added'      => true,
                'username'          => $user->username,
            ]);
        }
    }
    
    public function destroy(Request $request, Member $member){
        $project = $member->project;
        if($member->user->id == $member->project->owner_id)
            return redirect()->route('projects.show', ['project' => $project])->with(['cant_remove_self' => true]);
        $member->delete();
        return redirect()->route('projects.show', ['project' => $project]);
    }

    public function change(Request $request, Member $member){
        if($member->user->id == $member->project->owner_id)
            return redirect()->route('projects.show', ['project' => $member->project])->with(['cant_change_self' => true]);
        $member->permission = $request->permission;
        $member->save();
        return redirect()->route('projects.show', ['project' => $member->project])->with([
            'member_updated'    => true,
            'username'          => $member->user->username,
        ]);
    }
}
