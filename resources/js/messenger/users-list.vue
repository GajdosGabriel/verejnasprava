<template>
    <section class="p-2 relative cursor-pointer">
<!--        <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">-->
<!--            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>-->
<!--        </svg>-->
        <div v-if="showUsers">
            <div class="font-semibold">Všetci užívatelia</div>
            <div class="flex">
                <div v-for="user in users" :key="user.id" class="flex items-center">
                    <div @click="addRecipient(user)" class="border-2 px-1 hover:bg-gray-200"
                    :class="greenBackground(user.id)"
                    >
                    {{ user.first_name }} {{ user.last_name }}
                    </div>
                </div>
            </div>

<!--            <button class="px-2 py-1 mt-4 bg-blue-500 rounded-sm absolute bottom-0 right-0 text-sm text-white">Uložiť výber</button>-->
        </div>
    </section>
</template>

<script>
    export default {
        props:['showUsers', 'users', 'recipients'],
        methods: {
            addRecipient(user){
                this.$emit('addRecipient', user)

            },
            greenBackground(id){
                if(this.recipients.find(user => user.id == id)) {
                    return 'bg-green-300'
                }
            }

        }

    }
</script>
