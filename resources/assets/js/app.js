
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

/*const app = new Vue({
    el: '#app'
});*/


    




/*const app = new Vue({
        el: "#app",
        data: {
            sorteos : [],
            pagination: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1,
            },
            offset: 4,
            formErrors: {},
            formErrorsUpdate: {}
        },
        computed: {
            isActived: function() {
                return this.pagination.current_page;
            },

            pagesNumber: function() {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        mounted() {
        	this.getVueSorteos(this.pagination.current_page);
            
        },
        methods: {
            getVueSorteos: function(page) {
                axios.get('cargar-sorteos?page='+page).then(function (response) {
                    // this.sorteos = response.data.data.data;
                    // this.pagination = response.data.pagination;

                    console.log("sorteos");
                    console.log(response);
                    // console.log(this.sorteos);
                    app.$nextTick(function() {
                        // $('[data-toggle="popover"]').popover();
                        
                        this.sorteos = response.data.data.data;
                    	this.pagination = response.data.pagination;

                    })
                });
            },
            
            changePage: function(page) {
                this.pagination.current_page = page;
                this.getVueSorteos(page);
            }
        }
     });*/