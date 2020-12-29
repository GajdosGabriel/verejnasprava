<template>
    <div class="border">
        <header class="flex justify-between items-center px-2 py-2 cursor-pointer" @click="showCard =! showCard"
                :class="[showCard ? 'bg-gray-600 text-white' : 'hover:bg-gray-200']">
            <div class="flex items-center justify-center">
                <svg class="fill-current h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
                <h3 class="font-semibold cursor-pointer">Oznámenia zamestnávateľa</h3>
            </div>


            <svg v-if="showCard" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>
            </svg>

            <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>
            </svg>
        </header>

        <div class="flex flex-col px-2" v-if="showCard">
            <div class="md:flex justify-between py-0 px-1 hover:bg-gray-100" v-for="message in messengers" :key="message.id">
                <div class="cursor-pointer" @click="passMessage(message)">{{ message.name }}</div>
                <span v-if="message.pivot.opened == null" class="px-1 my-1 bg-red-500 text-xs text-white rounded-sm" title="Potvrdiť prijatie správy">Nepotvrdená</span>
            </div>
        </div>

        <show-modal :showModal="showModal" :message="message" @emitShowModal="showModal = false" @saveReading="saveReading"></show-modal>
    </div>
</template>

<script>


    import showModal from './show-modal'
    export default {
        components:{showModal},
        data() {
            return {
                showCard: true,
                showModal: false,
                messengers: [],
                message:{}
            }
        },
        created() {
            this.getMessengers();
        },
        methods: {
            passMessage (message){
                this.showModal = true;
                this.message = message
            },

            saveReading() {
                axios.put('/messengers/' + this.message.id, this.message)
                    .then(
                        (res) => {
                            console.log(res.data);
                            // this.messengers.push(res.data)
                            this.getMessengers()
                        },

                        this.showModal = false
                    );
            },
            getMessengers(){
                axios.get('/messengers/' + this.user.id)
                    .then((res) => {
                        this.messengers = res.data
                    })
            }
        }

    }
</script>
<style>
    @import "~vue2-editor/dist/vue2-editor.css";

    /* Import the Quill styles you want */
    @import '~quill/dist/quill.core.css';
    @import '~quill/dist/quill.bubble.css';
    @import '~quill/dist/quill.snow.css';
</style>
