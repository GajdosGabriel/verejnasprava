<template>
    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-900"></div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0"
                    >
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center mb-3">
                                <h6 class="text-gray-600 text-sm font-bold">
                                    Prihlásenie cez
                                </h6>
                            </div>
                            <div class="btn-wrapper text-center">
                                <a
                                    href="/auth/facebook"
                                    class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                                    >Login cez Facebook</a
                                >
                            </div>
                            <hr class="mt-6 border-b-1 border-gray-400" />
                        </div>

                        <form @submit.prevent="loginHandle">
                            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                <div
                                    class="text-gray-500 text-center mb-3 font-bold"
                                >
                                    <small>Prihlásenie cez údaje</small>
                                </div>

                                <div class="relative w-full mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        for="grid-password"
                                        >Email</label
                                    >
                                    <input
                                        type="email"
                                        required
                                        name="email"
                                        v-model="formLogin.email"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                                        placeholder="Email"
                                        style="transition: all 0.15s ease 0s;"
                                    />
                                </div>
                                <div class="relative w-full mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        for="grid-password"
                                        >Heslo</label
                                    >
                                    <input
                                        type="password"
                                        v-model="formLogin.password"
                                        required
                                        name="password"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                                        placeholder="Heslo"
                                        style="transition: all 0.15s ease 0s;"
                                    />
                                    <div class="text-red-600" v-if="errors.length">Prihlasovacie údaje nie sú správne.</div>
                                </div>
                                <div>
                                    <label
                                        class="inline-flex items-center cursor-pointer"
                                    >
                                        <input
                                            id="customCheckLogin"
                                            type="checkbox"
                                            checked
                                            class="form-checkbox text-gray-800 ml-1 w-5 h-5"
                                            style="transition: all 0.15s ease 0s;"
                                        /><span
                                            class="ml-2 text-sm font-semibold text-gray-700"
                                            >Zapamätať ma</span
                                        ></label
                                    >
                                </div>
                                <div class="text-center mt-6">
                                    <button
                                        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                                        type="submit"
                                        style="transition: all 0.15s ease 0s;"
                                    >
                                        Prihlásiť sa
                                    </button>
                                </div>

                                <div class="flex flex-wrap mt-6">
                                    <div class="w-1/2">
                                        <a
                                            href="/password/reset"
                                            class="text-gray-900"
                                            ><small>Zabudnuté heslo?</small></a
                                        >
                                    </div>
                                    <div class="w-1/2 text-right">
                                        <a
                                            href="/register"
                                            class="text-gray-900"
                                            ><small
                                                >Vytvoriť nový účet</small
                                            ></a
                                        >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            formLogin: {},
            errors: [],
            user: ""
        };
    },

    methods: {
        loginHandle() {
            axios
                .post("/login", this.formLogin)
                .then(response => {
                    this.getUser(), window.location.reload("organizations");
                })
                .catch(error => {
                   this.errors = error.response.data.errors.email;
                    console.log(error.response.data.errors.email);
                    // console.log(error.response.data.message || error.message);
                });
        },

        getUser() {
            axios.get("/api/user").then(response => {
                this.user = response.data;
            });
        }
    },

    created() {
        axios.get("/sanctum/csrf-cookie").then(response => {
            // Login...
        });
    }
};
</script>
