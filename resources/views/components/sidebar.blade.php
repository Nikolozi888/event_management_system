<div class="d-flex flex-column flex-shrink-0 p-3 bg-light m-3" style="width: 280px;">
    <h5 class="mb-3">Categories</h5>
    <ul class="nav nav-pills flex-column mb-auto">
        <a href="{{ route('index') }}"
            class="nav-link {{ request()->is('/') ? 'active' : '' }}">
            Home
        </a>
        @foreach ($categories as $category)
            <li class="nav-item">
                <a href="{{ route('category.show', $category->slug) }}"
                    class="nav-link {{ request()->is('category/' . $category->slug) ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
