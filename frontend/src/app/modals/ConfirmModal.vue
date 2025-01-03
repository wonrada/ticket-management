<template>
  <!-- Modal structure using Bootstrap -->
  <div class="modal fade" tabindex="-1" :class="{ 'show': isVisible }" aria-labelledby="exampleModalLabel"
    :aria-hidden="!isVisible ? 'true' : 'false'" :inert="!isVisible">
    <div class="modal-dialog">
      <div class="modal-content shadow-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ configModal.title }}</h5>
          <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>{{ configModal.msg }}</p>
        </div>
        <div class="modal-footer">
          <button v-if="configModal.showConfirm" type="button" class="btn btn-secondary" @click="onNo">Close</button>
          <button v-if="configModal.showClose" type="button" class="btn btn-primary" @click="onYes">Confirm</button>
        </div>
      </div>
    </div>

  </div>

  <div v-if="isVisible" class="modal-backdrop"></div>
</template>

<script setup lang="ts">
import { ref, defineExpose, defineEmits } from 'vue'

const props = defineProps({
  configModal: {
    type: Object,
    default: ''
  },
})

const isVisible = ref(false)

const openModal = () => {
  isVisible.value = true
  console.log(props);
  
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
</style>
