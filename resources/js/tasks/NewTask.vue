<template>
    <section v-if="dialog" class="bg-gray-200 p-2">
        <form @submit.prevent="saveTask">

            <div class="flex justify-between">
                <label for="cars">Nová požiadavka</label>
                <select v-model="formData.requested_id" required id="cars" class="text-xs my-1">
                    <option value="">Vybrať</option>
                    <option :value="user.id" v-for="user in users" :key="user.id">{{ user.last_name}} {{ user.first_name}}
                        <span v-if="user.employment">- {{ user.employment | shortEmployment}}</span>
                    </option>
                </select>
                <span class="text-xs text-gray-500 cursor-pointer hover:text-gray-800" @click="dialog = false">Zavrieť</span>
            </div>

            <input type="text" v-model="formData.name" required placeholder="Nadpis požiadavky" class="text-xs w-full mb-3 border px-2 py-1">

            <textarea v-model="formData.body" class="w-full mb-3 border text-sm p-2"></textarea>

            <div class="flex w-full mb-4 text-xs">
                <div class="mr-5">
                    <label for="start" class="mr-3">Do:</label>
                    <input type="date" id="start" name="trip-start"
                           v-model="formData.due_date"
                           min="formData.date" max="">
                </div>

                <div v-if="formData.due_date">
                    <label for="time" class="mr-3">Čas:</label>
                    <input type="time" id="time" name="appt"
                           v-model="formData.due_time"
                    >
                </div>
            </div>

            <button type="submit" class="p-2 bg-green-300 w-full rounded-md hover:bg-green-400">Uložiť</button>
        </form>
    </section>

</template>
<script>
    import {mapActions} from 'vuex';

    export default {
        props: ['users'],
        data() {
            return {
                dialog: true,
                formData: {
                    name: '',
                    body: '',
                    due_date: '',
                    due_time: '',
                    organization_id: this.user.active_organization,
                    requested_id: ''
                }
            }
        },
        methods: {
            ...mapActions('tasks', ['storeTask']),

            saveTask() {
                this.storeTask(this.formData);
                this.formData = {};
                this.dialog = false;
            }

        },

        filters: {
            shortEmployment(value) {
                return value.slice(0, 8)
            }
        }

    }
</script>
