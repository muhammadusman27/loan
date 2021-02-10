import AllLoans from './components/AllLoans.vue';
import AddLoan from './components/AddLoan.vue';
import EditLoan from './components/EditLoan.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllLoans
    },
    {
        name: 'add',
        path: '/add',
        component: AddLoan
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditLoan
    }
];