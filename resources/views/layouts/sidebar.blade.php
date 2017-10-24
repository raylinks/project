 <div class="sidebar_top_list">
     <ul>
       @foreach($tags as $tag)
                <li>
                <a href="{{ url('/posts/tags') .'/'. $tag }}">
                {{ $tag }}
                </a>
                </li>
                @endforeach
              
    </ul>
</div>

