@extends('layouts.app')
@section('title', 'خانه')

@section('content')
<div class="row" style="text-align: left;">
    <div class="col-md-12">
        <a class="btn btn-primary" style="margin-left: 0px;" href="{{route('projects.create')}}">پروژه جدید</a>
    </div>
</div>
@if(sizeof(Auth::user()->projects) >0)
    @foreach(Auth::user()->projects as $project)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{$project->title}} ({{$project->members_count}})
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {{$project->description}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: left;">
                                <a class="btn btn-primary" href="{{route('projects.show', ['project' => $project])}}">ورود به پروژه</a>
                                <a class="btn btn-info" href="{{route('projects.edit', ['project' => $project])}}">ویرایش</a>
                                <a class="btn btn-default" href="{{route('projects.close', ['project' => $project])}}">خاتمه</a>
                                <a class="btn btn-danger" href="{{route('projects.destroy', ['project' => $project])}}">حذف</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    شما هیچ پروژه ای ندارید. می تونید همین الان شروع کنید و پروژه‌ه اولتون رو بسازید
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
