@extends(config('watchtower.views.layouts.master'))

@section('content')

  <h1>'{{ $user->login }}' Roles</h1>
  <hr/>

  {!! Form::model($user, [ 'route' => [ 'watchtower.user.role.update', $user->user_id ], 'class' => 'form-horizontal']) !!}

  <div class="row">
    <div class="small-10 columns">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <h2 class="panel-title"><i class="fa fa-lg fa-users"></i> Current Roles <small>({{$roles->count()}})</small></h2>
        </div>

        <div class="panel-body">
          @forelse($roles->chunk(6) as $c)
            @foreach ($c as $r)
              <div class="small-5 columns float-left">
                <label class="checkbox-inline" title="{{ $r->id }}">
                  <input type="checkbox" name="ids[]" value="{{$r->id}}" checked=""> {{ $r->name }}
                  @if ($r->special == 'all-access')
                    <i class="fa fa-star text-success"></i>
                  @elseif ($r->special == 'no-access')
                    <i class="fa fa-ban text-danger"></i>
                  @endif
                </label>
              </div>
            @endforeach
          @empty
            <span class="text-warning"><i class="fa fa-warning text-warning"></i> This user does not have any defined roles.</span>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="small-10 columns">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <h2 class="panel-title">
            <i class="fa fa-users"></i> Available Roles <small>({{$available_roles->count()}})</small></h2>
        </div>

        <div class="panel-body">
          @forelse($available_roles->chunk(6) as $chunk)
            @foreach ($chunk as $ar)
              <div class="small-5 columns float-left">
                <label class="checkbox-inline" title="{{ $ar->id }}">
                  <input type="checkbox" name="ids[]" value="{{$ar->id}}"> {{ $ar->name }}
                  @if ($ar->special == 'all-access')
                    <i class="fa fa-star text-success"></i>
                  @elseif ($ar->special == 'no-access')
                    <i class="fa fa-ban text-danger"></i>
                  @endif
                </label>
              </div>
            @endforeach
          @empty
            <span class="text-danger"><i class="fa fa-warning text-danger"></i> There aren't any available roles.</span>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="small-3 columns">
      {!! Form::submit('Update Roles', ['class' => 'button']) !!}
    </div>
    <div class="small-3 columns">
      <button class="button float-right" type="button" data-toggle="collapse" data-target="#collapsePermissions" aria-expanded="false" aria-controls="collapsePermissions">
        Toggle Permissions
      </button>
    </div>
  </div>

  {!! Form::close() !!}

  <div class="row panel-collapse collapse" id="collapsePermissions">
    <div class="small-10 columns">
      <div class="panel panel-info">
        <div class="panel-heading clearfix">
          <h2 class="panel-title"><i class="fa fa-key"></i> {{$user->login}}'s Permissions <small>(from current roles)</small></h2>
        </div>

        <div class="panel-body">
          <ul class="list-unstyled">
            @forelse($roles as $prole)
              <li><strong>{{$prole->name}}</strong></li>
              <ul>
                @if ($prole->special == 'all-access')
                  <li><i class="fa fa-fw fa-star text-success"></i> All Access</li>
                @elseif ($prole->special == 'no-access')
                  <li><i class="fa fa-fw fa-ban text-danger"></i> No Access</li>
                @else
                  @forelse($prole->permissions as $p)
                    <li>{{$p->name}} <em>({{ $p->slug }})</em></li>
                  @empty
                    <li>This role has no defined permissions</li>
                  @endforelse
                @endif
              </ul>
            @empty
              <span class="text-danger"><i class="fa fa-warning text-danger"></i> There are no permissions defined for this user.</span>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>

@endsection