@extends(config('watchtower.views.layouts.master'))

@section('content')

  @if ( \Shinobi::can( config('watchtower.acl.permission.index', false) ) )

    <h1>Permissions
    <div class="btn-group pull-right" role="group" aria-label="...">    
      <a href="{{ route('watchtower.role.matrix') }}">
      <button type="button" class="btn btn-default">
        <i class="fa fa-th fa-fw"></i> 
        <span class="hidden-xs hidden-sm">Role Matrix</span>
      </button></a>

      <a href="{{ route('watchtower.permission.create') }}">
      <button type="button" class="btn btn-info">
        <i class="fa fa-plus fa-fw"></i> 
        <span class="hidden-xs hidden-sm">Add New Permission</span>
      </button></a>
    </div>
    </h1>

    <!-- search bar -->
    @include( config('watchtower.views.layouts.search'), [ 'search_route' => 'watchtower.permission.index', 'items' => $permissions, 'acl' => 'permission' ] )

    <div class="table">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Actions</th>
                </tr>
            </thead>

            <tbody>
              @foreach($permissions as $item)
               <tr>
                <td>{{ $item->id }}</td>
                
                <td>
                    <a href="{{ route('watchtower.permission.show', $item->id) }}">{{ $item->name }}</a>
                </td>
                
                <td>
                    <a href="{{ route('watchtower.permission.role.edit', $item->id) }}">
                      <button type="button" class="btn btn-primary btn-xs">
                      <i class="fa fa-users fa-fw"></i> 
                      <span class="hidden-xs hidden-sm">Roles</span>
                      </button></a>

                    <a href="{{ route('watchtower.permission.edit', $item->id) }}">
                      <button type="button" class="btn btn-default btn-xs">
                      <i class="fa fa-pencil fa-fw"></i> 
                      <span class="hidden-xs hidden-sm">Update</span>
                      </button></a>
                    @if ( \Shinobi::can( config('watchtower.acl.permission.destroy', false) ) )
                    {!! Form::open(['method'=>'delete','route'=> ['watchtower.permission.destroy',$item->id], 'style' => 'display:inline']) !!}
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
                  {!! $permissions->render() !!}
                 </td>
                </tr>
              </tfoot>
            </tbody>
        </table>
    </div>

  @else

      <div class="alert alert-danger lead">
        <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to view permission list.
      </div>
      
  @endif
@endsection