<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                       <p @click="toggle"> I'm an example component.</p>
                        <p v-show="show">dsfasdfsa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
               action:'fasdasdf',
                show: true

            }
        },

        methods: {
            toggle: function(){
                this.show = !this.show;
            }


        }



    }
</script>
