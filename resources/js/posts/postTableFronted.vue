import swal from "sweetalert2";
<template>
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
        <template v-for="(post, key, index) in posts">
            <tr class="hover:bg-gray-100 cursor-pointer  border-2 border-gray-500">
                <td colspan="7" class="border px-4 bg-gray-300 border-gray-700 py-3 flex-wrap"
                    @click="isOpen =! isOpen">
                    <span> {{  key }}</span>
                    <span class="up-Arrow" v-if="isOpen">&#9650;</span>
                    <span class="down-Arrow" v-else>&#9660;</span>
                </td>
            </tr>

            <tr v-for="item in post" class="hover:bg-gray-100 border-2 border-gray-500" v-show="isOpen">
                <td class="border px-4 whitespace-no-wrap">
                    <!--                             <a href="{{ route('publishedPosts', [$post->organization->id, $post->organization->slug]) }}">-->
                    {{ item.organization.name}}
                    <!--                </a>-->
                </td>
                <td class="border px-4">{{ item.name }}</td>
                <td class="border px-4">
                    <img v-if="item.category.id == 1" class="" style="height: 23px" :src="'image/f.gif'"
                         title="Faktúra">
                    <img v-if="item.category.id == 2" class="" style="height: 23px" :src="'image/o.gif'"
                         title="Objednávka">
                    <img v-if="item.category.id == 3" class="" style="height: 23px" :src="'image/z.gif'" title="Zmlúva">
                    <img v-if="item.category.id == 4" class="" style="height: 23px" :src="'image/v.gif'"
                         title="Všeobecno-záväzné nariadenie">
                </td>
                <td class="border px-4">
                    <strong>{{ item.contact.name }}</strong><br> {{ item.contact.city }},
                    <small>ico:{{ item.contact.ico }}</small></td>
                <td class="border px-4  whitespace-no-wrap font-semibold">{{ item.price }} Eu</td>
                <td class="border px-4">
                      <span v-if="item.files.length > 0">
                    <div v-for="file in item.files">
                        <a target="_blank" :href="'/pdf/' + file.id + '/' + file.filename + '/download/pdf'">Príloha</a>
                    </div>
                            </span>
                    <span v-else class="whitespace-no-wrap">Bez prílohy</span>
                </td>
                <td class="border px-4">{{ moment(item.date_in).format('L') }}</td>
            </tr>

        </template>
        </tbody>
    </table>
</template>
<script>
    // import moment from 'moment';

    export default {
        data() {
            return {
                isOpen: false,
                moment: require('moment'),
                posts: []
            }
        },
        methods: {},

        created() {
            axios.get('/api/posts/frontPosts').then(response => {
                this.posts = response.data;
            });
        }


    }
</script>

<style>

</style>
