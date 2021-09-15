@forelse($postsForCopyTable as $key => $posts)
    <ul>
        @foreach ($posts as $post)
            <li class="hover:bg-gray-50">
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



