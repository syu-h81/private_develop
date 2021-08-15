var app = new Vue({
    el: '#app',
    data: {
        isShow: true
    },
    methods: {
        iine: function() {
            this.isShow = false;
        }
    }
})