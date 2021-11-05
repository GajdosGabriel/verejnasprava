<template>
    <div>
        <div class="flex items-center">
            <div class="flex border-2 rounded">
                <input
                    type="text"
                    class="px-3 py-1 w-50"
                    v-model="search"
                    @keyup="emitForm($event.target.value)"
                    placeholder="hľadať v popise"
                />
                <button
                    class="flex items-center justify-center px-4 border-l"
                    v-if="search != ''"
                     @click="clearForm"
                >
                    X
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            search: ""
        };
    },
    methods: {
        emitForm(val) {
            this.$emit("emitForm", val);
        },

        clearForm() {
            this.$emit("emitForm", (this.search = ""));
        }
    }
};
</script>
