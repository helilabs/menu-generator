<li class="{{ $isActive ? 'active' : '' }}">
	@if( !$hasChildren )
	    <a href="{{ url( $url ) }}">
	        {!! $icon !!}
	        <p>{{ $text }}</p>
	    </a>

    @else

		<a href="#" data-toggle="collapse" data-target="#{{ $key }}">
			{!! $icon !!}
	        <p>{{ $text }}</p>
	        <b class="caret"></b>
		</a>
		{!! $innerMenu !!}

    @endif
</li>