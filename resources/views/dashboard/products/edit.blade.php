@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.products')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
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

                <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="row ">
                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.categories')</label>
                                <select disabled readonly  id="category_id"onchange="appear()" name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                    <option readonly value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <input type="hidden"  value="{{$product->category_id}}" name="category_id">
                            </div>


                            @if($product->category_id==1)
                            <div style="" id="ingots" class="form-group col-md-6">
                                <label>@lang('site.ingots')</label>
                                <select  id="number_grams" onchange="getfeescaches()" name="number_gramsss" class="form-control">
                                    <option value="">@lang('site.ingots')</option>
                                    @foreach ($ingots as $category)
                                    <option data-id="{{$category->id}}" value="{{ $category->ingots }}" {{ $product->number_grams == $category->ingots  ? 'selected' : '' }}>{{ $category->ingots }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="number_gramsv" name="number_grams" value="{{ $product->number_grams }}">

                            </div>
                            @else
                            <div style="" id="coins" class="form-group col-md-6">
                                <label>@lang('site.coins')</label>
                                <select id="number_grams2" onchange="getfeescoins()" name="number_garmss" class="form-control">
                                    <option value="">@lang('site.coins')</option>
                                    @foreach ($coins as $category)
                                    <option data-id="{{$category->id}}" value="{{ $category->coins }}" {{ $product->number_grams == $category->coins ? 'selected' : '' }}>{{ $category->coins }}</option>
                                    @endforeach
                                </select>
                            <input type="hidden" id="number_gramsv" name="number_grams" value="{{ $product->number_grams }}">
                            </div>
                            @endif

                        </div>

                        <div class=" col-md-12">
                         
                            <div class=" col-md-6 ">
                                <div class="form-group">
                                    <label>@lang('site.ardescription')</label>

                                    <textarea name="ar[description] " class="form-control ckeditor">{{ $product->ProductTranslation[0]->description }} </textarea>
                                </div>
                            </div>

                            <div class=" col-md-6 ">
                                <div class="form-group">
                                    <label>@lang('site.endescription')</label>

                                    <textarea name="en[description] " class="form-control ckeditor">{{ $product->ProductTranslation[1]->description }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class=" col-md-12">
                      
                      
                            <div class=" col-md-6 ">
                                <div class="form-group">
                               
                                <label>@lang('site.namearabic')</label>
                                    <input type="text" name="ar[name]" class="form-control" value="{{ $product->ProductTranslation[0]->name }}">
                                   
                                   
                                </div>
                            </div>
                          
                            <div class=" col-md-6 ">
                                <div class="form-group">
                                    <label>@lang('site.nameenglish')</label>
                                    <input type="text" name="en[name]" class="form-control" value="{{ $product->ProductTranslation[1]->name }}">
                                  
                                   
                                </div>
                            </div>
                          
                         
                        </div>


                     

                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control image">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <img src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.thickness(mm)')</label>
                                <input type="text" name="thickness" class="form-control" value="{{ $product->thickness }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('site.karat')(Gold)</label>
                                <input type="text" name="karat" class="form-control" value="{{ $product->karat }}">
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.Weight')(Gram)</label>
                                <input readonly type="text" id="weight" name="weight" class="form-control" value="{{ $product->weight }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('site.manufacturer')</label>
                                <input type="text" name="manufacturer" class="form-control" value="{{ $product->manufacturer }}">
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.design')</label>
                                <input type="text" name="design" class="form-control" value="{{ $product->design }}">
                            </div>
                            @if($product->category_id==2)
                            <div id="diameter"class="form-group col-md-6">
                                <label>@lang('site.diameter(mm)')</label>
                                <input type="text" name="diameter" class="form-control" value="{{ $product->diameter }}">
                            </div>
                            @endif
                        </div>
                        <div class=" col-md-12">
                        <div class=" col-md-6">

                            <label>@lang('site.fees')</label>
                            <input type="text" id="fees" name="fees" class="form-control" readonly value="{{ $product->fees }}">
                        </div>

                        <div class="form-group col-md-6">

                            <label>@lang('site.cashs')</label>
                            <input type="text" id="cashs" name="cashs" class="form-control" readonly value="{{ $product->cashs }}">
                        </div>
                        <div class="form-group col-md-6">
                                <label>@lang('site.height')</label>
                                <input type="text" name="height" class="form-control" value="{{ $product->height }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('site.width')</label>
                                <input type="text" name="width" class="form-control" value="{{ $product->width }}">
                            </div>

                            <div class="form-group col-md-6" style="display: none;">
                                <label>@lang('site.depth')</label>
                                <input type="text" name="depth" class="form-control" value="{{ $product->depth }}">
                            </div>
                    </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
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
