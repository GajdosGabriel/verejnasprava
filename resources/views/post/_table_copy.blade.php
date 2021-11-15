@forelse($postsForCopyTable as $key => $posts)
    <ul>
        @foreach ($posts as $post)
            <li class="hover:bg-gray-50 px-1 rounded-sm
            @if(str_contains(url()->current(), $post->id))
            text-red-500 bg-gray-200
            @endif
            ">
                <a href="{{ route('post.copy', $post->id) }}">
                    {{ $post->contact->name }}
                </a>
            </li>
            @break(1)
        @endforeach
    </ul>
@empty
    <p>Žiadne doklady</p>
@endforelse



