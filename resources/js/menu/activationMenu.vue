<template>
    <div class="max-w-sm border-b-2" >
        <div @click="toggle" class="flex justify-between items-center hover:bg-gray-100 cursor-pointer py-2">
            <h2 class="text-lg">Aktivácia modulov</h2>
            <span class="cursor-pointer">
                 <div class="h-6 w-6 text-xs bg-red-700 text-white rounded-full flex items-center justify-center">
                     <div>{{ active.length }}/{{ menus.length }}</div>
                 </div>
            </span>
        </div>
        <transition-group name="fade">
            <div v-for="menu in menus" :key="menu.id" v-if="isOpen">
                <div class="flex mb-5 max-w-sm  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                        </svg>
                    </div>
                    <div class="md:flex w-full justify-between items-center">
                        <div class="md:font-bold">Modul: {{ menu.name }}</div>
                        <button class="px-2 py-1 bg-gray-700 text-white rounded-lg ml-4 hover:text-gray-200 text-sm"
                                :class="{'bg-red-700 font-semibold': active.find(o => o.id == menu.id)}"
                                @click="saveModul(menu.id)">
                            {{ active.find(o => o.id == menu.id) ? 'Aktivne' : 'Aktivovať' }}

                        </button>
                    </div>
                </div>
            </div>
        </transition-group>

    </div>
</template>

<script>
    import {bus} from '../app';
    import {mapState} from "vuex";

    export default {

        data: function () {
            return {
                isOpen: false,
            }
        },
        computed:{
            ...mapState('organization', ['organization', 'menus', 'active']),
        },
        created: function () {
            this.$store.dispatch('organization/getOrganization', '/api/menus/' + this.user.active_organization);
        },
        methods: {

            saveModul(id) {
                axios.put('/api/menus/' + this.user.active_organization, {modul: id})
                    .then((response) => {
                        // window.location.reload();
                        // bus.$emit('reloadMenu');
                        // this.getIndex();
                        this.$store.dispatch('organization/getOrganization', '/api/menus/' + this.user.active_organization);
                    })
            },

            toggle() {
                this.isOpen = !this.isOpen
            }
        }

    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
