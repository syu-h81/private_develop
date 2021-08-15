'use strict';

var app = new Vue({
    el:'#tax-app',
    data: {
        price: ''
    },
    methods: {
        /*calc: function() {
            this.incomeTax;
            this.residentTax;
            this.nationalPension;
            this.healthInsurance;
        }*/
    },
    computed: {
        //所得税の算出///
        incomeTax: function() {
            if(1950000 > this.price) {
                return Math.trunc(this.price * 0.05).toLocaleString();
            }
            if(this.price >= 1950000 && this.price < 3300000) {
                return Math.trunc(this.price * 0.1 - 97500).toLocaleString();
            }
            if(this.price >= 3300000 && this.price < 6950000) {
                //return this.price / 1.2 - 427500;
                //return Math.trunc(this.price - (this.price / 1.2 - 427500)).toLocaleString();
                return Math.trunc(this.price * 0.2 - 427500).toLocaleString();
            }
            if(this.price >= 6950000 && this.price < 9000000) {
                //return Math.trunc(this.price - (this.price / 1.23 -636000)).toLocaleString();
                return Math.trunc(this.price * 0.23 - 636000).toLocaleString();
            }
            if(this.price >= 9000000 && this.price < 18000000) {
                //return this.price / 1.33 - 1536000;
                return Math.trunc(this.price * 0.33 - 1536000).toLocaleString();
            }
            if(this.price >= 18000000 && this.price < 40000000) {
                //return this.price / 1.4 - 2796000;
                return Math.trunc(this.price * 0.4 - 2796000).toLocaleString();
            }
            if(this.price >= 40000000) {
                return Math.trunc(this.price * 0.45 - 4796000).toLocaleString();
            }
        },
        /////住民税の算出方法/////
        residentTax: function() {
            if(this.price < 1950000) {
                return Math.trunc((this.price * 0.95) / 10).toLocaleString();
            }
            if(this.price >= 1950000 && this.price < 3300000) {
                return Math.trunc((this.price * 0.9 - 97500) / 10).toLocaleString();
            }
            if(this.price >= 3300000 && this.price < 6950000) {
                return Math.trunc((this.price * 0.8 - 427500) / 10).toLocaleString();
            }
            if(this.price >= 6950000 && this.price < 9000000) {
                return Math.trunc((this.price * 0.77 - 636000) / 10).toLocaleString();
            }
            if(this.price >= 9000000 && this.price < 18000000) {
                return Math.trunc((this.price * 0.67 - 1536000) / 10).toLocaleString();
            }
            if(this.price >= 18000000 && this.price < 40000000) {
                return Math.trunc((this.price * 0.6 - 2796000) / 10).toLocaleString();
            }
            if(this.price >= 40000000) {
                return Math.trunc((this.price * 0.55 - 4796000) / 10).toLocaleString();
            }
        },
        /////国民年金の算出方法/////
        nationalPension: function() {
            return Math.trunc(16610 * 12).toLocaleString();
        },
        /////国民健康保険の算出方法/////
        healthInsurance: function() {
            //賦課基準額///
            var csAmount = this.price - 330000;
            /////↓↓↓↓↓↓ 医療保険の保険料算出 ↓↓↓↓↓↓///////
            //医療保険の所得割額
            var mc_incomePercent = csAmount * 0.0724;
            //医療保険の均等割額//
            var mc_pcRate = 25202;
            //医療保険の平等割額//
            var mc_esAmount = 17654;
            var mcInsurance = mc_incomePercent + mc_pcRate + mc_esAmount;

            /////↓↓↓↓↓↓ 後期高齢者支援金分保険料の保険料算出 ↓↓↓↓↓↓///////
            //後期高齢保険の所得割額
            var de_incomePercent = csAmount * 0.0275;
            //後期高齢保険の均等割額
            var de_pcRate = 9301;
            //後期高齢保険の平等割額
            var de_esAmount = 6515;
            var deInsurance = de_incomePercent + de_pcRate + de_esAmount;

            //国民健康保険の合計//
            var htInsurance = mcInsurance + deInsurance;
            return Math.trunc(htInsurance).toLocaleString();
        }
    }
})