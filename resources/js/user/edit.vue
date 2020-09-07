<template>

<!--    <div class="md:w-1/2 hover:bg-gray-200 p-2 rounded-sm  cursor-pointer" @click="toggle">-->

<!--        <div class="flex justify-between items-center">-->
<!--            <h3 class="fill-current text-lg">Osobné údaje</h3>-->
<!--            <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">-->
<!--                <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>-->
<!--            </svg>-->

<!--            <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">-->
<!--                <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>-->
<!--            </svg>-->

<!--        </div>-->

<!--        <div v-if="show">-->

<!--            <form method="POST" @submit.prevent>-->
<!--                &lt;!&ndash;Form First name&ndash;&gt;-->
<!--                <div class="form-group">-->
<!--                    <label for="first_name" class="input-label">Meno</label>-->

<!--                    <div class="col-md-8">-->
<!--                        <input id="first_name" type="text" class="input-control is-invalid" name="first_name"-->
<!--                               v-model="user.first_name" required autocomplete="name">-->

<!--                        &lt;!&ndash;                @error('first_name')&ndash;&gt;-->
<!--                        &lt;!&ndash;                <span class="invalid-feedback" role="alert">&ndash;&gt;-->
<!--                        &lt;!&ndash;                                    <strong>{{ $message }}</strong>&ndash;&gt;-->
<!--                        &lt;!&ndash;                                </span>&ndash;&gt;-->
<!--                        &lt;!&ndash;                @enderror&ndash;&gt;-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash;Form First name&ndash;&gt;-->
<!--                <div class="form-group">-->
<!--                    <label for="last_name" class="input-label">Priezvisko</label>-->

<!--                    <div class="col-md-8">-->
<!--                        <input id="last_name" type="text" class="input-control is-invalid"-->
<!--                               name="last_name" v-model="user.last_name" required autocomplete="last_name">-->

<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash;Form Email&ndash;&gt;-->
<!--                <div class="form-group">-->
<!--                    <label for="email" class="input-label">Email</label>-->

<!--                    <div class="col-md-8">-->
<!--                        <input id="email" type="email" class="input-control is-invalid" name="email"-->
<!--                               v-model="user.email" required autocomplete="email">-->

<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash;  Save button&ndash;&gt;-->
<!--                <div class="mt-5">-->
<!--                    <button type="submit" class="w-full btn btn-primary" @click="save">Uložiť</button>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->

</template>

<script>
    export default {
        data: function () {
            return {
                show: false,
                form: this.user
            }
        },
        methods: {
            toggle: function () {
                this.show = !this.show
            },

            save: function () {
                axios.patch('/user/'+ this.form.id + '/', this.form);
            }
        }
    }
</script>
