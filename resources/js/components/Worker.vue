<template>

            <tr class="table">
                <td v-if="!show" @click="updating" v-text="workers.firstName" style="cursor: pointer"></td>
                <td v-if="show"><input  v-model="workers.firstName" type="text"></td>
                <td v-text="workers.lastName"></td>
                <td v-text="workers.position"></td>
                <td v-text="workers.email"></td>
                <td v-text="workers.dateContract"></td>
                <td v-text="workerdateBorn"></td>
                <!--<td v-show="!show" @click="updating" style="cursor: pointer">Edit-->
                    <!--<form action="{{ url('delete' , $worker->id) }}" class="post" id="delete-form" method="post">-->
                        <!--<a href="#" onclick="get_form(this).submit(); return false"><i @if(Auth::id() === $worker->id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i></a>-->
                <!--</td>-->
                <td v-if="show" @click="saveItem" style="cursor: pointer">Uložiť</td>
            </tr>


</template>

<script>
    export default {
        props: [ 'workers' ],
        data: function() {
            return {
                show: false



            }
        },
        methods: {
            updating: function() {
                this.show= true;
            },
            saveItem: function() {
                this.show = !this.show;
            }
        },
        computed: {
            workerdateBorn: function() {
                if(this.workers.dateBorn == null) {
                    return 'Neuvedeno';
                } else {
                    return this.workers.dateBorn;
                }
            }
        }
    }
</script>