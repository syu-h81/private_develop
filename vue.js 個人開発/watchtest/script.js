'use strict';

var app = new Vue({
    el: '#app1',
    data: {
        forbiddenText: 'だめ',
        inputText: '今日はいい天気'
    },
    watch: {
        inputText: function() {
            var pos = this.inputText.indexOf(this.forbiddenText);
            if(pos >= 0) {
                alert(this.forbiddenText + 'は入力できません');
                //入力文字列から禁止文字を削除する
                this.inputText = this.inputText.substr(0, pos);
            }
        }
    }
})

var app = new Vue({
    el: '#app2',
    data: {
        restSec: 10,
        timerObj: 'null'
    },
    methods: {
        setTimer: function() {
            this.restSec = 10;
            this.timerObj = setInterval(() => {this.restSec--}, 1000);
        }
    },
    watch: {
        restSec: function() {
            /*if(this.restSec <= 5) {
                alert('残り5秒');
            }*/
            if(this.restSec <= 0) {
                alert("制限時間です");
                clearInterval(this.timerObj);
            }
        }
    }
})

var app = new Vue({
    el: '#app3',
    data: {
        myNumber: 0,
        tweenedNumber: 0
    },
    watch: {
        myNumber: function() {
            TweenMax.to(this.$data, 1/*秒数*/, {tweenedNumber: this.myNumber})
        }
    },
    computed: {
        animeNumber: function() {
            return this.tweenedNumber.toFixed(0);
        }
    }
})