@extends(config('watchtower.views.layouts.master'))

@section('content')

    <h1>{{ ( ($show == '0') ? 'Edit' : 'Viewing' ) }} '{{ $resource->name }}'</h1>
    <hr/>

    {!! Form::model($resource, ['method' => 'PATCH', 'route' => [ config('watchtower.route.as') . $route .'.update', $resource->id ], 'class' => 'form-horizontal']) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('name', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
        {!! Form::label('slug', 'Slug: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('slug', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('slug', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('description', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    @if ($route == "role")
    <div class="form-group">
        {!! Form::label('special', 'Special Access: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('special', array('all-access' => 'All Access', 'no-access' => 'No Access'), null, ['placeholder' => 'No special access.', 'class' => 'form-control'] ) !!}
        </div>
        {!! $errors->first('special', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>
    @endif
    
    @if ($show == '0')
      @if ( Shinobi::can( config('watchtower.acl.'.$route.'.edit', false) ) ) 
         <div class="form-group">
             <div class="col-sm-offset-3 col-sm-3">
                 {!! Form::submit('Update '.$route, ['class' => 'btn btn-primary form-control']) !!}
             </div>
         </div>

       @else

        <div class="col-sm-6 col-sm-offset-3 alert alert-danger lead">
          <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to {{ ( ($show == '0') ? 'edit' : 'view' ) }} {{$route}}s.
        </div>

      @endif
    @else
     <div class="form-group">
         <div class="col-sm-6 col-sm-offset-3 text-center">
              <div class="pull-right">
                <i class="fa fa-pencil"></i> 
                <a href="{{ route('watchtower.'.$route.'.edit', $resource->id) }}" title="Edit this {{ $route }}">Edit</a>
              </div>

            @if ($route == "role")
              <div class="pull-left">  
                <i class="fa fa-user"></i>
                <a href="{{ route('watchtower.'.$route.'.user.edit', $resource->id) }}" class="text-center" title="Users with this {{ $route }}">Users</a>
              </div>

              <i class="fa fa-key"></i>
              <a href="{{ route('watchtower.'.$route.'.permission.edit', $resource->id) }}" title="Edit Permissions for this {{ $route }}">Permissions</a>
            @else
              <div class="pull-left">  
                <i class="fa fa-key"></i> 
                <a href="{{ route('watchtower.'.$route.'.role.edit', $resource->id) }}" title="Roles for this permission">Roles</a>
              </div>
            @endif
        </div>
     </div>        
    @endif
    {!! Form::close() !!}

@endsection