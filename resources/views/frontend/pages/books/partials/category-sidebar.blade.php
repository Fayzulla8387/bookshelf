<div class="list-group mt-3">
  @foreach (App\Category::all() as $cat)
    <a href="{{ route('categories.show', $cat->slug) }}" class="list-group-item list-group-item-action">
    {{ $cat->name }}
  </a>
  @endforeach
</div>