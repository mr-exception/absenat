@extends('layouts.app')
@section('title', $project->title)
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{$project->title}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        {{$project->description}}
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
                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="direction: ltr;">
                            <li class="nav-item">
                                <a class="nav-link active" id="members-tab" data-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="true">اعضا</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="epics-tab" data-toggle="tab" href="#epics" role="tab" aria-controls="epics" aria-selected="false">فازها (epics)</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="members" role="tabpanel" aria-labelledby="members-tab">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary" href="#new-member">عضو جدید</a>
                                    </div>
                                </div>
                                @if(sizeof($project->members)>0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">نام‌کاربری</th>
                                                <th scope="col">ایمیل</th>
                                                <th scope="col">گروه کاربری</th>
                                                <th scope="col">تاریخ عضویت</th>
                                                <th scope="col">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($project->members_pivot as $index=>$member)
                                                    <tr>
                                                        <th scope="row">{{$index+1}}</th>
                                                        <td>{{$member->user->username}}</td>
                                                        <td>{{$member->user->email}}</td>
                                                        <td>{{$member->permission_str}}</td>
                                                        <td>{{$member->created_at_str}}</td>
                                                        <td>
                                                            <a href="#remove"><span class="badge badge-danger">حذف</span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="row"><div class="col" style="text-align: center;">هیچ عضوی در این پروژه وجود ندارد</div></div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="epics" role="tabpanel" aria-labelledby="epics-tab">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary" href="#new-epic">فاز جدید</a>
                                    </div>
                                </div>
                                @if(sizeof($project->epics)>0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">عنوان</th>
                                                <th scope="col">شروع</th>
                                                <th scope="col">پایان</th>
                                                <th scope="col">تعداد اسپرینت‌ها</th>
                                                <th scope="col">درصد عملیاتی شده</th>
                                                <th scope="col">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($project->epics as $index=>$epic)
                                                    <tr>
                                                        <th scope="row">{{$index+1}}</th>
                                                        <td>{{$epic->title}}</td>
                                                        <td>{{$epic->title}}</td>
                                                        <td>{{$epic->title}}</td>
                                                        <td>{{$epic->title}}</td>
                                                        <td>{{$epic->title}}</td>
                                                        <td>{{$epic->title}}</td>
                                                        <td>
                                                            <a href="#remove"><span class="badge badge-danger">حذف</span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="row"><div class="col" style="text-align: center;">هیچ فازی در این پروژه وجود ندارد</div></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection