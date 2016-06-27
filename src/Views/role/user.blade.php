@extends(config('watchtower.views.layouts.master'))

@section('content')
  <h1>'{{ $role->name }}' Users</h1>
  <hr/>

  {!! Form::model($role, [ 'route' => [ config('watchtower.route.as') .'role.user.update', $role->id ], 'class' => 'form-horizontal']) !!}

  <div class="row">
    <div class="small-10 columns">
      <div class="panel">
        <div class="panel-heading clearfix">
          <h2 class="panel-title"><i class="fa fa-user fa-lg"></i> Current Users <small>({{$users->count()}})</small></h2>
        </div>

        <div class="panel-body">
          @forelse($users->chunk(6) as $c)
            @foreach ($c as $u)
              <div class="small-5 columns float-left">
                <label class="checkbox-inline" title="{{ $u->slug }}">
                  <input type="checkbox" name="slug[]" value="{{$u->user_id}}" checked=""> {{ $u->login }}
                </label>
              </div>
            @endforeach
          @empty
            <span class="text-warning"><i class="fa fa-warning text-warning"></i> This role does not have any defined users.</span>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="small-10 columns">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <h2 class="panel-title"><i class="fa fa-user"></i> Available Users <small>({{$available_users->count()}})</small></h2>
        </div>

        <div class="panel-body">
          @forelse($available_users->chunk(6) as $chunk)
            @foreach ($chunk as $au)
              <div class="small-5 columns float-left">
                <label class="checkbox-inline" title="{{ $au->slug }}">
                  <input type="checkbox" name="slug[]" value="{{$au->id}}"> {{ $au->login }}
                </label>
              </div>
            @endforeach
          @empty
            <span class="text-danger"><i class="fa fa-warning text-danger"></i> There aren't any available users.</span>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-3">
      {!! Form::submit('Update Users', ['class' => 'small button']) !!}
    </div>
  </div>

  {!! Form::close() !!}

@endsection