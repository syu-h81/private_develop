'use strict';

var MyComponent = {
    template: `<p class="my-comp">Hello</p>`
}

var app = new Vue({
    el: '#app1',
    components: {
        'my-component': MyComponent
    }
})

var MyComponent2 = {
    template: `<p class="my-comp">カウンター <button v-on:click="addOne">追加</button> {{ count }}</p>`,
    data: function() {
        return {
            count: 0
        }
    },
    methods: {
        addOne: function() {
            this.count++;
        }
    }
}

new Vue({
    el:'#app2',
    components: {
        'my-component': MyComponent2
    }
})

var MyComponent3 = {
    template: `<p class="my-comp">私は、{{ myName }}です</p>`,
    props: {
        myName: String
    },
    created: function() {
        if(this.myName == null) {
            this.myName = "名前がない";
        }
    }
}

new Vue({
    el: '#app3',
    components: {
        'my-component': MyComponent3
    }
})