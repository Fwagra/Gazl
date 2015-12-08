@foreach ($categories as $category)
	{!! $category->name !!}
	@foreach ($category->points()->orderBy('order')->get() as $point)
		{!! $point->name !!}
	@endforeach
@endforeach