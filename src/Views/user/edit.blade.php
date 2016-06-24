@extends(config('watchtower.views.layouts.master'))

@section('content')

    <h1>Edit '{{ $resource->login }}'</h1>
    <hr/>
    {!! Form::model($resource, ['method' => 'PATCH', 'route' => [ 'watchtower.user.update', $resource->user_id ]]) !!}

    <div class="row {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Name: ', ['class' => 'small-2 columns']) !!}
        {!! Form::text('name', null, ['class' => 'small-6 columns']) !!}
        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}
    </div>

    <div class="row {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::label('email', 'Email: ', ['class' => 'small-2 columns']) !!}
        {!! Form::text('email', null, ['class' => 'small-6 columns']) !!}
        {!! $errors->first('email', '<div class="form-error">:message</div>') !!}
    </div>

    @if ($show == '0')

        <div class="row {{ $errors->has('password') ? 'has-error' : ''}}">
            {!! Form::label('password', 'Password: ', ['class' => 'small-2 columns']) !!}
            <input type="password" class="small-6 columns" name="password">
            {!! $errors->first('password', '<div class="form-error">:message</div>') !!}
        </div>

        <div class="row {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
            {!! Form::label('password_confirmation', 'Confirm Password: ', ['class' => 'small-2 columns']) !!}
            <input type="password" class="small-6 columns" name="password_confirmation">
            {!! $errors->first('password_confirmation', '<div class="form-error">:message</div>') !!}
        </div>

        @if ( Shinobi::can( config('watchtower.acl.user.edit', false) ) )

            <div class="row">
                {!! Form::submit('Update', ['class' => 'small button small-6 columns']) !!}
                @else

                    <div class="small-6 columns">
                        <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to {{ ( ($show == '0') ? 'edit' : 'view' ) }} users.
                    </div>

                @endif
            </div>

        @else
            <div class="row">
                <div class="small-5 columns">
                    <a href="{{ route('watchtower.user.edit', $resource->user_id) }}" class="pull-right" title="Edit this User">
                        <i class="fa fa-pencil fa-fw"></i>
                        <span class="hidden-xs hidden-sm">Edit</span>
                    </a>

                    <a href="{{ route('watchtower.user.role.edit', $resource->user_id) }}" title="Roles for this user">
                        <i class="fa fa-key fa-fw"></i>
                        <span class="hidden-xs hidden-sm">Roles</span>
                    </a>
                </div>
            </div>
        @endif
        {!! Form::close() !!}

@endsection