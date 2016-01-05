    @if ( Shinobi::can( config('watchtower.acl.'.$acl.'.search', false)) )
    <!-- search bar -->    
    {!! Form::open(['method'=>'get','route'=> [ $search_route ], 'style' => 'display:inline']) !!}
    <div class="input-group">
      <input type="search" class="form-control input-sm" name="search_value" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-fw fa-search"></i></button>
      </span>
    </div>
    <div class="text-muted">
      <em>Found {{ $items->total() }} {{ str_plural('record', $items->count() ) }}.
      @if (session()->has('search_value'))
        Filter : "{{ session('search_value') }}" <a href="{{ route( $search_route ) }}">[ Clear Filter ]</a>
      @endif
      </em>
    </div>
    {!! Form::close() !!}
    @endif