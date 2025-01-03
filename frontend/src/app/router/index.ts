import { createRouter,createWebHistory } from 'vue-router';
import MainLayout from '../layouts/MainLayout.vue';
import TicketManagementView from '../../ticket/views/TicketManagementView.vue';
import TicketFormView from '../../ticket/views/TicketFormView.vue';

const routes = [
  {
    path: '/',
    component: MainLayout,
    children: [
      {
        path: '',
        name: 'Ticket',
        component: TicketManagementView,
      },
      {
        path: '/ticket-form',
        name: 'ticket-form',
        component: TicketFormView,
      },
      {
        path: '/ticket-form/:ticketId',
        name: 'ticket-form-edit',
        component: TicketFormView,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
