<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Sprint;
use App\Models\Epic;

use App\Http\Requests\Sprints\Create as CreateSprintRequest;
use App\Http\Requests\Sprints\Edit as EditSprintRequest;

use App\Drivers\Time;

class Sprints extends Controller{
    public function create(Request $reqest, Epic $epic){
        return view('sprints.create', [
            'epic'  => $epic,
        ]);
    }
    public function store(CreateSprintRequest $request){

        $sprint = new Sprint;
        $sprint->fill($request->only(['title', 'description', 'epic_id']));
        $sprint->start_date = Time::jmktime(0, 0, 0, $request->start_date_day, $request->start_date_month, $request->start_date_year);
        $sprint->finish_date = Time::jmktime(0, 0, 0, $request->finish_date_day, $request->finish_date_month, $request->finish_date_year);

        $sprint->save();
        return redirect()->route('sprints.show', ['sprint' => $sprint]);
    }

    public function show(Request $request, Sprint $sprint){
        return view('sprints.show', [
            'sprint'  => $sprint,
        ]);
    }

    public function destroy(Request $request, Sprint $sprint){
        $epic = $sprint->epic;
        $sprint->delete();
        return redirect()->route('epics.show', ['epic' => $epic]);
    }

    public function edit(Request $request, Sprint $sprint){
        return view('sprints.edit', [
            'sprint'  => $sprint,
        ]);
    }
    public function update(EditSprintRequest $request, Sprint $sprint){
        $sprint->fill($request->only(['title', 'description', 'epic_id']));
        $sprint->start_date = Time::jmktime(0, 0, 0, $request->start_date_day, $request->start_date_month, $request->start_date_year);
        $sprint->finish_date = Time::jmktime(0, 0, 0, $request->finish_date_day, $request->finish_date_month, $request->finish_date_year);

        $sprint->save();
        return redirect()->route('sprints.edit', ['sprint' => $sprint])->with(['successfull_edit' => true]);
    }
    public function start(Request $request, Sprint $sprint){
        $sprint->status = Sprint::INPROGRESS;
        $sprint->save();
        return redirect()->back();
    }
    public function finish(Request $request, Sprint $sprint){
        $sprint->status = Sprint::FINISHED;
        $sprint->save();
        return redirect()->back();
    }
}
