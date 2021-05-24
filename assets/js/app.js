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
        required_fullName_field: 'Required fullName fields !',
        reference: 'Reference',
        designation: 'Designation',
        prix: 'Price',
        nature: 'Nature',
        please_choose_an_option: 'Please choose an option',
        add_and_return: 'Add and return',
        add_and_create: 'Add and create',
        cancel: "Cancel",
        required_reference_field: 'Required reference fields !',
        required_designation_field: 'Required designation fields !',
        required_price_field: 'Required price fields !',
        required_nature_field: 'Required nature fields !',
        enter_type: 'Enter type',
        please_fill_in_type_fields: 'Please fill in type fields !',
        add_type_of_intervention: "Add type of intervention",
        add_equipment: 'Add Equipment',
        type_of_intervention: 'Type of intervention',
        equipement: 'Equipment',
        please_choose_equipment: 'Please choose equipment',
        intervention_and_observation: 'Interventions and observations',
        required_equipment_field: 'Required equipment field',
        required_observation_field: 'Required observation field',
        configure_intervention: 'Configure intervention',
        add_an_intervention: 'Add an intervention',
        structure: 'Structure',
        configure_observation: 'Configure observation',
        please_choose_an_agency: 'Please choose an agency !',
        logout: 'Logout',
        add_intervention: 'Add intervention',

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
        required_fullName_field: 'Champs nom complet requis !',
        reference: 'Référence',
        designation: 'Désignation',
        price: 'Prix',
        nature: 'Nature',
        please_choose_an_option: 'Veuillez choisir une option',
        add_and_return: 'Ajouter et revenir',
        add_and_create: 'Ajouter et en créer',
        cancel: "Annuler",
        required_reference_field: 'Champs référence requis !',
        required_designation_field: 'Champs désignation requis !',
        required_price_field: 'Champs prix requis !',
        required_nature_field: 'Champs nature requis !',
        enter_type: 'Saisir type',
        please_fill_in_type_fields: 'Veuillez remplir champs type !',
        add_type_of_intervention: "Ajouter type d'intervention",
        add_equipment: 'Ajouter équipement',
        type_of_intervention: "Type d'intervention",
        equipement: 'Equipement',
        please_choose_equipment: 'Veuillez choisir un équipement',
        intervention_and_observation: 'Interventions et observations',
        required_equipment_field: 'Veuillez remplir champs équipement !',
        required_observation_field: 'Veuillez remplir champs observations !',
        configure_intervention: 'Configurer intervention',
        add_an_intervention: 'Ajouter une intervention',
        structure: 'Structure',
        configure_observation: 'Configurer observation',
        please_choose_an_agency: 'Veuillez choisir une agence !',
        logout: 'Se déconnecter',
        add_intervention: 'Ajouter intervention',
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