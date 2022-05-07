


    <table class="table-auto w-full mb-5">
        <thead class="bg-gray-600 text-gray-100">
        <tr>
            <th class="px-4 py-2">Organizácia</th>
            <th class="px-4 py-2">Popis</th>
            <th class="px-4 py-2">Kategória</th>
            <th class="px-4 py-2">Dodávateľ</th>
            <th class="px-4 py-2">Suma</th>
            <th class="px-4 py-2">Súbor</th>
            <th class="px-4 py-2">Dátum</th>
        </tr>
        </thead>
        <tbody>

        @forelse($posts as $key => $value)
            <tr class="hover:bg-gray-100 cursor-pointer  border-2 border-gray-500">
                <td colspan="7" class="border px-4 bg-gray-300 border-gray-700 py-3 flex-wrap justify-between"
                    @click="isOpen = ! isOpen">
                    <span> {{ $key }}</span>
                    <span class="up-Arrow" v-if="isOpen">&#9650;</span>
                    <span class="down-Arrow" v-else>&#9660;</span>
                </td>
            </tr>
            @forelse($value as $post)
                <tr class="hover:bg-gray-100 border-2 border-gray-500" v-show="isOpen">
                    <td class="border px-4 "><a
                            href="{{ route('publishedPosts', [$post->organization->id, $post->organization->slug]) }}">{{ $post->organization->name}}</a>
                    </td>
                    <td class="border px-4">{{ $post->name }}</td>
                    <td class="border px-4">
                        @if($post->category->id === 1)
                            <img class="" style="height: 23px" src="{{ asset('image/f.gif')  }}" title="Faktúra">
                        @elseif($post->category->id === 2)
                            <img class="" style="height: 23px" src="{{ asset('image/o.gif')  }}" title="Objednávka">
                        @elseif($post->category->id === 3)
                            <img class="" style="height: 23px" src="{{ asset('image/z.gif')  }}" title="Zmlúva">
                        @else($post->category->id === 4)
                            <img class="" style="height: 23px" src="{{ asset('image/v.gif')  }}"
                                 title="Všeobecno-záväzné nariadenie">
                        @endif
                    </td>
                    <td class="border px-4">
                        <strong>{{ $post->contact->name }}</strong><br> {{ $post->contact->city }},
                        <small>ico:{{ $post->contact->ico }}</small></td>
                    <td class="border px-4"><strong>{{ $post->DisplayPrice }} €</strong></td>
                    <td class="border px-4">
                        @forelse($post->files as $file)
                            <a target="_blank" href="{{ URL::to('/')}}/download/{{  $file->name }}">Príloha</a>
                        @empty
                            Bez prílohy
                        @endforelse
                    </td>
                    <td class="border px-4">{{ $post->date_in->format('d. m. Y') }}</td>
                </tr>
            @empty
                Bez záznamu
            @endforelse
        @empty
            <p>Bez záznamu</p>
        @endforelse
        </tbody>
    </table>


