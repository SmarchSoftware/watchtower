@extends(config('watchtower.views.layouts.master'))

@section('content')

    <h1>Roles
        <div class="float-right" role="group" aria-label="...">
            @if ( Shinobi::can( config('watchtower.acl.role.viewmatrix', false) ) )
                <a href="{{ route( config('watchtower.route.as') .'role.matrix') }}">
                    <button type="button" class="large button">
                        <i class="fa fa-th fa-fw"></i>
                        <span class="">Role Matrix</span>
                    </button>
                </a>
            @endif

            @if ( Shinobi::can( config('watchtower.acl.role.create', false) ) )
                <a href="{{ route( config('watchtower.route.as') .'role.create') }}">
                    <button type="button" class="large button">
                        <i class="fa fa-plus fa-fw"></i>
                        <span class="">Add New Role</span>
                    </button>
                </a>
            @endif
        </div>
    </h1>


    <!-- search bar -->
    @include( config('watchtower.views.layouts.search'), [ 'search_route' => config('watchtower.route.as') .'role.index', 'items' => $roles, 'acl' => 'role' ] )

    <div class="table">
        <table class="hover">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Actions</th>
                </tr>
            </thead>

            <tbody>
              @forelse($roles as $item)
               <tr>
                <td>{{ $item->id }}</td>
                
                <td>
                    <a href="{{ route( config('watchtower.route.as') .'role.show', $item->id) }}">{{ $item->name }}</a>
                    @if ($item->special == 'all-access')
                      <i class="fa fa-star text-success"></i> 
                    @elseif ($item->special == 'no-access')
                      <i class="fa fa-ban text-danger"></i> 
                    @endif
                </td>
                
                <td>
                    @if ( Shinobi::can( config('watchtower.acl.role.permission', false)) )
                    <a href="{{ route( config('watchtower.route.as') .'role.permission.edit', $item->id) }}">
                      <button type="button" class="small button">
                      <i class="fa fa-key fa-fw"></i> 
                      <span>Permissions</span>
                      </button></a>
                    @endif

                    @if ( Shinobi::can( config('watchtower.acl.role.user', false)) )
                    <a href="{{ route( config('watchtower.route.as') .'role.user.edit', $item->id) }}">
                      <button type="button" class="small button">
                      <i class="fa fa-user fa-fw"></i> 
                      <span>Users</span>
                      </button></a>
                    @endif

                    @if ( Shinobi::can( config('watchtower.acl.role.edit', false)) )
                    <a href="{{ route( config('watchtower.route.as') .'role.edit', $item->id) }}">
                      <button type="button" class="small button">
                      <i class="fa fa-pencil fa-fw"></i> 
                      <span>Update</span>
                      </button></a>
                    @endif

                    @if ( Shinobi::can( config('watchtower.acl.role.destroy', false)) )
                      {!! Form::open(['method'=>'delete','route'=> [ config('watchtower.route.as') .'role.destroy',$item->id], 'style' => 'display:inline']) !!}
                        <button type="submit" class="alert small button">
                        <i class="fa fa-trash-o fa-lg"></i> 
                        <span>Delete</span>
                        </button>
                      {!! Form::close() !!}
                    @endif
                </td>
               </tr>
              @empty
                <tr><td>There are no roles</td></tr>
              @endforelse

              <!-- pagination -->
              <tfoot>
                <tr>
                 <td colspan="3" class="text-center small">
                  {!! $roles->render() !!}
                 </td>
                </tr>
              </tfoot>
            </tbody>
        </table>
    </div>

@endsection