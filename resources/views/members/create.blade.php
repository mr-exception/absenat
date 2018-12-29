@extends('layouts.app')
@section('title', 'عضو جدید')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                عضو جدید
            </div>
            <div class="card-body">
                @foreach($errors->all() as $error)
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-danger" role="alert">
                            خطا! {{$error}}
                            </div>
                        </div>
                    </div>
                @endforeach
                <form action="{{route('members.store')}}" method="POST" class="text-center p-5">
                    @csrf
                    <input name="project_id" value="{{$project->id}}" hidden />
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <label>آدرس ایمیل:</label>
                            <input type="text" id="email" name="email" class="form-control" value="{{old('email', '')}}" placeholder="johndoe@mail.com">
                        </div>
                    </div>
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <label>گروه کاربری:</label>
                            <select class="browser-default custom-select" name="permission">
                                @foreach(__('general.permissions') as $code=>$label)
                                    <option value="{{$code}}" {{old('permission', 0) == $code? 'selected': ''}}>{{$label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-info my-4" type="submit">ثبت عضویت</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection