<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
            @if(!empty(auth()->user()->image))
                <img src="{{ asset('uploads/user_images/' .auth()->user()->image) }}" class="img-circle" alt="User Image">
            @else
            <img src="{{ asset('uploads/user_images/default.jpg') }}" class="img-circle" alt="User Image">
            @endif
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->first_name.' '.auth()->user()->last_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

            @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('dashboard.ingots.index') }}"><i class="fa fa-th"></i><span>@lang('site.ingots')</span></a></li>
            @endif
             @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('dashboard.fees_caches.index') }}"><i class="fa fa-th"></i><span>@lang('site.fees_caches')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('dashboard.coins.index') }}"><i class="fa fa-th"></i><span>@lang('site.coins')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('dashboard.coins_fees.index') }}"><i class="fa fa-th"></i><span>@lang('site.coins_fees')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-th"></i><span>@lang('site.categories')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_products'))
            <li><a href="{{ route('dashboard.products.index') }}"><i class="fa fa-th"></i><span>@lang('site.products')</span></a></li>
            @endif
         @if (auth()->user()->hasPermission('read_clients'))
            <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-th"></i><span>@lang('site.clients')</span></a></li>
            @endif



            {{--  @if (auth()->user()->hasPermission('read_orders'))
            <li><a href="{{ route('dashboard.orders.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders')</span></a></li>
        @endif
        --}}

        @if (auth()->user()->hasPermission('read_contacts'))
            <li><a href="{{ route('dashboard.contacts.index') }}"><i class="fa fa-th"></i><span>@lang('site.contact_us')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_confirmpayment'))
            <li><a href="{{ route('dashboard.confirmpayment.index') }}"><i class="fa fa-th"></i><span>@lang('site.confirmpayment')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_virtual_gold'))
            <li><a href="{{ route('dashboard.virtual_gold.index') }}"><i class="fa fa-th"></i><span>@lang('site.virtual_gold')</span></a></li>
            @endif


            @if (auth()->user()->hasPermission('read_banks'))
            <li><a href="{{ route('dashboard.banks.index') }}"><i class="fa fa-th"></i><span>@lang('site.banks')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_wallet'))
            <li><a href="{{ route('dashboard.wallet.index') }}"><i class="fa fa-th"></i><span>@lang('site.wallet')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_withdrow_wallet'))
            <li><a href="{{ route('dashboard.withdrowwallet.index') }}"><i class="fa fa-th"></i><span>@lang('site.withdrow_wallet')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_withdrow_wallet'))
            <li><a href="{{ route('dashboard.shippingingots.index') }}"><i class="fa fa-th"></i><span>@lang('site.shippingingots')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_withdrow_wallet'))
            <li><a href="{{ route('dashboard.shippingcost.index') }}"><i class="fa fa-th"></i><span>@lang('site.shipping_cost')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_withdrow_wallet'))
            <li><a href="{{ route('dashboard.points.index') }}"><i class="fa fa-th"></i><span>@lang('site.points')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_withdrow_wallet'))
            <li><a href="{{ route('dashboard.gifts.index') }}"><i class="fa fa-th"></i><span>@lang('site.gifts')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_withdrow_wallet'))
            <li><a href="{{ route('dashboard.giftsrequest.index') }}"><i class="fa fa-th"></i><span>@lang('site.giftsrequest')</span></a></li>
            @endif
          {{--  @if (auth()->user()->hasPermission('read_withdrow_wallet'))
            <li><a href="{{ route('dashboard.contacts_info.index') }}"><i class="fa fa-th"></i><span>@lang('site.contacts_info')</span></a></li>
            @endif--}}


           {{-- @if (auth()->user()->hasPermission('read_withdrow_wallet'))
            <li><a href="{{ route('dashboard.aboutus.index') }}"><i class="fa fa-th"></i><span>@lang('site.aboutus')</span></a></li>
            @endif--}}
            
            
            @if (auth()->user()->hasPermission('read_users'))
            <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>@lang('site.users')</span></a></li>
            @endif







           {{-- @if (auth()->user()->hasPermission('read_users'))
                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>@lang('site.users')</span></a></li>
            @endif--}}

            {{--<li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-book"></i><span>@lang('site.categories')</span></a></li>--}}
            {{----}}
            {{----}}
            {{--<li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>--}}

            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-pie-chart"></i>--}}
            {{--<span>الخرائط</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
            {{--<a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
        </ul>

    </section>

</aside>

