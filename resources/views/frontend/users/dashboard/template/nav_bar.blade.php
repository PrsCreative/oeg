<li class="nav-item">
    <a href="{{ $route_url }}"
       class="{{ in_array(request()->route()->getName(),$route_name_to_active)  ? 'active' : '' }}" >
        {{ $label }}
    </a>
</li>
