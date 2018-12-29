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
                @if(session('edit_was_successfull', false))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">
                                ویرایش پروژه با موفقیت انجام شد!
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($errors->all() as $error)
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-danger" role="alert">
                            خطا! {{$error}}
                            </div>
                        </div>
                    </div>
                @endforeach
                <form action="{{route('projects.update', ['project' => $project])}}" method="POST" class="text-center p-5">
                    @csrf
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <label>عنوان:</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{old('title', $project->title)}}" placeholder="آشپزخانه فودی">
                        </div>
                    </div>
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <div class="form-group">
                                <label for="description">توضیحات پروژه</label>
                                <textarea class="form-control rounded-0" id="description" name="description" rows="3">{{old('description', $project->description)}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <label>نوع پروژه:</label>
                            <select class="browser-default custom-select" name="visibility">
                                <option value="1" {{old('visibility', $project->visibility) == 1? 'selected': '' }}>خصوصی: قابل دسترس فقط برای اعضا</option>
                                <option value="2" {{old('visibility', $project->visibility) == 2? 'selected': '' }}>عمومی: قابل نمایش برای همه</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-info my-4" type="submit">ذخیره تغییرات</button>
                    <a class="btn btn-primary" href="{{route('projects.show', ['project' => $project])}}">صفحه پروژه</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection