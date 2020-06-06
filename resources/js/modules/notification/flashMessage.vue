<template>
    <transition name="fade">
    <div v-if="banner" class="absolute bottom-0 right-0 mb-5 mr-4 max-w-sm bg-teal-100 border-2 border-teal-500 rounded-md text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex items-center">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
<!--            <div>-->
                <p class="font-bold"> {{ body }}</p>
<!--                <p class="text-sm">{{ body }}</p>-->
<!--            </div>-->
        </div>
    </div>
        </transition>
</template>

<script>
    // import {bus} from '../app';
    export default {
        props: ['message'],
        data: function() {
            return {
                banner: false,
                body: '',
                type: false
            }
        },
        created: function() {
            // bus.$on('flash', (data) => {
            //     this.showNotify(data);
            // });

            if(this.message) {
                this.body = this.message;
                this.banner = true;
                this.hide();
            }

        },

        computed: {
            addClass: function() {
                return ['level', this.type ? 'danger' : 'success'];
            }
        },

        methods: {
            showNotify: function(data) {

                this.body = data.body;
                this.type = data.type;
                this.banner = true;

                this.hide();
            },

            hide: function() {
                setTimeout(() => {
                    this.banner= false;
                }, 6000);
            }
        }
    }
</script>

<style scoped>
    .success {
        z-index: 999;
        position: fixed;
        font-size: 111%;
        color: whitesmoke;
        right: 25px;
        bottom: 4rem;
        background: #53994f;
        padding: 1.3rem;
        border: .1rem solid #335530;
        border-radius: .7rem;
    }
    .danger {
        z-index: 999;
        position: fixed;
        font-size: 111%;
        color: whitesmoke;
        right: 25px;
        bottom: 4rem;
        background: #ff9393;
        padding: 1.3rem;
        border: .1rem solid #4d4d4d;
        border-radius: .7rem;
    }

    i {
        margin-right: 1.5rem;
    }


    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
