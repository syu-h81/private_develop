'use strict';

var app = new Vue({
    el: '#app1',
    data: {
        myArray: ['あんぱん', 'ジャムパン', 'メロンパン']
    }
})

var app = new Vue({
    el: '#app2',
    data: {
        objArray: [
            {name: 'あんぱん', price: 300},
            {name: 'ジャムパン', price: 450},
            {name: 'メロンパン', price: 600}
        ]
    }
})

var app = new Vue({
    el: '#app3'
})

var app = new Vue({
    el: '#app4',
    data: {
        myArray: ['ジャムパン', 'メロンパン', 'クロワッサン']
    }
})

var app = new Vue({
    el: '#table_app',
    data: {
        header: ['プログラミング言語', 2018, 2013, 2008, 2003, 1998],
        ranking: [
            ['Java', 1, 2, 1, 1, 6],
            ['C', 2, 1, 2, 2, 1],
            ['C++', 3, 4, 3, 3, 2],
            ['Python', 4, 7, 6, 11, 23],
            ['JavaScript', 7, 10, 8, 7, 20]
        ]
    }
})

var app = new Vue({
    el: '#app5',
    data: {
        myArray: ['1つ目', '2つ目', '3つ目', '4つ目', '5つ目']
    },
    methods: {
        addLast: function() {
            this.myArray.push('最後尾に追加')
        },
        addObj: function(index) {
            this.myArray.splice(index, 0, '追加')
        },
        changeObj: function(index) {
            this.myArray.splice(index, 1, '変更')
        },
        deleteObj: function(index) {
            this.myArray.splice(index, 1)
        }
    }
})

var app = new Vue({
    el: '#app6',
    data: {
        myArray: ['one', 'two', 'three', 'four', 'five']
    },
    methods: {
        sortDate: function(listdate) {
            listdate.sort(function(a, b) {
                return(a < b ? -1 : 1);
            });
        }
    }
})

var app = new Vue({
    el: '#app7',
    data: {
        myArray: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    }
})

var app = new Vue({
    el: '#app8',
    data: {
        myArray: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    },
    methods: {
        evenShow: function() {
            this.myArray = this.myArray.filter(
                function(value) {
                    return value % 2 == 0;
                }
            );
        }
    }
})