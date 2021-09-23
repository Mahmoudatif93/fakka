@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.gifts')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.points.index') }}"> @lang('site.gifts')</a></li>
                <li class="active">@lang('site.gifts')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.gifts')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.gifts.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class=" col-md-12">
                        <div class="form-group col-md-6">
                                <label>@lang('site.gift_name')</label>
                                <input type="text" name="gift_name" class="form-control" >
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('site.gift_points')</label>
                                <input type="text" name="gift_points" class="form-control" >
                            </div>

                            </div>
                            <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.gift_image')</label>
                                <input type="file" name="gift_image" class="form-control image">
                            </div>

                            <div class="form-group col-md-6">
                                <img src="{{ asset('uploads/product_images/default.jpg') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            </div>
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
