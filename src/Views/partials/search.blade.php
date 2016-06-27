@if ( Shinobi::can( config('watchtower.acl.'.$acl.'.search', false)) )
        <!-- search bar -->
{!! Form::open(['method'=>'get','route'=> [ $search_route ], 'style' => 'display:inline']) !!}
<div class="">
    <div class="small-9 columns">
        <div class="row collapse postfix-round">
            <div class="small-5 columns">
                <input type="search" class="watchtower-search-box" name="search_value" placeholder="Search for...">
            </div>
            <div class="small-2 columns">
                <button class="button postfix" type="submit"><i class="fa fa-fw fa-search">Search</i></button>
            </div>
        </div>
    </div>
</div>
<div class="text-muted">
    <p class="help-text" id="exampleHelpText">
        <em>Found {{ $items->total() }} {{ str_plural('record', $items->count() ) }}.
            @if (session()->has('search_value'))
                Filter : "{{ session('search_value') }}" <a href="{{ route( $search_route ) }}">[ Clear Filter ]</a>
            @endif
        </em>
    </p>
</div>
{!! Form::close() !!}
@endif