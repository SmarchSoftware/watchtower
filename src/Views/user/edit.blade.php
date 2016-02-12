@extends(config('watchtower.views.layouts.master'))

@section('content')

    <h1>Edit '{{ $resource->name }}'</h1>
    <hr/>

    {!! Form::model($resource, ['method' => 'PATCH', 'route' => [ 'watchtower.user.update', $resource->id ], 'class' => 'form-horizontal']) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('name', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::label('email', 'Email Address: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('email', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    @if ($show == '0') 

      <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
          {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-md-6">
              <input type="password" class="form-control" name="password">
              {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
          </div>
      </div>

      <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
          {!! Form::label('password_confirmation', 'Confirm Password: ', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-md-6">
              <input type="password" class="form-control" name="password_confirmation">
              {!! $errors->first('password_confirmation', '<div class="text-danger">:message</div>') !!}
          </div>
      </div>
      
      @if ( Shinobi::can( config('watchtower.acl.user.edit', false) ) ) 

       <div class="form-group">
         <div class="col-sm-offset-3 col-sm-3">
           {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
         </div>

       @else

        <div class="col-sm-6 col-sm-offset-3 alert alert-danger lead">
          <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to {{ ( ($show == '0') ? 'edit' : 'view' ) }} users.
        </div>

      @endif
     </div>
      
    @else
     <div class="form-group">
         <div class="col-sm-6 col-sm-offset-3">
            <a href="{{ route('watchtower.user.edit', $resource->id) }}" class="pull-right" title="Edit this User">
              <i class="fa fa-pencil fa-fw"></i> 
              <span class="hidden-xs hidden-sm">Edit</span>
              </button></a>

            <a href="{{ route('watchtower.user.role.edit', $resource->id) }}" title="Roles for this user">
              <i class="fa fa-key fa-fw"></i> 
              <span class="hidden-xs hidden-sm">Roles</span>
              </button></a>
        </div>
     </div>        
    @endif
    {!! Form::close() !!}

@endsection