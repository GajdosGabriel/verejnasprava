<template>

    <div class="border-2 border-gray-700 w-1/2 p-2">
        <h2 class="text-lg font-semibold mb-2">Výsledky hlasovania</h2>

        <ul>
            <!-- Hlas Za-->
            <li class="flex justify-between border-b-2 border-dotted">
                {{ vote.user.first_name + ' ' +vote.user.last_name}}
                <span class="font-semibold">{{ voteType }}</span>
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
