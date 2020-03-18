<template>
    <tr>
        <td>{{ row.order_number }}</td>
        <td>{{ row.created_at | moment }}</td>
        <td>{{ row.contact.name }} / {{ row.contact.city }}</td>
        <td>{{ row.payment }}</td>
        <td>{{ row.user.last_name }}</td>
        <td>{{ row.amount }}</td>
        <td>
            <a :href="this.urlSend"> <span v-html="orderSend"></span></a>
        </td>
        <th>

            <a class="nav-link p-0 d-flex justify-content-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog text-secondary"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" :href="urlShow">
                    <i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                    Zobraziť
                </a>

                <a class="dropdown-item" :href="urlEdit">
                    <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                    Upraviť
                </a>
                <a class="dropdown-item" :href="urlPdf" target="_blank">
                    <i class="fa fa-copy" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                    Tlačiť
                </a>
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" :href="urlDelete">
                    <i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                    Zmazať
                </a>
            </div>
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
                urlEdit: '/obj/' + this.row.id + '/'  + this.row.contact.name + '/order/edit',
                urlDelete: '/obj/' + this.row.id + '/'  + this.row.contact.name + '/order/delete',
                urlPdf: '/obj/' + this.row.id + '/'  + this.row.contact.name + '/order/pdf',
                urlSend: '/obj/' + this.row.id + '/'  + this.row.contact.name + '/order/send',

            }
        },
        computed: {
          orderSend: function() {
              if(this.row.order_send == null)  return '<span class="badge badge-danger">Odoslať</span>';
              if(this.row.order_send !== null)  return '<span class="badge badge-success">Odoslané</span>';
              // if(this.row.order_send !== null )  return moment(this.row.order_send).format('L');
              }
        },
        filters: {
            moment: function (date) {
                return moment(date).format('L');
            }
        }
    }
</script>
<style>
    .badge {
        cursor: pointer;
    }

</style>
