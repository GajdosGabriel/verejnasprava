<template>
    <form @submit.prevent="saveComment">
         <label for="comment" class="text-xs font-semibold">Dotaz</label>
        <div class="flex text-xs w-full">
            <input
                type="text"
                required
                v-model="body"
                class="w-full p-1 text-xs  border-2"
                placeholder="Nová správa"
                id="comment"
            />

            <button
                type="submit"
                class="bg-gray-600 text-gray-200 px-2 rounded-r-sm"
            >
                Poslať
            </button>
        </div>
    </form>
</template>
<script>
export default {
    props: ["task"],
    data() {
        return {
            body: null
        };
    },

    methods: {
        saveComment() {
            axios
                .post("tasks/" + this.task.id + "/comments", {
                    user_id: this.user.id,
                    body: this.body
                })
                .then(response => {
                    this.body = null;
                    this.$store.dispatch("tasks/getTasks", { root: true });
                });
        }
    }
};
</script>
