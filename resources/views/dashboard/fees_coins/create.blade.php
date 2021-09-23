@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.coins_fees')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.coins_fees.index') }}"> @lang('site.coins_fees')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.coins_fees.store') }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="row ">
                            <div class=" col-md-12">
                                <div class="form-group col-md-4">
                                        <label>@lang('site.coins')</label>
                                        <select name="coins_id" class="form-control">
                                            <option value="">@lang('site.coins')</option>
                                            @foreach ($ingots as $ingot)
                                            <option value="{{ $ingot->id }}" {{ old('ingots_id') == $ingot->id ? 'selected' : '' }}>{{ $ingot->coins }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>@lang('site.fees')</label>
                                        <input  type="number" step="0.01" name="fees" class="form-control" >
                                    </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>@lang('site.cachback')</label>
                                        <input  type="number" step="0.01" name="cache_back" class="form-control" >
                                    </div>
                                    </div>

                             
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
