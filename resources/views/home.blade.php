@extends('layouts.app')
@section('title', 'خانه')

@section('content')
<div class="row" style="text-align: left;">
    <div class="col-md-12">
        <a class="btn btn-primary" style="margin-left: 0px;" href="{{route('projects.create')}}">پروژه جدید</a>
    </div>
</div>
@if(sizeof(Auth::user()->projects) >0)
    @for($i=0; $i<5; $i++)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        پروژه تستی (۵ نفر) - شروع از ۱۵ بهمن ۹۵
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: left;">
                                <a class="btn btn-primary" href="#edit-project">ورود به پروژه</a>
                                <a class="btn btn-info" href="#edit-project">ویرایش</a>
                                <a class="btn btn-default" href="#close-project">خاتمه</a>
                                <a class="btn btn-danger" href="#remove-project">حذف</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
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
