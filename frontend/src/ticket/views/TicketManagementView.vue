<template>
    <div class="p-3 d-flex flex-column">
        <div class="d-flex mb-1" style="font-size: 14px;">
            <span style="color: #567D92; font-weight: bold;">
                Dashboard</span>
        </div>

        <div class="p-3 flex-grow-1"
            style="background-color: #fff; border-radius: 10px; width: 100%; max-height: 550px;">
            <div class="p-3 d-flex flex-column">

                <!-- search -->
                <div class="d-flex justify-content-between" style="width: 100%;">
                    <div style="width: 10%;">
                        <select class="form-select" v-model="params.filterKey" aria-label="Large select example">
                            <option value="id" selected>ID</option>
                            <option value="title">Title</option>
                        </select>
                    </div>
                    <div class="mx-2" style="width: 100%;">
                        <input v-model="params.filterValue" type="text" class="form-control" id="filterValue"
                            name="filterValue">
                    </div>
                    <div style="width: 10%;">
                        <button @click="getTicket()" style="width: 100%;" type="button"
                            class="btn btn-primary">Search</button>
                    </div>
                    <div class="ps-2" style="width: 15%;">
                        <button @click="navigateToForm" style="width: 100%;" type="button" class="btn btn-primary">Creat
                            Ticket</button>
                    </div>
                </div>

                <!-- table -->
                <div class="mt-3 overflow-auto" style="max-height: 400px;">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%;">#</th>
                                <th scope="col" style="width: 10%;">Ticket ID</th>
                                <th scope="col" style="width: 15%;">Title</th>
                                <th scope="col" style="width: 20%;">Description</th>
                                <th scope="col" style="width: 10%;">Priority</th>
                                <th scope="col">Organization</th>
                                <th scope="col">Vessel</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="ticket in ticketData" :key="ticket.id">
                                <td class="d-flex justify-content-center align-self-center" style="height:100%;">
                                    <div class="pe-1">
                                        <button @click="showTicket(ticket)" class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="pe-1">
                                        <router-link :to="`/ticket-form/${ticket.id}`">
                                            <button class="btn btn-warning">
                                                <i class="fas fa-edit" style="color: #fff;"></i>
                                            </button>
                                        </router-link>
                                    </div>
                                    <div>
                                        <button @click="openModal(ticket.id)" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>{{ ticket.id }}</td>
                                <td>{{ ticket.title }}</td>
                                <td>{{ ticket.description }}</td>
                                <td>{{ ticket.priority }}</td>
                                <td>{{ ticket.organization }}</td>
                                <td>{{ ticket.vessel }}</td>
                                <td>{{ ticket.created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-2">
            <div class=" d-flex px-2" style="background-color: #fff; border-radius: 10px; height: 40px;">

                <!-- number of list -->
                <div class="align-self-center number-list">
                    Number of List
                </div>
                <div class="align-self-center number-list-select px-3">
                    <select class="form-select" v-model="selectedItemperPage" @change="handleSelectChange"
                        aria-label="Large select example">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="30">40</option>
                        <option value="30">50</option>
                        <option value="30">100</option>
                    </select>
                </div>
                <div>
                </div>
            </div>

            <!-- pagination -->
            <div class="align-self-center px-2" style="background-color: #fff; border-radius: 10px; height: 40px;">
                <div class="align-self-center">
                    <PaginationComponent :totalPages="totalPages" :currentPage="currentPage"
                        @page-changed="handlePageChange" />
                </div>
            </div>
        </div>
        <ConfirmModal @modalClosed="handleModalClosed" ref="modalRef" :configModal="configModal" />
        <TicketShowModal @modalClosed="editTicketModal" ref="ticketShowRef" :ticketData="ticketDataModal" />
    </div>

</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import PaginationComponent from '../../app/components/PaginationComponent.vue';
import { getTickets,deleteTicket } from '../../app/services/ticket.service';
import { useRouter } from 'vue-router'; // Import useRouter hook to navigate
import type { getTicketResponse, Ticket } from '../../app/models/ticketResponse.model';
import type { getTicketRequest } from '../../app/models/ticketRequest.model';
import ConfirmModal from '../../app/modals/ConfirmModal.vue';
import TicketShowModal from '../../app/modals/TicketShowModal.vue';

const router = useRouter();

var params: getTicketRequest = {
    filterKey: 'id',
    filterValue: '',
    currentPage: 1,
    itemPerPage: 10,
    field: 'id',
    byDescending: false,
};
const ticketData = ref<Ticket[]>([]); // Use ref for reactivity
const ticketId = ref<string>('');

const totalPages = ref(0); // Initialize totalPages as a reactive reference with 0
let currentPage = ref(1); // Declare currentPage as a reactive reference

const selectedItemperPage = ref(10);
const handlePageChange = (page: number) => {
    currentPage.value = page; // Update currentPage
    params.currentPage = page;
    getTicket()
};

const handleSelectChange = () => {
    params.itemPerPage = selectedItemperPage.value;
    getTicket();
};

// confirm Modal
const modalRef = ref<InstanceType<typeof ConfirmModal>>()
const configModal = ref({
    title: 'Confirmation',
    msg: 'Are you sure you want to delete this ticket?',
    showConfirm: true,
    confirmText: 'Yes',
    showClose: true,
})

const openModal = (id: string) => {
    ticketId.value = id;
    modalRef.value?.openModal()
}

const handleModalClosed = (value: boolean) => {
    if (value) {
        delTicket();
    }
}

// ticketShow 
const ticketShowRef = ref<InstanceType<typeof ConfirmModal>>()
const ticketDataModal = ref<{
    id: string;
    title: string;
    description: string;
    contact_email: string;
    priority: string;
    organization: string;
    vessel: string;
    service_line: string;
    assign_to: string;
    status: string;
    category: string;
    created_at: string;
    updated_at: string;
} | undefined>(undefined);
const showTicket = (data: any) => {
    ticketDataModal.value = data || undefined;
    if (data) {
        ticketShowRef.value?.openModal()
    }
}

const editTicketModal = (value: boolean) => {
    if (value) {
        router.push({ path: `ticket-form/${ticketDataModal.value?.id}` });
    }
}

async function getTicket() {
    try {
        const response: getTicketResponse = await getTickets(params);
        ticketData.value = response.data; // Correctly assign data to ticketData
        totalPages.value = response.totalPage ?? 0; // Ensure totalPages is always a valid number
    } catch (error) {
        console.error('Failed to fetch data', error);
    }
}

async function delTicket(){
    try {
        const response = await deleteTicket(ticketId.value);
        if(response.success){
            getTicket();
        }
    } catch (error) {
        console.error('Failed to fetch data', error);
    }
}

// Method to handle button click and navigate to form
const navigateToForm = () => {
    router.push({ name: 'ticket-form' }); // Replace 'ticket-form' with the name of your route
};

onMounted(() => {
    getTicket();
});
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
/* App Styling */
/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    border-radius: 100px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>