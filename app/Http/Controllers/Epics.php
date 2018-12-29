<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Drivers\Time;

use App\Models\Epic;
use App\Models\Project;

use App\Http\Requests\Epics\Create as CreateEpicRequest;
use App\Http\Requests\Epics\Edit as EditEpicRequest;

class Epics extends Controller{
    public function create(Request $request, Project $project){
        return view('epics.create', [
            'project'   => $project,
        ]);
    }
    public function store(CreateEpicRequest $request){

        $epic = new Epic;
        $epic->fill($request->only(['title', 'description', 'project_id']));
        $epic->start_date = Time::jmktime(0, 0, 0, $request->start_date_day, $request->start_date_month, $request->start_date_year);
        $epic->finish_date = Time::jmktime(0, 0, 0, $request->finish_date_day, $request->finish_date_month, $request->finish_date_year);

        $epic->save();
        return redirect()->route('epics.show', ['epic' => $epic]);
    }

    public function show(Request $request, Epic $epic){
        return view('epics.show', [
            'epic'  => $epic,
        ]);
    }

    public function destroy(Request $request, Epic $epic){
        $project = $epic->project;
        $epic->delete();
        return redirect()->route('projects.show', ['project' => $project]);
    }

    public function edit(Request $request, Epic $epic){
        return view('epics.edit', [
            'epic'  => $epic,
        ]);
    }
    public function update(EditEpicRequest $request, Epic $epic){
        $epic->fill($request->only(['title', 'description', 'project_id']));
        $epic->start_date = Time::jmktime(0, 0, 0, $request->start_date_day, $request->start_date_month, $request->start_date_year);
        $epic->finish_date = Time::jmktime(0, 0, 0, $request->finish_date_day, $request->finish_date_month, $request->finish_date_year);

        $epic->save();
        return redirect()->route('epics.edit', ['epic' => $epic])->with(['successfull_edit' => true]);
    }
    public function start(Request $request, Epic $epic){
        $epic->status = Epic::INPROGRESS;
        $epic->save();
        return redirect()->back();
    }
    public function finish(Request $request, Epic $epic){
        $epic->status = Epic::FINISHED;
        $epic->save();
        return redirect()->back();
    }
    
}