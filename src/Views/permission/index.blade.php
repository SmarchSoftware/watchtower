@extends(config('watchtower.views.layouts.master'))

@section('content')

    <h1>Permissions
        <div class="float-right" role="group" aria-label="...">
            @if ( Shinobi::can( config('watchtower.acl.role.viewmatrix', false) ) )
                <a href="{{ route('watchtower.role.matrix') }}">
                    <button type="button" class="large button">
                        <i class="fa fa-th fa-fw"></i>
                        <span>Permission Matrix</span>
                    </button></a>
            @endif

            @if ( Shinobi::can( config('watchtower.acl.permission.create', false) ) )
                <a href="{{ route( config('watchtower.route.as') .'permission.create') }}">
                    <button type="button" class="large button">
                        <i class="fa fa-plus fa-fw"></i>
                        <span>Add New Permission</span>
                    </button></a>
            @endif
        </div>
    </h1>

    <!-- search bar -->
    @include( config('watchtower.views.layouts.search'), [ 'search_route' => config('watchtower.route.as') .'permission.index', 'items' => $permissions, 'acl' => 'permission' ] )

    <div class="table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th><th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @forelse($permissions as $item)
                <tr>
                    <td>
                        <a href="{{ route( config('watchtower.route.as') .'permission.show', $item->id) }}">{{ $item->name }}</a>
                    </td>

                    <td>
                        @if ( Shinobi::can( config('watchtower.acl.permission.role', false)) )
                            <a href="{{ route( config('watchtower.route.as') .'permission.role.edit', $item->id) }}">
                                <button type="button" class="small button">
                                    <i class="fa fa-users fa-fw"></i>
                                    <span>Roles</span>
                                </button></a>
                        @endif

                        @if ( Shinobi::can( config('watchtower.acl.permission.edit', false)) )
                            <a href="{{ route( config('watchtower.route.as') .'permission.edit', $item->id) }}">
                                <button type="button" class="small button">
                                    <i class="fa fa-pencil fa-fw"></i>
                                    <span>Update</span>
                                </button></a>
                        @endif

                        @if ( Shinobi::can( config('watchtower.acl.permission.destroy', false) ) )
                            {!! Form::open(['method'=>'delete','route'=> [ config('watchtower.route.as') .'permission.destroy',$item->id], 'style' => 'display:inline']) !!}
                            <button type="submit" class="alert small button">
                                <i class="fa fa-trash-o fa-lg"></i>
                                <span>Delete</span>
                            </button>
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td>There are no permissions</td></tr>
                @endforelse

                        <!-- pagination -->
            <tfoot>
            <tr>
                <td colspan="3" class="text-center small">
                    {!! $permissions->render() !!}
                </td>
            </tr>
            </tfoot>
            </tbody>
        </table>
    </div>

@endsection