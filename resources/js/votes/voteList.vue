<template>

    <div class="border-2 rounded-md border-gray-300 my-5 max-w-sm w-full">
        <div class="flex justify-between mb-3 bg-gray-300 p-1">
            <h4 class="font-semibold text-gray-800">Výsledky hlasovania ({{ votes.length}})</h4>
            <div class="flex cursor-pointer">
                <div title="Áno">{{ countYes }}</div>
                <div title="Zdržal sa">-{{ countUndecided }}</div>
                <div title="Nie">-{{ countNo }}</div>
            </div>
        </div>

        <ul>
            <!-- Hlas Za-->
            <li v-for="vote in votes" class="flex justify-between border-b-2 border-dotted">
                {{ vote.user.first_name + ' ' +vote.user.last_name}}
                <span class="font-medium">{{ voteType(vote.vote) }}</span>
            </li>
        </ul>
    </div>

</template>

<script>
    export default {
        props: ['votes'],
        computed: {
            countYes() {
                return this.votes.filter(value => value.vote === 1).length
            },
            countUndecided() {
                return this.votes.filter(value => value.vote === 2).length
            },
            countNo() {
                return this.votes.filter(value => value.vote === 0).length
            },
        },
        methods: {
            voteType: function (vote) {
                if (vote == 2) {
                    return 'Zdržal'
                }

                if (vote == 1) {
                    return 'ÁNO'
                }

                if (vote == 0) {
                    return 'NIE'
                }
            }
        }

    }
</script>
