@extends(config('watchtower.views.layouts.master'))

@section('content')
    <h1>Create New {{ $route }}</h1>
    <hr/>

    {!! Form::open( ['route' => config('watchtower.route.as') . $route .'.store', 'class' => 'form-horizontal']) !!}

    <div class="row {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Name: ', ['class' => 'small-2 columns']) !!}
        {!! Form::text('name', null, ['class' => 'small-6 columns']) !!}
        {!! $errors->first('name', '<div class="small-6 columns form-error">:message</div>') !!}
    </div>

    <div class="row {{ $errors->has('slug') ? 'has-error' : ''}}">
        {!! Form::label('slug', 'Slug: ', ['class' => 'small-2 columns']) !!}
        {!! Form::text('slug', null, ['class' => 'small-6 columns']) !!}
        {!! $errors->first('slug', '<div class="small-6 columns form-error">:message</div>') !!}
    </div>

    <div class="row {{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('description', 'Description: ', ['class' => 'small-2 columns']) !!}
        {!! Form::textarea('description', null, ['class' => 'small-6 columns']) !!}
        {!! $errors->first('description', '<div class="small-6 columns form-error">:message</div>') !!}
    </div>

    @if ($route == "role")
        <div class="row">
            {!! Form::label('special', 'Special Access: ', ['class' => 'small-2 columns']) !!}
            {!! Form::select('special', array('all-access' => 'All Access', 'no-access' => 'No Access'), null, ['placeholder' => 'No special access.', 'class' => 'small-6 columns'] ) !!}
            {!! $errors->first('special', '<div class="small-6 columns form-error">:message</div>') !!}
        </div>
    @endif

    <div class="row">
        <div class="small-3 columns">
            {!! Form::submit('Create '.$route, ['class' => 'button']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection