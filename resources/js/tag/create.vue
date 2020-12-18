<template>
    <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">

        <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200" @click="toggle">

            <h3 class="fill-current text-lg">Skupiny tagy</h3>

            <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>
            </svg>

            <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>
            </svg>

        </div>
        <form @submit.prevent="save" class="my-3" v-if="show">
            <label for="tag" class="input-label">Nová skupina</label>

            <div class="mb-4">
                <input id="tag" type="text" class="input-control focus:outline-none focus:shadow-outline @error('tag') is-invalid @enderror" v-model="form.name"
                       required autocomplete="name" placeholder="Nová skupina" autofocus>
            </div>

            <section class="flex flex-wrap mb-4">
                <div v-for="tag in tags" :key="tag.id">
                    <div v-text="tag.name" class="bg-green-200 hover:bg-green-400 px-2 rounded-md m-1 cursor-pointer mr-2" @click="edit(tag)">
                    </div>
                </div>
            </section>

            <button type="submit" class="btn btn-primary">Uložiť</button>
            <button v-if="! form.id == ''" @click="destroy" class="btn btn-danger">Zmazať</button>

        </form>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                tags: {},
                show: false,
                form: {}
            }
        },

        created() {
            this.getTags();
        },
        methods: {
            toggle: function () {
                this.show = !this.show
            },

            edit(tag) {
                this.form = {name: tag.name, id: tag.id}
            },
            getTags() {
                axios.get('/tags')
                    .then((response) => {
                        this.tags = response.data
                    })
            },

            save: function () {
                axios.post('/tags', this.form)
                    .then((res) => {
                            this.tags.push(res.data)
                        },
                        this.form = {}
                    )
            },

            destroy: function () {
                axios.delete('/tags/' + this.form.id)
                    .then(
                        this.tags = this.tags.filter((e) => e.id !== this.form.id),
                        this.form = {}
                    )
            }
        }
    }
</script>
