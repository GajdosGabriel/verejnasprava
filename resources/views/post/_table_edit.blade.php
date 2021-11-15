<ul>
    @foreach ($organization->posts->where('contact_id', $post->contact->id)->take(25) as $post)
        <li class="hover:bg-gray-50 py-1 px-2

        @if(str_contains(url()->current(), $post->id))
        text-red-500 bg-gray-200
        @endif
        ">
            <a href="{{ route('posts.edit', $post->id) }}">
                <div class="flex justify-between">
                    <div>{{ $post->date_in->format('d. m. Y') }}<div class="ml-4 text-gray-500 text-sm">{{ $post->name }}</div></div>
                    <span>{{ $post->price }}</span>
                </div>
            </a>
        </li>
    @endforeach
</ul>
