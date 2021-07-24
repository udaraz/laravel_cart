<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="#" class="simple-text logo-normal ml-5">
            ABC Company
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @hasanyrole('Admin|Operation Manager')
                <li class={{(Route::currentRouteName()=='admin.product.index')?'active':''}} >
                    <a href="{{route('admin.product.index')}}">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <p>Add Products</p>
                    </a>
                </li>

                <li class={{(Route::currentRouteName()=='admin.products.manage')?'active':''}}>
                    <a href="{{route('admin.products.manage')}}">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <p>Manage Products</p>
                    </a>
                </li>
            @endhasanyrole

            @role('Sales Manager')
                <li class={{(Route::currentRouteName()=='admin.orders.view')?'active':''}}>
                    <a href="{{route('admin.orders.view')}}">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <p>Sales</p>
                    </a>
                </li>
            @endrole

            @role('Admin')
                <li class={{(Route::currentRouteName()=='admin.create')?'active':''}}>
                    <a href="{{route('admin.create')}}">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <p>Create User</p>
                    </a>
                </li>
            @endrole

        </ul>
    </div>
</div>
