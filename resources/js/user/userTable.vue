<template>
    <table class="table-auto w-full">
    <thead class="bg-gray-300">
        <tr>
            <th class="px-4 py-2">Meno</th>
            <th class="px-4 py-2">Pracovné zaradenie</th>
            <th class="px-4 py-2">Zastupiteľstvo</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Role</th>
            <th class="px-4 py-2">Nálepka</th>
            <th class="px-4 py-2">Panel</th>

        </tr>
    </thead>
    <tbody>

            <tr>
                <td class="border px-4 py-2">
                    <a href=""><strong v-text="user.full_name"></strong></a>
                </td>
                <td class="border px-4 py-2" v-text="user.employment"></td>
                <td class="border px-4 py-2">
                    <!-- @foreach ($user->councils as $role)
                        <span class="badge badge-secondary">{{ $role->name }}</span>
                    @endforeach -->
                </td>
                <!-- @role('admin') -->
                <td class="border px-4 py-2" v-text="user.email"></td>
                <td class="border px-4 py-2">
                    <!-- @if ($user->email_verified_at)
                        <span class="badge badge-primary">Aktívny</span>
                    @else
                        <a href="{{ route('user.invitation', [$user->id, $user->slug]) }}">
                            @if ($user->send_invitation == null)
                                <span class="badge badge-primary" title="Poslať pozvánku">Poslať pozvánku</span>
                            @else
                                <span class="badge badge-primary" title="Pozvánka poslaná dňa">Pozvaný:
                                    {{ $user->send_invitation->diffForHumans() }}</span>
                            @endif
                        </a>
                    @endif -->
                </td>
                <td class="border px-4 py-2">
                    <!-- @foreach ($user->roles as $role)
                        <span class="badge badge-secondary">{{ $role->name }}</span>
                    @endforeach -->
                </td>
                <td class="border px-4 py-2">
                    <!-- @foreach ($user->tags as $tag)
                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                    @endforeach -->
                </td>

                <td class="border px-4 py-2">
                    ...
                </td>
                <!-- @endrole -->
            </tr>
    </tbody>
</table>
</template>
<script>
export default {

    data(){
        return {
            users: []
        }
    },

    methods:{
        getUsers(){

        }
    },
    created(){
        this.getUsers()
    }

}
</script>


