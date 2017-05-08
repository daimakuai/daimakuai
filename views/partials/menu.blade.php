@if(Admin::user()->visible($item['roles']))
    @if(!isset($item['children']))
        <li>
            <a href="javascript:void(0)" onclick="addTabs({id:'{{$item['id']}}',title: '{{$item['title']}}',close: true,url: '{{ Admin::url($item['uri']) }}' ,urlType:''});"><i class="fa {{$item['icon']}}" ></i>
                <span>{{$item['title']}}</span>
            </a>
        </li>
    @else
        <li class="treeview">
            <a href="#">
                <i class="fa {{$item['icon']}}"></i>
                <span>{{$item['title']}}</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                @foreach($item['children'] as $item)
                    @include('admin::partials.menu', $item)
                @endforeach
            </ul>
        </li>
    @endif
@endif