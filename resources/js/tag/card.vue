<template>
    <div class="border-gray-400 border-2">

        <header class="flex justify-between items-center cursor-pointer p-3"
                :class="[showCard ? 'bg-gray-700 text-white' : 'hover:bg-gray-200']"
                @click="toggle">

            <h3 class="fill-current text-lg">Skupiny tagy</h3>

            <svg v-if="showCard" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>
            </svg>

            <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>
            </svg>

        </header>
        <div v-if="showCard">
            <label for="tag" class="input-label px-3 mt-4 cursor-pointer" @click="showForm =! showForm">Pridať skupinu</label>
            <form v-if="showForm" @submit.prevent="save" class="p-3">


                <div class="mb-4">
                    <input id="tag" type="text" class="input-control focus:outline-none focus:shadow-outline @error('tag') is-invalid @enderror" v-model="form.name"
                           required autocomplete="name" placeholder="Nová skupina" autofocus>
                </div>

                <div v-if="! form.id == ''" class="flex justify-between ">
                    <button @click="updateTag" class="btn btn-primary">Aktualizovať</button>
                </div>

                <button v-else type="submit" class="btn btn-primary">Uložiť</button>

            </form>
            <tag-list class="flex mb-4"></tag-list>
        </div>

    </div>
</template>

<script>
    import tagList from "../messenger/tag-list";

    export default {
        components: {tagList},
        data: function () {
            return {
                showCard: false,
                showForm: false,
                tags: {},
                form: {},
            }
        },
        computed: {},

        methods: {
            toggle: function () {
                this.showCard = !this.showCard
            },

            edit(tag) {
                this.form = {name: tag.name, id: tag.id}
            },


            save: function () {
                axios.post('/tags', this.form)
                    .then((res) => {
                            this.tags.push(res.data)
                        },
                        this.form = {}
                    )
            },

            destroyTag: function (id) {
                console.log(id);
                axios.delete('/tags/' + id)
                    .then(
                        this.tags = this.tags.filter((e) => e.id !== id),
                        this.form = {}
                    )
            },

            updateTag: function () {
                axios.put('/tags/' + this.form.id, this.form)
                    .then(
                        (res) => {
                            console.log(res.data)
                        },
                        // this.tags.push({name: this.form.name, id: this.form.id}),
                        // this.tags.splice(this.form.id, 1, this.form.name),

                        this.form = {}
                    )
            }
        }
    }
</script>
