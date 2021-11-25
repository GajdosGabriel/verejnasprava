export const createdMixin = {
    data: function () {
        return {
            isOpen: false,
        };
    },
    
    created: function() {
        let self = this;

        window.addEventListener('click', function(e){
            // close dropdown when clicked outside
            if (!self.$el.contains(e.target)){
                self.isOpen = false
            }
        });

        let that = this;
        document.addEventListener('keyup', function (evt) {
            if (evt.keyCode === 27) {
                that.open = false;
            }
        });
    },

};
