'use strict';

var app = new Vue({
    el: '#app1',
    data: {
        count: 0,
        btnColor_class: 'btnColor'
    },
    methods: {
        countUp: function() {
            this.count++;
        }
    }
})

function iine() {
    alert('いいね！');
}
var app = new Vue({
    el: '#app2',
    data: {
        isclick: false
    },
    methods: {
        oneClick: function() {
            this.isClick = true;
            iine();
        }
    }
})

var app = new Vue({
    el: '#app3',
    data: {
        count: 0
    },
    methods: {
        countUp: function(value) {
            this.count += value;
        },
        countReset: function() {
            this.count = 0;
        }
    }
})

var app = new Vue({
    el: '#app4',
    data: {
        myText: 'Enter push!!'
    },
    methods: {
        showAlert: function() {
            alert('Enterキーを押しました！');
        }
    }
})

var app = new Vue({
    el: '#app5',
    data: {
        myText: 'Enter+Shift push!!'
    },
    methods: {
        showAlert: function() {
            alert('Enter,shiftキーを同時に押しました！');
        }
    }
})