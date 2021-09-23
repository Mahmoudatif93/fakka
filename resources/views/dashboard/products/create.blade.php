@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.products')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
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

                <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="row ">
                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.categories')</label>
                                <select id="category_id" onchange="appear()" name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div style="display: none;" id="ingots" class="form-group col-md-6">
                                <label>@lang('site.ingots')</label>
                                <select id="number_grams" onchange="getfeescaches()" name="number_gramsss" class="form-control">
                                    <option value="">@lang('site.ingots')</option>
                                    @foreach ($ingots as $category)
                                    <option data-id="{{$category->id}}" value="{{ $category->ingots }}" {{ old('id') == $category->id ? 'selected' : '' }}>{{ $category->ingots }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div style="display: none;" id="coins" class="form-group col-md-6">
                                <label>@lang('site.coins')</label>
                                <select id="number_grams2" onchange="getfeescoins()" name="number_gramss" class="form-control">
                                    <option value="">@lang('site.coins')</option>
                                    @foreach ($coins as $category)
                                    <option data-id="{{$category->id}}" value="{{ $category->coins }}" {{ old('id') == $category->id ? 'selected' : '' }}>{{ $category->coins }}</option>
                                    @endforeach
                                </select>
                            <input type="hidden" id="number_gramsv" name="number_grams">
                            </div>

                        </div>
                        <div class=" col-md-12">
                            @foreach (config('translatable.locales') as $locale)

                            <div class=" col-md-6 ">
                                <div class="form-group ">
                                    <label>@lang('site.' . $locale . '.description')</label>
                                    <textarea name="{{ $locale }}[description]" class="form-control ckeditor">{{ old($locale . '.description') }}</textarea>
                                </div>
                            </div>

                            @endforeach
                        </div>

                        <div class=" col-md-12">
                            @foreach (config('translatable.locales') as $locale)
                            <div class=" col-md-6 ">

                                <div class="form-group">
                                    <label>@lang('site.' . $locale . '.name')</label>
                                    <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                                </div>
                            </div>
                            @endforeach
                        </div>


                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.image')</label>
                                <input type="file" name="image" class="form-control image">
                            </div>

                            <div class="form-group col-md-6">
                                <img src="{{ asset('uploads/product_images/default.jpg') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.thickness(mm)')</label>
                                <input type="text" name="thickness" class="form-control" value="{{ old('thickness') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('site.karat')(Gold)</label>
                                <input type="text" name="karat" class="form-control" value="{{ old('karat') }}">
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.Weight')(Gram)</label>
                                <input readonly type="text" id="weight" name="weight" class="form-control" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('site.manufacturer')</label>
                                <input type="text" name="manufacturer" class="form-control" value="{{ old('manufacturer') }}">
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.design')</label>
                                <input type="text" name="design" class="form-control" value="{{ old('design') }}">
                            </div>
                            <div id="diameter" class="form-group col-md-6">
                                <label>@lang('site.diameter(mm)')</label>
                                <input type="text" name="diameter" class="form-control" value="{{ old('diameter') }}">
                            </div>
                        </div>
                        <div class=" col-md-6">

                            <label>@lang('site.fees')</label>
                            <input type="text" id="fees" name="fees" class="form-control" readonly value="">
                        </div>

                        <div class="form-group col-md-6">

                            <label>@lang('site.cashs')</label>
                            <input type="text" id="cashs" name="cashs" class="form-control" readonly value="">
                        </div>
                        <div class="form-group col-md-6">
                                <label>@lang('site.height')</label>
                                <input type="text" name="height" class="form-control" value="{{ old('height') }}">
                            </div>

                            <div class="form-group col-md-6" >
                                <label>@lang('site.width')</label>
                                <input type="text" name="width" class="form-control" value="{{ old('width') }}">
                            </div>

                            <div class="form-group col-md-6" style="display: none;">
                                <label>@lang('site.depth')</label>
                                <input type="text" name="depth" class="form-control" value="1">
                            </div>

                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>
            </div>
            </form><!-- end of form -->

        </div><!-- end of box body -->

</div><!-- end of box -->

</section><!-- end of content -->

</div><!-- end of content wrapper -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    function getfeescaches() {

        var url = '{{URL::to("/dashboard/getfeeschach")}}';
        var fees = $('#fees').val();
        var cashs = $('#cashs').val();
        var grams = $('#number_grams').val();

        var results = [];
        var selected = $('#number_grams').find('option:selected', this);
        selected.each(function() {
            results.push($(this).data('id'));
        });


        data = {
            results: results,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {

                if (response != "false") {
                    var JSONObject = JSON.parse(response);
                    $('#fees').val(JSONObject.fees);
                    $('#cashs').val(JSONObject.cache_back);
                } else {
                    swal("Error!", "there is no Fees & Cachback for this ingots!", "error");
                }
                $('#weight').val(grams);
                $('#number_gramsv').val(grams);
                

            }
        });

    }




    function getfeescoins() {
        
        var url = '{{URL::to("/dashboard/getfeescoins")}}';
        var fees = $('#fees').val();
        var cashs = $('#cashs').val();
        var grams = $('#number_grams2').val();

        var results = [];
        var selected = $('#number_grams2').find('option:selected', this);
        selected.each(function() {
            results.push($(this).data('id'));
        });


        data = {
            results: results,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {

                if (response != "false") {
                    var JSONObject = JSON.parse(response);
                    $('#fees').val(JSONObject.fees);
                    $('#cashs').val(JSONObject.cache_back);
                } else {
                    swal("Error!", "there is no Fees & Cachback for this ingots!", "error");
                }
                $('#weight').val(grams);
                $('#number_gramsv').val(grams);

            }
        });

    }









    function appear() {

        var cat = $('#category_id').val();
        if (cat == '') {
            $('#ingots').hide();
            $('#coins').hide();
            $('#fees').val('');
            $('#cashs').val('');
            $('#weight').val('');
            $('#number_gramsv').val('')
        }
        if (cat == 1) {
            $('#ingots').show();
            $('#coins').hide();
            $('#fees').val('');
            $('#cashs').val('');
            $('#weight').val('');
            $('#number_gramsv').val('')
            $('#diameter').hide();
        }
        if (cat == 2) {
            $('#coins').show();
            $('#ingots').hide();
            $('#fees').val('');
            $('#cashs').val('');
            $('#weight').val('');
            $('#number_gramsv').val('')
            $('#diameter').show();
        }





    }
</script>
@endsection