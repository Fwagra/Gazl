@foreach($categories as $category)
<li class="list-group-item" data-id="{{ $category->id }}"><i>grab</i> {{ $category->name }}</li>
@endforeach