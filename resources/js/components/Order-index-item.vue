<template>
    <tr>
        <td>{{ row.order_number }}</td>
        <td>{{ row.created_at | moment }}</td>
        <td>{{ row.contact.name }} / {{ row.contact.city }}</td>
        <td>{{ row.payment }}</td>
        <td>{{ row.user.last_name }}</td>
        <td>{{ row.amount }}</td>
        <td v-text="orderSend"></td>
        <th class="d-flex justify-content-between">
            <a :href="urlShow">Show</a>
            <a :href="urlPdf" target="_blank">Tlačiť</a>
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
                urlPdf: '/obj/' + this.row.id + '/'  + this.row.contact.name + '/order/pdf',
            }
        },
        computed: {
          orderSend: function() {
              if(this.row.order_send == null)  return 'Neodoslaná';
              if(this.row.order_send !== null )  return moment(this.row.order_send).format('L');
              }
        },
        filters: {
            moment: function (date) {
                return moment(date).format('L');
            }
        }
    }
</script>