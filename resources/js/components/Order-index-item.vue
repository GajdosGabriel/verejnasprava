<template>
    <tr>
        <td>{{ row.created_at | moment }}</td>
        <td>{{ row.contact.name }} / {{ row.contact.city }}</td>
        <td>{{ row.payment }}</td>
        <td>{{ row.user.last_name }}</td>
        <td>{{ row.amount }}</td>
        <td>{{ row.status }}</td>
        <th class="d-flex justify-content-between">
            <a :href="urlShow">Show</a>
            <a :href="urlDelete">X</a>
        </th>
    </tr>
</template>

<script>
    import moment from 'moment';
    export default {
        props: ['row'],
        data:function() {
            return {
                urlShow: '/obj/' + this.row.id + '/'  + this.row.contact.name + '/order/show',
                urlDelete: '/obj/' + this.row.id + '/'  + this.row.contact.name + '/order/delete',

            }
        },
        filters: {
            moment: function (date) {
                return moment(date).format('L');
            }
        }
    }
</script>