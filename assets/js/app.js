import Vue from 'vue';
import InterventionNew from './components/intervention/InterventionNew';
import InterventionList from './components/intervention/InterventionList';
import Index from './components/home/Index';
import Resource from 'vue-resource';
import VueRouter from 'vue-router'
import { routes } from "./router/index";
import moment from 'moment';
import DatePickerMazars from './components/vueFormGenerator/customField/DatePickerMazars';
import SelectMazars from "./components/vueFormGenerator/customField/SelectMazars";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import CoreuiVue from '@coreui/vue';
import { CDataTable } from '@coreui/vue/src';

Vue.use(CoreuiVue);
Vue.use(Resource);
Vue.use(VueRouter);
Vue.use(VueToast);
Vue.component('field-date-picker-mazars', DatePickerMazars);
Vue.component('field-select-mazars', SelectMazars);
Vue.use(DataTable)

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD-MM-YYYY hh:mm')
    }
});
const router = new VueRouter({
    mode: 'history',
    routes
});
new Vue({
    el: '#app',
    components: {InterventionNew, InterventionList, Index}
});