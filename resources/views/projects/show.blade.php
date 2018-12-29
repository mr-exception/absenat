@extends('layouts.app')
@section('title', $project->title)
@section('content')
@php
    use App\Models\Member;
    use App\Models\Project;
@endphp
<div class="row">
    @if(session('cant_remove_self', false))
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                شما نمی توانید دسترسی خود را از پروژه حذف کنید. شما صاحب پروژه هستید.
            </div>
        </div>
    @endif
    @if(session('cant_change_self', false))
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                شما نمی توانید دسترسی خود از پروژه را عوض کنید. شما صاحب پروژه هستید.
            </div>
        </div>
    @endif
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
                <div class="row">
                    <div class="col-md-12" style="text-align: left;">
                        <a class="btn btn-info" href="{{route('projects.edit', ['project' => $project])}}">ویرایش</a>
                        @if($project->status == Project::OPEN)
                            <a class="btn btn-default" data-toggle="modal" data-target="#closeProject">خاتمه</a>
                            <div class="modal fade" id="closeProject" tabindex="-1" role="dialog" aria-labelledby="closeProjectLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="closeProjectLabel">خاتمه پروژه</h5>
                                        </div>
                                        <div class="modal-body">
                                            با خاتمه پروژه دیگه نمی توان فاز جدیدی به آن اضافه کرد. اعضای پروژه نمی تواننید وظایف خود را ثبت کنند. با خاتمه پروژه در آینده می توانید دوباره آنرا به آغاز کرده و به حالت قبلی برگردانید. آیا مطمئن هستید که می خواهید پروژه را خاتمه دهید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                            <a class="btn btn-primary" href="{{route('projects.close', ['project' => $project])}}">بله!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($project->status == Project::CLOSED)
                            <a class="btn btn-default" data-toggle="modal" data-target="#openProject">شروع دوباره</a>
                            <div class="modal fade" id="openProject" tabindex="-1" role="dialog" aria-labelledby="openProjectLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="openProjectLabel">شروع پروژه</h5>
                                        </div>
                                        <div class="modal-body">
                                            با شروع پروژه دوباره می توانید فازهای جدید و اسپرینت های دیگر به آن اضافه کنید. اعضای پروژه می توانند وظایف خود را در آن ثبت کنند. آیا مطمئن هستید که می خواهید پروژه را دوباره شروع کنید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                            <a class="btn btn-primary" href="{{route('projects.open', ['project' => $project])}}">بله!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <a class="btn btn-danger" data-toggle="modal" data-target="#destroyProject">حذف</a>
                        <div class="modal fade" id="destroyProject" tabindex="-1" role="dialog" aria-labelledby="destroyProjectLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title" id="destroyProjectLabel">حذف پروژه</h5>
                                    </div>
                                    <div class="modal-body">
                                        با حذف پروژه تمام اطلاعات آن حذف می شوند. دیگر نمی توان اطلاعات پروژه را نیز برگرداند. آیا مطمئن هستید که می خواهید پروژه را حذف کنید؟
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                        <a class="btn btn-primary" href="{{route('projects.destroy', ['project' => $project])}}">بله!</a>
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
                                                        <td>
                                                            <form action="{{route('projects.permission.change', ['member' => $member])}}" id="permission-change-{{$member->id}}">
                                                                <select class="browser-default custom-select" name="permission" style="margin-top: -0.3rem">
                                                                    @foreach(__('general.permissions') as $code=>$label)
                                                                        <option value="{{$code}}" {{$code == $member->permission? 'selected': ''}}>{{$label}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </form>
                                                            <script>
                                                                $(document).ready(function(){
                                                                    $('#permission-change-{{$member->id}}').change(function(){
                                                                        $('#permission-change-{{$member->id}}').submit();
                                                                    });
                                                                });
                                                            </script>
                                                        </td>
                                                        <td>{{$member->created_at_str}}</td>
                                                        <td>
                                                            <a href="{{route('projects.permission.remove', ['member' => $member])}}"><span class="badge badge-danger">حذف</span></a>
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
                                                            <a href="{{route('projects.permission.remove')}}"><span class="badge badge-danger">حذف</span></a>
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