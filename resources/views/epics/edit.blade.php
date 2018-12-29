@extends('layouts.app')
@section('title', $epic->title)
@section('content')
@php
    use App\Drivers\Time;
@endphp
<div class="row">
    @if(session('successfull_edit', false))
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
                ویرایش فاز با موفقیت انجام پذیرفت
            </div>
        </div>
    @endif
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
                {{$epic->title}}
            </div>
            <div class="card-body">
                <form action="{{route('epics.update', ['epic' => $epic])}}" method="POST" class="text-center p-5">
                    @csrf
                    <input name="project_id" value="{{$epic->project_id}}" hidden />
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <label>عنوان:</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{old('title', $epic->title)}}" placeholder="طراحی mvp اولیه">
                        </div>
                    </div>
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col">
                            <div class="form-group">
                                <label for="description">توضیحات فاز:</label>
                                <textarea class="form-control rounded-0" id="description" name="description" rows="3">{{old('description', $epic->description)}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-4" style="text-align: right;">
                        <div class="col-md-2 col-4">
                            <div class="form-group">
                                <label>روز شروع</label>{{$epic->start_date_day}}
                                <select class="browser-default custom-select" name="start_date_day" style="margin-top: -0.3rem">
                                    @for($i=1; $i<=31; $i++)
                                        <option value="{{$i}}" {{$i == old('start_date_day', $epic->start_date_day)? 'selected': ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-4">
                            <div class="form-group">
                                <label>ماه شروع</label>
                                <select class="browser-default custom-select" name="start_date_month" style="margin-top: -0.3rem">
                                    @foreach(__('general.months') as $code=>$label)
                                        <option value="{{$code}}" {{$code == old('start_date_month', $epic->start_date_month)? 'selected': ''}}>{{$label}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-4">
                            <div class="form-group">
                                <label>سال شروع</label>
                                <select class="browser-default custom-select" name="start_date_year" style="margin-top: -0.3rem">
                                    @for($i=1390; $i<1400; $i++)
                                        <option value="{{$i}}" {{$i == old('start_date_year', $epic->start_date_year)? 'selected': ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-4">
                            <div class="form-group">
                                <label>روز پایان</label>
                                <select class="browser-default custom-select" name="finish_date_day" style="margin-top: -0.3rem">
                                    @for($i=1; $i<=31; $i++)
                                        <option value="{{$i}}" {{$i == old('finish_date_day', $epic->finish_date_day)? 'selected': ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-4">
                            <div class="form-group">
                                <label>ماه پایان</label>
                                <select class="browser-default custom-select" name="finish_date_month" style="margin-top: -0.3rem">
                                    @foreach(__('general.months') as $code=>$label)
                                        <option value="{{$code}}" {{$code == old('finish_date_month', $epic->finish_date_month)? 'selected': ''}}>{{$label}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-4">
                            <div class="form-group">
                                <label>سال پایان</label>
                                <select class="browser-default custom-select" name="finish_date_year" style="margin-top: -0.3rem">
                                    @for($i=1390; $i<1400; $i++)
                                        <option value="{{$i}}" {{$i == old('finish_date_year', $epic->finish_date_year)? 'selected': ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-info my-4" type="submit">ذخیره فاز</button>
                    <a class="btn btn-primary" href="{{route('epics.show', ['epic' => $epic])}}">ورود به فاز</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection