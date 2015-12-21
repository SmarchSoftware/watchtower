@extends('watchtower::layouts.master')

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
        @foreach ($chunk as $link)
            <div class="col-lg-3 col-md-6" title="{{ $link['name'] }}">
                <div class="panel panel-{{ $link['colour'] }}">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <i class="{{ $link['icon'] }}"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route($link['route']) }}">
                        <div class="panel-footer">
                            <span class="pull-left">{{ $link['name'] }}</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
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