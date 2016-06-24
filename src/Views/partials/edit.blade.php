@extends(config('watchtower.views.layouts.master'))

@section('content')
    <h1>{{ ( ($show == '0') ? 'Edit' : 'Viewing' ) }} '{{ $resource->name }}'</h1>
    <hr/>

    {!! Form::model($resource, ['method' => 'PATCH', 'route' => [ config('watchtower.route.as') . $route .'.update', $resource->id ]]) !!}

    <div class="row {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Name: ', ['class' => 'small-2 columns']) !!}
        {!! Form::text('name', null, ['class' => 'small-6 columns']) !!}
        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}
    </div>

    <div class="row {{ $errors->has('slug') ? 'has-error' : ''}}">
        {!! Form::label('slug', 'Slug: ', ['class' => 'small-2 columns']) !!}
        {!! Form::text('slug', null, ['class' => 'small-6 columns']) !!}
        {!! $errors->first('slug', '<div class="form-error">:message</div>') !!}
    </div>

    <div class="row {{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('description', 'Description: ', ['class' => 'small-2 columns']) !!}
        {!! Form::textarea('description', null, ['class' => 'small-6 columns']) !!}
        {!! $errors->first('description', '<div class="form-error">:message</div>') !!}
    </div>

    @if ($route == "role")
        <div class="row">
            {!! Form::label('special', 'Special Access: ', ['class' => 'small-2 columns']) !!}
            {!! Form::select('special', array('all-access' => 'All Access', 'no-access' => 'No Access'), null, ['placeholder' => 'No special access.', 'class' => 'small-6 columns'] ) !!}
            {!! $errors->first('special', '<div class="form-error">:message</div>') !!}
        </div>
    @endif

    @if ($show == '0')
        @if ( Shinobi::can( config('watchtower.acl.'.$route.'.edit', false) ) )
            <div class="row">
                {!! Form::submit('Update '.$route, ['class' => 'small button small-3 columns']) !!}
            </div>

        @else
            <div class="small-6 columns">
                <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to {{ ( ($show == '0') ? 'edit' : 'view' ) }} {{$route}}s.
            </div>

        @endif
    @else
        <div class="row">
            <div class="small-6 columns">
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