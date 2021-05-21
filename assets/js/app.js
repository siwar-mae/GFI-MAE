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
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
//import css files
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import { TablePlugin } from 'bootstrap-vue'
import VueCurrencyInput from 'vue-currency-input'
Vue.use(VueCurrencyInput)
Vue.use(TablePlugin)
Vue.use(CoreuiVue);
import DataTable from 'v-data-table'
Vue.use(DataTable)
Vue.use(Resource);
Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(VueToast);
Vue.use(IconsPlugin);
Vue.component('field-date-picker-mazars', DatePickerMazars);
Vue.component('field-select-mazars', SelectMazars);
import UserList from './components/backend/user/UserList';
import UserNew from './components/backend/user/UserNew';
import IndexBackend from './components/backend/home/IndexBackend';
import InterventionReport from './components/intervention/InterventionReport';



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
    components: {InterventionNew, InterventionList, Index, UserList, UserNew, InterventionReport, IndexBackend}
});