@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.gifts')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.gifts.index') }}"> @lang('site.gifts')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.gifts.update', $category->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        <div class=" col-md-12">
                        <div class="form-group col-md-6">
                                <label>@lang('site.gift_name')</label>
                                <input type="text" name="gift_name" class="form-control" value="{{ $category->gift_name }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('site.gift_points')</label>
                                <input type="text" name="gift_points" class="form-control" value="{{ $category->gift_points }}">
                            </div>
                            </div>

                            <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.gift_image')</label>
                                    <input type="file" name="gift_image" class="form-control image">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <img src="{{ asset('uploads/gifts/' . $category->gift_image) }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
