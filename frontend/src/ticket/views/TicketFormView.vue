<template>
    <div class="p-3 d-flex flex-column">
        <div class="d-flex mb-1" style="font-size: 14px;">
            <span style="color: #567D92; font-weight: bold;">
                Create Ticket</span>
        </div>

        <div class="p-3 flex-grow-1"
            style="background-color: #fff; border-radius: 10px; width: 100%; max-height: 570px;">
            <div class="p-3 d-flex flex-column">
                <div class="d-flex justify-content-between mt-2">
                    <div class="pe-1" style="width: 50%;">
                        <label for="title">Ticket Title :</label>
                        <input v-model="request.title" class="form-control mt-1" type="text" name="title" id="title"
                            style="width: 100%;">
                    </div>
                    <div class="pe-1" style="width: 50%;">
                        <label for="priority">Ticket Priority :</label>
                        <select v-model="request.priority" class="form-select mt-1" aria-label="Large select example"
                            style="width: 100%;">
                            <option selected disabled>Select Ticket Priority</option>
                            <option v-for="item in priorityData" :key="item?.id" :value="item?.name">{{ item?.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="pe-1" style="width: 100%;">
                        <label for="contact_email">Contact Email :</label>
                        <input v-model="request.contact_email" class="form-control mt-1" type="text"
                            name="contact_email" id="contact_email" placeholder="example@mail.com" style="width: 100%;">
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="pe-1" style="width: 100%;">
                        <label for="description">Description :</label>
                        <textarea v-model="request.description" class="form-control mt-1" name="description"
                            id="description" rows="2"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="pe-1" style="width: 50%;">
                        <label for="organization">Organization :</label>
                        <select v-model="request.organization" class="form-select mt-1"
                            aria-label="Large select example" style="width: 100%;">
                            <option selected disabled>Select Organization</option>
                            <option v-for="item in organizationData" :key="item?.id" :value="item?.name">{{ item?.name
                                }}
                            </option>
                        </select>
                    </div>
                    <div class="pe-1" style="width: 50%;">
                        <label for="category">Category :</label>
                        <select v-model="request.category" class="form-select mt-1" aria-label="Large select example"
                            style="width: 100%;">
                            <option selected disabled>Select Category</option>
                            <option v-for="item in categoryData" :key="item?.id" :value="item?.name">{{ item?.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="pe-1" style="width: 50%;">
                        <label for="vessel">Vessel :</label>
                        <select v-model="request.vessel" class="form-select mt-1" aria-label="Large select example"
                            style="width: 100%;">
                            <option selected disabled>Select Vessel</option>
                            <option v-for="item in vesselData" :key="item?.id" :value="item?.name">{{ item?.name }}
                            </option>
                        </select>
                    </div>
                    <div class="pe-1" style="width: 50%;">
                        <label for="status">Status :</label>
                        <select v-model="request.status" class="form-select mt-1" aria-label="Large select example"
                            style="width: 100%;">
                            <option selected disabled>Select Status</option>
                            <option v-for="item in statusData" :key="item?.id" :value="item?.name">{{ item?.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="pe-1" style="width: 50%;">
                        <label for="assign_to">Assign To :</label>
                        <select v-model="request.assign_to" class="form-select mt-1" aria-label="Large select example"
                            style="width: 100%;">
                            <option selected disabled>Select User</option>
                            <option v-for="item in usersData" :key="item?.id" :value="item?.name">{{ item?.name }}
                            </option>
                        </select>
                    </div>
                    <div class="pe-1" style="width: 50%;">
                        <label for="service_line">Service Line :</label>
                        <select v-model="request.service_line" class="form-select mt-1"
                            aria-label="Large select example" style="width: 100%;">
                            <option selected disabled>Select Service Line</option>
                            <option v-for="item in serviceLineData" :key="item?.id" :value="item?.name">{{ item?.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <div></div>
                    <div class="d-flex">
                        <div class="pe-2">
                            <router-link to="/">
                                <button class="btn btn-secondary">Back</button>
                            </router-link>
                        </div>
                        <div>
                            <button @click="openModal" class="btn btn-primary">{{ ticketId ? 'Update' : 'Save'
                                }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ConfirmModal @modalClosed="handleModalClosed" ref="modalRef" :configModal="configModal" />
    </div>


</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import category from '../../app/assets/json/mock-updata/category.json'; // Import the category.ts file
import organization from '../../app/assets/json/mock-updata/organization.json';
import priority from '../../app/assets/json/mock-updata/priority.json';
import serviceLine from '../../app/assets/json/mock-updata/serviceLine.json';
import status from '../../app/assets/json/mock-updata/status.json';
import users from '../../app/assets/json/mock-updata/users.json';
import vessel from '../../app/assets/json/mock-updata/vessl.json';
import type { TicketRequest } from '../../app/models/ticketRequest.model';
import { createTicket, getOneTickets, updateTicket } from '../../app/services/ticket.service';
import type { TicketResponse } from '../../app/models/response.model';
import ConfirmModal from '../../app/modals/ConfirmModal.vue';
import { useRoute,useRouter } from 'vue-router';
import type { TicketData } from '../../app/models/ticketResponse.model';

interface MockupDataModel {
    id: number;
    name: string;
}

// Create a reactive reference for categoryData
const categoryData = ref<MockupDataModel[]>([]);
const organizationData = ref<MockupDataModel[]>([]);
const priorityData = ref<MockupDataModel[]>([]);
const serviceLineData = ref<MockupDataModel[]>([]);
const statusData = ref<MockupDataModel[]>([]);
const usersData = ref<MockupDataModel[]>([]);
const vesselData = ref<MockupDataModel[]>([]);

const request = ref<TicketRequest>({
    title: "",
    description: "",
    contact_email: "",
    priority: "",
    organization: "",
    vessel: "",
    service_line: "",
    assign_to: "",
    status: "",
    category: ""
});
const route = useRoute();
const router = useRouter();
const ticketId = route.params.ticketId;

const message = ref("")
const modalRef = ref<InstanceType<typeof ConfirmModal>>()
const configModal = ref({
    title: 'Confirmation',
    msg: 'Are you sure you want to continue?',
    showConfirm: true,
    confirmText: 'Yes',
    showClose: true,
})

const openModal = () => {
    message.value = "Confirm Save Ticket"
    modalRef.value?.openModal()
}

const handleModalClosed = (value: boolean) => {
    if (value) {
        onSave();
    }
}

onMounted(() => {
    categoryData.value = category; // Assign the category data to the reactive reference
    organizationData.value = organization;
    priorityData.value = priority;
    serviceLineData.value = serviceLine;
    statusData.value = status;
    usersData.value = users;
    vesselData.value = vessel;

    if (ticketId) {
        getTicket(ticketId.toString())

    }

});

async function getTicket(id: string) {
    try {
        const response: TicketResponse = await getOneTickets(id);
        const ticketData: TicketData = response.data; // Assuming response.data is an array of TicketData
        // Map the ticket data to the request object

        request.value = {
            title: ticketData.title,
            description: ticketData.description,
            contact_email: ticketData.contact_email,
            priority: ticketData.priority,
            organization: ticketData.organization,
            vessel: ticketData.vessel,
            service_line: ticketData.service_line,
            assign_to: ticketData.assign_to,
            status: ticketData.status,
            category: ticketData.category
        };

    } catch (error) {
        console.error('Failed to fetch data', error);
    }
}

async function onSave() {
    // update
    if (ticketId) {
        try {
            const response: TicketResponse = await updateTicket(ticketId.toString(),request.value);
            if(response.success){
                router.push({ path: `/` });
            }
        } catch (error) {
            console.error('Failed to fetch data', error);
        }
    }
    // save
    else {
        try {
            const response: TicketResponse = await createTicket(request.value);
            if(response.success){}
        } catch (error) {
            console.error('Failed to fetch data', error);
        }
    }

}
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>