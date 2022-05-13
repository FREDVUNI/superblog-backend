import { createWebHistory, createRouter } from 'vue-router';

import Dashboard from './pages/admin/Dashboard.vue';
import Profile from './pages/admin/Profile.vue';

import categoryList from './pages/admin/category/List.vue';
import categoryAdd from './pages/admin/category/Add.vue';
import categoryEdit from './pages/admin/category/Edit.vue';

import postList from './pages/admin/post/List.vue';
import postAdd from './pages/admin/post/Add.vue';
import postEdit from './pages/admin/post/Edit.vue';

//Frontend routes
import Home from './pages/public/Home.vue';

const routes = [
    {
        path: '/dashboard',
        component: Dashboard,
        name:'dashboard'
    },
    {
        path: '/profile',
        component: Profile,
        name:'profile'
    },
    {
        path: '/categories',
        component: categoryList,
        name:'categoryList'
    },
    {
        path: '/addcategory',
        component: categoryAdd,
        name:'categoryAdd'
    },
    {
        path: '/editcategory/:id',
        component: categoryEdit,
        name:'categoryEdit'
    },
    {
        path: '/posts',
        component: postList,
        name:'postList'
    },
    {
        path: '/addpost',
        component: postAdd,
        name:'postAdd'
    },
    {
        path: '/editpost/:id',
        component: postEdit,
        name:'postEdit'
    },

    //Frontend routes
    {
        path: '/',
        component: Home,
        name:'Home'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;