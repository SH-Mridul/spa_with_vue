import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from '../components/home.vue';
import CategoryList from '../components/category/index.vue';
import CategoryCreate from '../components/category/create.vue';
import CategoryEdit from '../components/category/edit.vue';

const routes = new VueRouter({
    mode:'history',
    routes:[
        
        {
            path:'/',
            component:Home,
            name: 'home'
        },

        {
            path:'/category/list',
            component:CategoryList,
            name: 'category-list'
        },

        {
            path:'/category/create',
            component:CategoryCreate,
            name: 'category-create'
        },

        {
            path:'/category/edit/:id',
            component:CategoryEdit,
            name: 'category-edit'
        }
    ]
});

export default routes;
