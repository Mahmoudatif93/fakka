                        <table class="table table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                <th>#</th>
                         
                                <th>@lang('site.delivery_type')</th>
                                <th>@lang('site.shipping_address')</th>
                                <th>@lang('site.category_name')</th>
                                <th>@lang('site.product_name')</th>
                                <th>@lang('site.number_grams')</th>
                                <th>@lang('site.qty')</th>
                                <th>@lang('site.points')</th>
                                <th>@lang('site.fees')</th>
                                <th>@lang('site.recet_no')</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($client_orders as $index=>$client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                 
                                    <td>{{ $client->delivery_type }}</td>
                                    <td>@if($client->shipping_address !=null)
                                    {{ $client->shipping_address }}
                                    @else
                                    {{ "لا يوجد" }}
                                    @endif
                                    </td>
                                    <td>{{ $client->category_name }}</td>
                                    <td>{{ $client->product_name }}</td>
                                    <td>{{ $client->product_weight }}</td>
                                    <td>{{ $client->qty }}</td>
                                    <td>{{ $client->earned_points }}</td>
                                    <td>{{ $client->fees }}</td>
                                    <td>{{ $client->recet_no }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
