<template>
    <form @submit.prevent="saveComment" class="flex text-xs">
        <input type="text" required v-model="body" class="w-full p-2  border-2" placeholder="Nová správa">
        <button type="submit" class="bg-gray-600 text-gray-200 px-2 rounded-r-sm">Poslať</button>
    </form>
</template>
<script>
    export default {
        props: ['task'],
        data(){
            return {
                body: null
            }
        },

        methods:{
            saveComment(){
                axios.post('tasks/' + this.task.id + '/comments', {
                    user_id: this.user.id,
                    body: this.body,
                })
                .then( response => {
                    this.body = null;
                    this.$store.dispatch('tasks/getTasks', {root: true});
                })

            }
        }

    }
</script>
