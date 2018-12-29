@extends('layouts.app')
@section('title', 'پروژه جدید')
@section('content')
<div class="row">
    @foreach($errors->all() as $error)
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
            خطا! {{$error}}
            </div>
        </div>
    @endforeach
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                پروژه جدید
            </div>
            <div class="card-body">
                <form action="{{route('projects.store')}}" method="POST" class="text-center p-5">
                    @csrf
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <label>عنوان:</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{old('title', '')}}" placeholder="آشپزخانه فودی">
                        </div>
                    </div>
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <div class="form-group">
                                <label for="description">توضیحات پروژه:</label>
                                <textarea class="form-control rounded-0" id="description" name="description" rows="3">{{old('description', '')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <label>سطح پروژه:</label>
                            <select class="browser-default custom-select" name="level_id">
                                @foreach($project_templates as $template)
                                    <option value="{{$template->id}}" {{old('template_id', 0) == $template->id? 'selected': ''}}>{{$template->title}} - حداکثر {{$template->members_limit}} نفر ({{$template->price}} تومان)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>نوع پروژه:</label>
                            <select class="browser-default custom-select" name="visibility">
                                <option value="1" {{old('visibility', 0) == 1? 'selected': ''}}>خصوصی: قابل دسترس فقط برای اعضا</option>
                                <option value="2" {{old('visibility', 0) == 2? 'selected': ''}}>عمومی: قابل نمایش برای همه</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-info my-4" type="submit">ثبت پروژه</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection