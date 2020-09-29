<template>

    <div class="border-2 rounded-md border-gray-300 my-5 max-w-sm">
        <div class="flex justify-between mb-3 bg-gray-300 p-1">
            <h4 class="font-semibold text-gray-800">Výsledky hlasovania</h4>
        </div>

        <ul>
            <!-- Hlas Za-->
            <li class="flex justify-between border-b-2 border-dotted">
                {{ vote.user.first_name + ' ' +vote.user.last_name}}
                <span class="font-medium">{{ voteType }}</span>
            </li>
        </ul>
    </div>

</template>

<script>
    export default {
        props:['vote'],

        computed:{
            voteType: function () {
                if(this.vote.vote == 2) {
                    return 'Zdržal'
                }

                if(this.vote.vote == 1) {
                    return 'ANO'
                }

                if(this.vote.vote == 0) {
                    return 'NIE'
                }
            }
        }

    }
</script>
