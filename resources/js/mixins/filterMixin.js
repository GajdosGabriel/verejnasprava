import moment from "moment";

export const filterMixin = {

    filters: {
        pscFormat: function (value) {
            if ( value != null) {
                return value.toString().replace(/\B(?=(\d{0})+(?!\d))/g, " ");
            }
        },

        priceFormat: function (value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        },

        momentDate: function (date) {
            return moment(date).format('DD-MM-YYYY');
        },

        momentTime: function (date) {
            return moment(date).format('h:mm');
        },

        fullDateTime: function (date) {
            return moment(date).format('DD MM YYYY h:mm');
        }
    }

};
