<ul>
    @foreach($items as $item)
        <li>{{ $item }}</li>
    @endforeach
</ul>
@if(count($items))
 <p>There are {{ count($items) }} items !</p>
@else
 <p>There is no item !</p>
@endif
@forelse($items as $item)
 <p>The item is {{ $item }}</p>
@empty
 <p>There is no item !</p>
@endforelse