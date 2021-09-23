@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.points')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.points.index') }}"> @lang('site.points')</a></li>
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

                    <form action="{{ route('dashboard.points.update', $category->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('put') }}


                            <div class="form-group" style="display: none;">
                                <label>@lang('site.point_added')</label>
                                <input type="text" name="point_added" class="form-control" value="{{ $category->point_added }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.point_dedicated')</label>
                                <input type="text" name="point_dedicated" class="form-control" value="{{ $category->point_dedicated }}">
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
