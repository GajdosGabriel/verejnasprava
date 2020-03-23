<template>
   <div>
       <h1>Zoznam dodávateľov</h1>


       <a :href="urlNewContact" class="btn btn-secondary btn-sm pull-right">Nový kontakt</a>
       <table class="table table-striped">
           <thead>
           <tr>
               <th>Názov firmy</th>
               <th>Adresa</th>
               <th>Mesto</th>
               <th>Psč</th>
               <th>Ičo</th>
               <th>Dič</th>
               <th>Email</th>
               <th>Tel.</th>
               <th>Panel</th>
           </tr>
           </thead>
           <tbody>
               <tr  v-for="contact in contacts">
                   <td v-text="contact.name"></td>
                   <td v-text="contact.street"></td>
                   <td v-text="contact.city"></td>
                   <td v-text="contact.psc"></td>
                   <td v-text="contact.ico"></td>
                   <td v-text="contact.dic"></td>
                   <td v-text="contact.email"></td>
                   <td v-text="contact.phone"></td>
                   <td>
                       <a :href="'/org/' + contact.id + '/'  + contact.slug + '/contact/edit'">Edit</a>
                   </td>
               </tr>
           </tbody>
       </table>

   </div>
</template>

<script>
    export default {
        props:['contacts','organization'],
        data:function() {
            return {
                name: false,
                urlNewContact: '/org/' + this.organization.id + '/'  + this.organization.slug + '/contact/create',
//                urlEditContact: '/org/' + this.contact.id + '/'  + this.contact.slug + '/contact/edit',
            }
        },
        methods: {
            toggle: function(){
                this.name =! this.name;
            }
        }
    }
</script>

