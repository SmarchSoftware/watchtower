@extends(config('watchtower.views.layouts.master'))

@section('content')

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

@endsection