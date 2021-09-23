@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.ingots')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.ingots.index') }}"> @lang('site.ingots')</a></li>
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

                    <form action="{{ route('dashboard.fees_caches.update', $category->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="row ">
                            <div class=" col-md-12">
                                <div class="form-group col-md-4">
                                        <label>@lang('site.ingots')</label>
                                        <select   readonly name="ingots_id" class="form-control">
                                           
                                            @foreach ($ingots as $ingot)
                                            <option readonly  value="{{ $ingot->id }}" {{ $category->ingots_id == $ingot->id ? 'selected' : '' }}>{{ $ingot->ingots }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>@lang('site.fees')</label>
                                        <input type="number" name="fees"  step="0.01" class="form-control" value="{{ $category->fees }}">
                                    </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>@lang('site.cachback')</label>
                                        <input type="number" name="cache_back"  step="0.01" class="form-control" value="{{ $category->cache_back }}">
                                    </div>
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
