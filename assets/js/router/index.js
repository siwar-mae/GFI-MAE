/* eslint-disable */
import Vue from 'vue';
import Router from 'vue-router';
import InterventionList from '../components/intervention/InterventionList';

Vue.use(Router);

export const routes = [
    { path: "/list", component: InterventionList },
];

