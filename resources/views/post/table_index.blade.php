<table class="table-auto table-bordered text-sm">
    <thead>
    <tr class="bg-gray-300">
        <th class="px-4 py-2">Dátum</th>
        <th class="px-4 py-2">Popis</th>
        <th class="px-4 py-2">Kategória</th>
        <th class="px-4 py-2">Dodávateľ</th>
        <th class="px-4 py-2">Cena spolu</th>
        <th class="px-4 py-2">Súbor</th>
        <th class="px-4 py-2">Int. číslo</th>
        <th class="px-4 py-2">Panel</th>
    </tr>
    </thead>
    <tbody>
    @forelse($posts as $post)
        <tr class="hover:bg-gray-100">
            <td class="border px-4 py-2 whitespace-no-wrap">{{ $post->date_in->format('d. m. Y') }}</td>
            <td class="border px-4 py-2">{{ $post->name }}</td>
            <td class="border px-4 py-2">{{ $post->category->name }}</td>
            <td class="border px-4 py-2">{{ $post->contact->name }}</td>
            <td class="border px-4 py-2 whitespace-no-wrap">{{ number_format($post->price, 2, ',', ' ') }} Eu</td>
            <td class="border px-4 py-2">
                @forelse($post->files as $file)
                    <a target="_blank"
                       href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}.Príloha</a>
                @empty
                    Bez prílohy
            @endforelse

            <td class="border px-4 py-2"> {{ $post->int_number }}</td>

            {{--@can( 'update', $post)--}}
            <td class="border px-4 py-2">
                <nav-drop-down inline-template>
                    <div class="relative flex items-start">
                        <a @click="isOpen =! isOpen" class="" href="#">
                            <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                            </svg>
                        </a>

                        <div v-if="isOpen"
                             class="absolute z-10 py-1 flex flex-col border-2 border-gray-300 shadow-md rounded text-sm bg-white">

                            {{-- Item Up button--}}
                            <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap"
                               href="{{ route('post.edit', $post->id) }}" title="Upraviť položku">
                                Upraviť položku
                            </a>

                            {{-- Item Down button--}}
                            <a class="hover:bg-gray-200 px-4 py-1 flex-1" href="{{ route('post.copy', $post->id) }}"
                               title="Kopírovať položku">
                                Kopírovať
                            </a>

                            <div class="dropdown-divider"></div>
                            {{-- Item Delete button--}}
                            <a class="hover:bg-gray-200 px-4 py-1 flex-1" href="{{ route('post.delete', $post->id) }}"
                               onclick="get_form(this).submit(); return false"
                               title="Vymazať položku">
                                Zmazať
                            </a>

                        </div>

                    </div>
                </nav-drop-down>

            </td>
            {{--@endcan--}}
        </tr>
    @empty
        {{--<tbody><tr><td>Žiadne doklady</td></tr></tbody>--}}
    @endforelse

    </tbody>
</table>



