@extends(config('watchtower.views.layouts.master'))

@section('content')

  @if ( \Shinobi::can( config('watchtower.acl.watchtower.index', false) ) )

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ $title }} <small>Dashboard</small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    @foreach ( array_chunk($dashboard, 4) as $chunk )
        <div class="row text-center">
        @foreach ($chunk as $item)
            @include( config('watchtower.views.layouts.adminlinks'), [ 'item' => $item ] )
        @endforeach
    </div>
    <!-- /.row -->
    @endforeach

  @else

    <div class="alert alert-danger lead">
      <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to view the dashboard.
    </div>

  @endif

@endsection