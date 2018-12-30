@extends('layouts.app')
@section('title', $epic->title)
@section('content')
@php
    use App\Models\Epic;
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{$epic->title}} - <a href="{{route('projects.show', ['project' => $epic->project])}}">{{$epic->project->title}}</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        {{$epic->description}} ({{$epic->time_period}})
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: left;">
                        <a class="btn btn-info" href="{{route('epics.edit', ['epic' => $epic])}}">ویرایش</a>
                        @if($epic->status == Epic::PENDING || $epic->status == Epic::FINISHED)
                            @if($epic->status == Epic::PENDING)
                                <a class="btn btn-default" data-toggle="modal" data-target="#startEpic">شروع</a>
                            @endif
                            @if($epic->status == Epic::FINISHED)
                                <a class="btn btn-default" data-toggle="modal" data-target="#startEpic">شروع دوباره</a>
                            @endif
                            <div class="modal fade" id="startEpic" tabindex="-1" role="dialog" aria-labelledby="startEpicLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="startEpicLabel">شروع فاز</h5>
                                        </div>
                                        <div class="modal-body">
                                            با شروع شدن فاز می توان اسپرینت های آنرا تعریف کرد و اعضا وظایف خود را مدیریت کنند. آیا مطمئن هستید که می خواهید این فاز را شروع کنید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                            <a class="btn btn-primary" href="{{route('epics.start', ['epic' => $epic])}}">بله!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($epic->status == Epic::INPROGRESS)
                            <a class="btn btn-default" data-toggle="modal" data-target="#finishEpic">پایان فاز</a>
                            <div class="modal fade" id="finishEpic" tabindex="-1" role="dialog" aria-labelledby="finishEpicLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="finishEpicLabel">پایان فاز</h5>
                                        </div>
                                        <div class="modal-body">
                                            با پایان دادن به فاز دیگر نمی توان اسپرینتی در آن تعریف کرد. البته می توانید بعدا این فاز را دوباره شروع کنید. آیا مطمئن هستید که می خواید این فاز را خاتمه دهید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                            <a class="btn btn-primary" href="{{route('epics.finish', ['epic' => $epic])}}">بله!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <a class="btn btn-danger" data-toggle="modal" data-target="#destroyEpic">حذف</a>
                        <div class="modal fade" id="destroyEpic" tabindex="-1" role="dialog" aria-labelledby="destroyEpicLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title" id="destroyEpicLabel">حذف فاز</h5>
                                    </div>
                                    <div class="modal-body">
                                        با حذف شدن فاز دیگر به اطلاعات داخل آن دسترسی نخواهید داشت و قابل بازگردانی هم نخواهند بود. آیا از حذف این فاز مطمئن هستید؟
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                        <a class="btn btn-primary" href="{{route('epics.destroy', ['epic' => $epic])}}">بله!</a>
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
                                <a class="btn btn-primary" href="{{route('sprints.create', ['epic' => $epic])}}">اسپرینت جدید</a>
                            </div>
                        </div>
                        @if(sizeof($epic->sprints)>0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">عنوان</th>
                                        <th scope="col">تعداد مسائل (user story)</th>
                                        <th scope="col">بازه زمانی</th>
                                        <th scope="col">وضعیت</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($epic->sprints as $index=>$sprint)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td>{{$sprint->title}}</td>
                                                <td>{{$sprint->user_stories_count}}</td>
                                                <td>{{$sprint->time_period}}</td>
                                                <td>{{$sprint->status_str}}</td>
                                                <td>
                                                    <a href="{{route('sprints.show', ['sprint' => $sprint])}}"><span class="badge badge-default">مشاهده</span></a>
                                                    <a data-toggle="modal" data-target="#destroySprint"><span class="badge badge-danger">حذف</span></a>
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
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row"><div class="col" style="text-align: center;">هیچ اسپرینتی در این فاز وجود ندارد</div></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection