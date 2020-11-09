<template>
    <div class="p-3 w-full sm:flex">
        <div class="sm:mx-3 border-gray-300 border-2 p-4 md:w-8/12 xs:w-full">
            <div class="w-full">

                <h1 class="text-lg page-title"> {{ item.name }}</h1>

               <span class="text-sm text-gray-500">Návrh uznesenia vypracoval: {{ user.first_name }} {{ user.last_name }}, {{ user.employment }}</span>
                <!--   Badge line-->
                <div class="flex justify-between mt-3 mb-5 py-1 border-gray-200 border-t-2 border-b-2 items-center">
                    <div class="flex flex-wrap items-center space-x-3">

                        <div v-text="item.vote_type == 0 ? 'Hlasovanie verejné' :'Hlasovanie tajné' " class="badge badge-primary"></div>

                        <published-button :item="item"></published-button>

                        <div
                            class="p-1 text-center whitespace-no-wrap flex-1 bg-gray-100 cursor-pointer1 whitespace-no-wrap cursor-pointer"
                            @click="openInterpellation"
                        >
                            <span class="text-gray-700 text-sm rounded-md">Rozprava {{ item.interpellations.length }}</span>
                            <!--                            Rozprava <span class="text-gray-500">{{ item.interpellations.length }}</span>-->
                        </div>

                    </div>

                    <nav-drop-down v-if="item.user_id == user.id  || $auth.can('council delete')">
                        <slot>
                            <!-- Item Edit button-->
                            <div class="py-1">
                                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                                   :href="'/items/'+ item.id + '/edit'"
                                   title="Upraviť bod programu">
                                    <div class="flex">
                                        <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/>
                                        </svg>
                                        Upraviť položku
                                    </div>
                                </a>

                            </div>

                            <!--  Poslať všetkým notifikáciu -->
                            <a class="whitespace-no-wrap block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                               href="#"
                               title="Notifikácia pre voliteľov">
                                <div class="flex" @click="saveNotification">
                                    <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
                                    </svg>
                                    <span v-text="notificationStatus"></span>
                                </div>
                            </a>


                            <!-- Item Delete button-->
                            <div @click="itemDelete(item)" class="cursor-pointer block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                               title="Zmazať položku">
                                <div class="flex">
                                    <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                                    </svg>
                                    Zmazať
                                </div>
                            </div>
                        </slot>
                    </nav-drop-down>

                </div>

                <!--  Votes Buttons-->
                <vote-form-button :item="item"></vote-form-button>

                <!--  Body text-->
                <div class="py-3">
                    <p v-html="item.description"></p>
                    <!--  File-->
                    <h5 class="mt-4" style="border-bottom: 2px solid silver">Príloha</h5>
                    <div v-for="(file, index) in item.files" :key="file.id">
                        <a class="mr-2 hover:text-blue-500 " target="_blank" :title="file.org_name"
                           :href="'/pdf/'+ file.id + '/' + file.filename +'/download/pdf'">
                            {{ index +1 }}. Príloha
                        </a>
                    </div>
                </div>
            </div>


        </div>

        <!--  Aside part-->
        <div class="border-gray-300 border-2 sm:mx-3 p-4 flex flex-col md:w-4/12">

            <vote-start-button :item="item"></vote-start-button>

            <!--            &lt;!&ndash;Vote results Variant I.&ndash;&gt;-->
            <!--            <ul class="mb-10 border-2 border-gray-500 rounded-md shadow-md w-full">-->
            <!--                <li class="flex justify-between px-3 font-semibold text-gray-200 bg-gray-800 border-b-2"><span>Hlasovalo:</span>-->
            <!--&lt;!&ndash;                    <span>{{ item.votes.length }}</span>&ndash;&gt;-->
            <!--                </li>-->
            <!--                <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted"><span>Za:</span>-->
            <!--                    <span>{{ resultYes }}</span>-->
            <!--                </li>-->

            <!--                <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted"><span>Proti:</span>-->
            <!--                    <span>{{ resultNo }}</span>-->
            <!--                </li>-->

            <!--                <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted"><span>Zdržal:</span>-->
            <!--                    <span>{{ resultDisition }}</span>-->
            <!--                </li>-->
            <!--            </ul>-->

            <!-- Výsledky hlasovania-->

            <interpellation :item="item"></interpellation>

            <div class="">
                <h2 v-if="votes.length > 0" class="my-5 text-lg font-semibold whitespace-no-wrap">Výsledky hlasovania</h2>
                <ul class="">
                    <li v-for="vote in item.votes" class="flex justify-between border-b-2 border-dotted">
                        {{ vote.user.first_name }}
                        <div v-if="item.vote_type == 0">
                            <span v-if="vote.vote == 1" class="font-semibold">Áno</span>
                            <span v-if="vote.vote == 0" class="font-semibold">Nie</span>
                            <span v-if="vote.vote == 2" class="font-semibold">Zdržal</span>
                        </div>
                        <span v-else class="font-semibold">Hlasoval</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>
    import {mapState} from "vuex";
    import moment from "moment";
    import publishedButton from "./publishedButton";
    import interpellation from "./InterpellationCard";
    import navDropDown from "../modules/navigation/navDropDown";
    import {bus} from "../app";

    export default {
        props: ['pitem'],
        components: {publishedButton, interpellation},
        computed: {
            resultYes() {
                return this.$store.getters['items/resultYes'];
            },
            resultNo() {
                // return this.item.votes.filter(i => i.vote == 0).length
            },
            resultDisition() {
                // return this.item.votes.filter(i => i.vote == 2).length
            },

            notificationStatus() {
                return this.item.notification == null ? 'Notifikácia hlasovať' : moment(this.item.notification).format('DD. MM. YYYY, k:mm');
            },

            ...mapState({
                item: state => state.items.item,
                user: state => state.items.user,
                votes: state => state.items.votes,
            }),
        },
        created: function () {
            this.$store.dispatch('items/getItem', this.pitem.id)
        },
        methods: {
            itemDelete(item){
                axios.delete('/items/' + item.id)
                .then(window.location.reload())
            },
            saveNotification() {
                this.$store.dispatch('items/update', {
                    notification: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    id: this.item.id
                })
            },

            openInterpellation() {
                console.log(this.item.votes.length);
                bus.$emit('imterpellationlist', this.item);
            }
        }

    }
</script>
