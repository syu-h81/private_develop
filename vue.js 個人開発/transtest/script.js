'use strict';

var app = new Vue({
    el: '#app1',
    data: {
        isOk: false
    }
})

var app = new Vue({
    el: '#app2',
    data: {
        dataArray: ['桃太郎', 'かぐや姫', 'かちかち山'],
        addItem: ''
    },
    methods: {
        addList: function() {
            this.dataArray.push(this.addItem);
        },
        removeLast: function() {
            var lastIdx = this.dataArray.length - 1;
            this.dataArray.splice(lastIdx, 1);
        }
    }
})

var app = new Vue({
    el: '#app3',
    data: {
        dataArray: ['one', 'two', 'three', 'four', 'five']
    },
    methods: {
        dataSort: function() {
            this.dataArray.sort(function(a,b) {
                if(a < b) return - 1;
                if(a > b) return 1;
                return 0;
            });
        },
        dataShuffle: function() {
            var buffer = [];
            var len = this.dataArray.length;
            for(var i = len; len > 0; len-- ) {
                var r = Math.floor(Math.random() * len);
                buffer.push(this.dataArray[r]);
                this.dataArray.splice(r, 1);
            }
            this.dataArray = buffer;
        }
    }
})