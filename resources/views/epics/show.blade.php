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
                        {{$epic->description}}
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
                                        <th scope="col">تعداد تسک ها</th>
                                        <th scope="col">بازه زمانی</th>
                                        <th scope="col">پروسه تکمیل</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($epic->sprints as $index=>$sprint)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td>{{$member->user->username}}</td>
                                                <td>{{$member->user->email}}</td>
                                                <td>
                                                    @if($epic->owner_id == $member->user_id)
                                                        {{$member->permission_str}}
                                                    @else
                                                        <form action="{{route('members.change', ['member' => $member])}}" id="permission-change-{{$member->id}}">
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
                                                    @endif
                                                </td>
                                                <td>{{$member->created_at_str}}</td>
                                                <td>
                                                    @if($project->owner_id != $member->user_id)
                                                        <a data-toggle="modal" data-target="#destroyMember"><span class="badge badge-danger">حذف</span></a>
                                                        <div class="modal fade" id="destroyMember" tabindex="-1" role="dialog" aria-labelledby="destroyMemberLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h5 class="modal-title" id="destroyMemberLabel">حذف عضو از پروژه</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        با حذف عضوی از پروژه، دسترسی او به اطلاعات پروژه از بین می رود. اما تمام تسک ها و اطلاعات او در پروژه باقی می ماند. با افزوده شدن دوباره او به پروژه می تواند کار خود را ادامه دهد. آیا از حذف {{$member->user->username}} از پروژه اطمینان دارید؟
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر! منصرف شدم</button>
                                                                        <a class="btn btn-primary" href="{{route('members.destroy', ['member' => $member])}}">بله!</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
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