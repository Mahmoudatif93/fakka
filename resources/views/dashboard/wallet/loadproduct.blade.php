                        <table class="table table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.delivery_type')</th>
                                <th>@lang('site.shipping_address')</th>
                                <th>@lang('site.category_name')</th>
                                <th>@lang('site.product_name')</th>
                                <th>@lang('site.number_grams')</th>
                                
                                <th>@lang('site.price')</th>
                                <th>@lang('site.qty')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($client_orders as $index=>$client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->client_name }}</td>
                                    <td>{{ $client->client_phone }}</td>
                                    <td>{{ $client->client_email }}</td>
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
                                    <td>{{ $client->price_per_gram *  $client->product_weight  * $client->product_qty }}</td>
                                    <td>{{ $client->product_qty }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>