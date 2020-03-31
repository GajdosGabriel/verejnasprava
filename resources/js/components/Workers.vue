<template>
    <div>

        <h2>Ľudia</h2>
        <button style="margin-top: -19px;" id="novyzamestnanec" class="btn btn-primary pull-right">Pridať zamestnanca</button>
        <table class="table">
            <thead>
            <tr class="bg-success">
                <td>Meno</td>
                <td>Priezvisko</td>
                <td>Funkcia</td>
                <td>Email</td>
                <td>Prax</td>
                <td>Narodený</td>
                <!--<td>Akcia</td>-->
            </tr>
            </thead>
            <tbody v-for="(worker, index) in workers">
                <worker :workers="worker"></worker>
            </tbody>
        </table>
    </div>
</template>

<script>
    import worker from './Worker.vue';
    export default {
        props: [ 'workers' ],
        components: { worker },
        data: function() {
            return {
                show: false,
                firstName: ''
            }
        },
        methods: {
            updating: function(index) {
                this.show= true;
            }
        }
    }
</script>
