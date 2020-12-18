<template>

    <form @submit.prevent="save" class="my-3">
        <label for="tag" class="input-label">Nová skupina</label>

        <div class="mb-4">
            <input id="tag" type="text" class="input-control focus:outline-none focus:shadow-outline @error('tag') is-invalid @enderror" v-model="form.name"
                   required autocomplete="name" placeholder="Nová skupina" autofocus>
        </div>

        <section class="flex flex-wrap mb-4">
            <div v-for="tag in tags" :key="tag.id">
                <div class="bg-green-200 hover:bg-green-400 px-2 rounded-md m-1 cursor-pointer mr-2">
                    {{ tag.name }}
                </div>
            </div>
        </section>

        <button type="submit" class="btn btn-primary">Uložiť</button>

    </form>


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
            }
        }
    }
</script>
