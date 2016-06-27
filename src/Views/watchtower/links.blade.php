
<div class="text-center large-3 columns" title="{{ $item['name'] }}" style="background-color: #ffecce;">
    <div class="panel panel-{{ $item['colour'] }}">
        <div class="panel-heading">
            <div class="row">
                <div >
                    <i class="{{ $item['icon'] }}"></i>
                </div>
            </div>
        </div>
        <a href="{{ route($item['route']) }}">
            <div class="panel-footer">
                <span class="pull-left">{{ $item['name'] }}</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>