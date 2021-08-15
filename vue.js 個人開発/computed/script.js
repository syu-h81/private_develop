'use strict';

var app = new Vue({
    el: '#app1',
    data: {
        price: 100
    },
    computed: {
        taxIncluded: function () {
            return this.price * 1.1;
        }
    }
})

var app = new Vue({
    el: '#app2',
    data: {
        price: '',
        count: ''
    },
    computed: {
        sum: function() {
            return this.price * this.count;
        },
        taxIncluded: function () {
            return this.sum * 1.1;
        }
    }
})

var col = this.computedColor;
var app = new Vue({
    el: '#app3',
    data: {
        myText: '今日はいい天気です。'
    },
    computed: {
        remaining: function() {
            return 140 - this.myText.length;
        },
        computedColor: function() {
            col = "green";
            if(this.remaining < 20) {
                col = "orange";
            }
            if(this.remaining < 1) {
                col ="red";
            }
            return col;
        }

    }
})

var app = new Vue({
    el: '#app4',
    data: {
        findWord: '',
        items: ['桃太郎', '花咲かじいさん', '浦島太郎', 'かぐや姫', 'かちかち山']
    },
    computed: {
        findItems: function() {
            if(this.findWord) {
                return this.items.filter(function(value) {
                    return (value.indexOf(this.findWord) > -1);
                }, this);
            }else {
                return this.items;
            }
        }
    }
})

var app = new Vue({
    el: "#app5",
    data: {
        R: 255,
        G: 150,
        B: 100
    },
    computed: {
        mixColor: function() {
            var ans = "RGB("+this.R+", "+this.G+", "+this.B+")";
            return ans;
        }
    }
})