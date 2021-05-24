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
import VueI18n from 'vue-i18n';
Vue.use(VueI18n);

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD-MM-YYYY hh:mm')
    }
});
const messages = {
    en: {
        id: 'ID',
        number: 'Number',
        start_date: 'Start date',
        agency: 'Agency',
        observation: 'Observation',
        action: 'Actions',
        intervention_management: 'Intervention management',
        list_of_intervention: 'List of intervention',
        filter_datagrid: 'Filter :',
        type_string: 'Type your search ...',
        items_per_pages: 'Items per page:',
        no_filtering_results: 'No filtering results',
        no_items: 'No items',
        generate_pdf: 'Generate PDF',
        user_management: 'User Management',
        user_list: 'Users list',
        email:'Email',
        role: 'Role(s)',
        fullName: 'FullName',
        edit: 'Edit',
        add_user: 'Add user',
        admin: 'Admin',
        user: 'User',
        add: 'Add',
        added_successfully: 'Added successfully!',
        required_email_field: 'Required email fields !',
        add_error: 'Add Error',
        required_role_field: 'Required roles fields !',
        required_fullName_field: 'Required fullName fields !'
    },
    fr: {
        id: 'ID',
        number: 'Numéro',
        start_date: 'Date de début',
        agency: 'Agence',
        observation: 'Observation',
        action: 'Actions',
        intervention_management: 'Gestion des interventions',
        list_of_intervention: 'Liste des interventions',
        filter_datagrid: 'Filtrer :',
        type_string: 'Tapez votre recherche...',
        items_per_pages: 'Éléments par page:',
        no_filtering_results: 'Aucun résultat de filtrage',
        no_items: 'Pas de résultats',
        generate_pdf: 'Générer PDF',
        user_management: 'Gestion des utilisateurs',
        user_list: 'Liste des utilisateurs',
        email:'E-mail',
        role: 'Rôle(s)',
        fullName: 'Nom complet',
        edit: 'Modifier',
        add_user: 'Ajouter un utilisateur',
        admin: 'Administrateur',
        user: 'Utilisateur',
        add: 'Ajouter',
        added_successfully: 'Ajout effectué avec succès!',
        required_email_field: 'Champs email requis !',
        add_error: "Erreur d'ajout",
        required_role_field: 'Champs role requis !',
        required_fullName_field: 'Champs nom complet requis !'
    }
}

const i18n = new VueI18n({
    locale: 'en',
    messages
})
const router = new VueRouter({
    mode: 'history',
    routes
});
new Vue({
    el: '#app',
    i18n,
    components: {InterventionNew, InterventionList, Index, UserList, UserNew, InterventionReport, IndexBackend}
});