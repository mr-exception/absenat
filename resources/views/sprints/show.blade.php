@extends('layouts.app')
@section('title', $sprint->title)
@section('content')
@php
    use App\Models\Epic;
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{$sprint->title}} - <a href="{{route('epics.show', ['epic' => $sprint->epic])}}">{{$sprint->epic->title}}</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        {{$sprint->description}} ({{$sprint->time_period}})
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: left;">
                        <a class="btn btn-info" href="{{route('sprints.edit', ['sprint' => $sprint])}}">ویرایش</a>
                        @if($sprint->status == Epic::PENDING || $sprint->status == Epic::FINISHED)
                            @if($sprint->status == Epic::PENDING)
                                <a class="btn btn-default" data-toggle="modal" data-target="#startEpic">شروع</a>
                            @endif
                            @if($sprint->status == Epic::FINISHED)
                                <a class="btn btn-default" data-toggle="modal" data-target="#startEpic">شروع دوباره</a>
                            @endif
                            <div class="modal fade" id="startEpic" tabindex="-1" role="dialog" aria-labelledby="startEpicLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="startEpicLabel">شروع اسپرینت</h5>
                                        </div>
                                        <div class="modal-body">
                                            با شروع اسپرینت کاربران می توانند وظایف خود را در آن ثبت کنند. آیا از شروع اسپرینت مطمئن هستید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                            <a class="btn btn-primary" href="{{route('sprints.start', ['sprint' => $sprint])}}">بله!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($sprint->status == Epic::INPROGRESS)
                            <a class="btn btn-default" data-toggle="modal" data-target="#finishEpic">پایان اسپرینت</a>
                            <div class="modal fade" id="finishEpic" tabindex="-1" role="dialog" aria-labelledby="finishEpicLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="finishEpicLabel">پایان اسپرینت</h5>
                                        </div>
                                        <div class="modal-body">
                                            با پایان یافتن اسپرینت دیگر نمی توان مسئله و تسکی به آن افزود و تمام عملیات در آن متوقف می شود. البته شما می توانید در آینده دوباره اسپرینت را از نو شروع کنید. آیا از پایان دادن این اسپرینت مطمئن هستید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                            <a class="btn btn-primary" href="{{route('sprints.finish', ['sprint' => $sprint])}}">بله!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <a class="btn btn-danger" data-toggle="modal" data-target="#destroySprint">حذف</a>
                        <div class="modal fade" id="destroySprint" tabindex="-1" role="dialog" aria-labelledby="destroySprintLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title" id="destroySprintLabel">حذف اسپرینت</h5>
                                    </div>
                                    <div class="modal-body">
                                        با حذف اسپرینت از پروژه، تمام اطلاعات آن نیز حذف می شود و دیگر نمی توان آنها را بازیابی کرد. آیا از حذف این اسپرینت مطمئن هستید؟
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                        <a class="btn btn-primary" href="{{route('sprints.destroy', ['sprint' => $sprint])}}">بله!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-primary" href="{{route('sprints.create', ['sprint' => $sprint])}}">مسئله جدید (user story)</a>
                            </div>
                        </div>
                        @if(sizeof($sprint->user_stories)>0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">عنوان</th>
                                        <th scope="col">تعداد تسک ها</th>
                                        <th scope="col">درجه سختی</th>
                                        <th scope="col">اولویت</th>
                                        <th scope="col">وضعیت</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sprint->user_stories as $index=>$user_story)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td>{{$user_story->title}}</td>
                                                <td>{{$user_story->tasks_count}}</td>
                                                <td>{{$user_story->points}}</td>
                                                <td>{{$user_story->poritory}}</td>
                                                <td>{{$user_story->status_str}}</td>
                                                <td>-</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row"><div class="col" style="text-align: center;">هیچ مسئله ای در این فاز وجود ندارد</div></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection