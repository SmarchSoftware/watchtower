@extends(config('watchtower.views.layouts.master'))

@section('content')

    <h1>Roles
    <div class="btn-group pull-right" role="group" aria-label="...">    
      <a href="{{ route('watchtower.role.matrix') }}">
      <button type="button" class="btn btn-default">
        <i class="fa fa-th fa-fw"></i> 
        <span class="hidden-xs hidden-sm">Role Matrix</span>
      </button></a>

      <a href="{{ route('watchtower.role.create') }}">
      <button type="button" class="btn btn-info">
        <i class="fa fa-plus fa-fw"></i> 
        <span class="hidden-xs hidden-sm">Add New Role</span>
      </button></a>
    </div>
    </h1>

    <!-- search bar -->
    @include( config('watchtower.views.layouts.search'), [ 'search_route' => 'watchtower.role.index', 'items' => $roles, 'acl' => 'role' ] )

    <div class="table">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Actions</th>
                </tr>
            </thead>

            <tbody>
              @foreach($roles as $item)
               <tr>
                <td>{{ $item->id }}</td>
                
                <td>
                    <a href="{{ route('watchtower.role.show', $item->id) }}">{{ $item->name }}</a>
                    @if ($item->special == 'all-access')
                      <i class="fa fa-star text-success"></i> 
                    @elseif ($item->special == 'no-access')
                      <i class="fa fa-ban text-danger"></i> 
                    @endif
                </td>
                
                <td>
                    <a href="{{ route('watchtower.role.permission.edit', $item->id) }}">
                      <button type="button" class="btn btn-primary btn-xs">
                      <i class="fa fa-key fa-fw"></i> 
                      <span class="hidden-xs hidden-sm">Permissions</span>
                      </button></a>

                    <a href="{{ route('watchtower.role.user.edit', $item->id) }}">
                      <button type="button" class="btn btn-primary btn-xs">
                      <i class="fa fa-user fa-fw"></i> 
                      <span class="hidden-xs hidden-sm">Users</span>
                      </button></a>

                    <a href="{{ route('watchtower.role.edit', $item->id) }}">
                      <button type="button" class="btn btn-default btn-xs">
                      <i class="fa fa-pencil fa-fw"></i> 
                      <span class="hidden-xs hidden-sm">Update</span>
                      </button></a>

                    @if ( \Shinobi::can( config('watchtower.acl.role.destroy', false)) )
                      {!! Form::open(['method'=>'delete','route'=> ['watchtower.role.destroy',$item->id], 'style' => 'display:inline']) !!}
                        <button type="submit" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash-o fa-lg"></i> 
                        <span class="hidden-xs hidden-sm">Delete</span>
                        </button>
                      {!! Form::close() !!}
                    @endif
                </td>
               </tr>
              @endforeach

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