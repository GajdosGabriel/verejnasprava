<template>
    <section v-if="dialog" class="bg-gray-200 p-2">
        <div class="flex justify-between ">
            <label for="cars">Nová požiadavka</label>

            <select name="users" required id="cars" class="text-xs my-1">
                <option value="">--Vybrať--</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>
            <span class="text-xs text-gray-500 cursor-pointer hover:text-gray-800" @click="dialog = false">Zavrieť</span>
        </div>
    <form @submit.prevent="saveTask">
        <input type="text" v-model="formData.name" placeholder="Nadpis požiadavky" class="text-xs w-full mb-3 border px-2 py-1">
        <textarea v-model="formData.description" class="w-full mb-3 border text-sm p-2"></textarea>
        <button type="submit" class="p-2 bg-green-300 w-full rounded-md hover:bg-green-400">Uložiť</button>
    </form>
    </section>

</template>
<script>
    export default {
        data(){
            return {
                dialog: true,
                formData: {
                    name: '',
                    description: ''
                }
            }
        }

    }
</script>
