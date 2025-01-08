<template>
  <!-- Modal structure using Bootstrap -->
  <div class="modal fade" tabindex="-1" :class="{ 'show': isVisible }" aria-labelledby="exampleModalLabel"
    :aria-hidden="!isVisible ? 'true' : 'false'" :inert="!isVisible">
    <div class="modal-dialog modal-lg">
      <div class="modal-content shadow-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ticket Detail</h5>
          <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="p-3 ticket-detail">
            <div class="d-flex justify-content-between">
              <div class="right-line" style="width: 70%;">
                <h6>Ticket</h6>
                <div>{{ ticketData.title }}</div>
                <div class="d-flex mt-3">
                  <b style="width: 25%;">Ticket ID :</b>
                  <div style="width: 75%;">{{ ticketData.id }}</div>
                </div>
                <div class="d-flex mt-1">
                  <b style="width: 25%;">Created :</b>
                  <div style="width: 75%;">{{ ticketData.created_at }}</div>
                </div>
                <div class="d-flex mt-1">
                  <b style="width: 25%;">Contact :</b>
                  <div style="width: 75%;">{{ ticketData.contact_email }}</div>
                </div>
                <div class="d-flex mt-1">
                  <b style="width: 25%;">Assign To :</b>
                  <div style="width: 75%;">{{ ticketData.assign_to }}</div>
                </div>
                <div class="d-flex mt-1">
                  <b style="width: 25%;">Organization :</b>
                  <div style="width: 75%;">{{ ticketData.organization }}</div>
                </div>
                <div class="d-flex mt-1">
                  <b style="width: 25%;">Category :</b>
                  <div style="width: 75%;">{{ ticketData.category }}</div>
                </div>
                <div class="d-flex mt-1">
                  <b style="width: 25%;">Vessel :</b>
                  <div style="width: 75%;">{{ ticketData.vessel }}</div>
                </div>
                <div class="d-flex mt-1">
                  <b style="width: 25%;">Service Line :</b>
                  <div style="width: 75%;">{{ ticketData.service_line }}</div>
                </div>

                <div class="d-flex mt-3">
                  {{ ticketData.description }}
                </div>
              </div>
              <div class="d-flex justify-content-center" style="width: 30%;">
                <div class="align-self-center">
                  <div>
                    <h4>{{ ticketData.priority }}</h4>
                    <div>Ticket Priority</div>
                  </div>
                  <div style="height: 60px;"></div>
                  <div>
                    <h4>{{ ticketData.status }}</h4>
                    <div>Status</div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="onNo">Close</button>
          <button class="btn btn-primary" @click="onYes">Edit</button>
        </div>
      </div>
    </div>

  </div>

  <div v-if="isVisible" class="modal-backdrop"></div>
</template>

<script setup lang="ts">
import { ref, defineExpose, defineEmits } from 'vue'

const props = defineProps({
  ticketData: {
    type: Object,
    default: ''
  },
})

const isVisible = ref(false)

const openModal = () => {
  isVisible.value = true
}

const closeModal = () => {
  isVisible.value = false
}

// Define the emit event to send a value to the parent
const emit = defineEmits<{
  (event: 'modalClosed', value: boolean): void;
}>()

// Define action for the Yes button
const onYes = () => {
  // Emit true to the parent component when the Yes button is clicked
  emit('modalClosed', true)
  closeModal() // Optionally close the modal after sending the event
}

const onNo = () => {
  // Emit true to the parent component when the Yes button is clicked
  emit('modalClosed', false)
  closeModal() // Optionally close the modal after sending the event
}

// Expose openModal to parent component
defineExpose({
  openModal
})
</script>

<style scoped>
/* Ensure modal is above other content */
.modal.show {
  display: block;
  z-index: 1050;
  /* Modal should be above other content */
}

/* Ensure the backdrop stays below the modal */
.modal-backdrop {
  position: fixed;
  /* Fix the backdrop to the screen */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  /* Semi-transparent black backdrop */
  z-index: 1040;
  /* Backdrop stays below modal */
}

/* Apply shadow under modal */
.modal-content {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
}

.ticket-detail {
  border: 1px solid rgb(170, 170, 170);
  border-radius: 10px;
}

.right-line {
  border-right: 1px solid rgb(170, 170, 170);
}
</style>
