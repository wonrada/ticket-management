<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <button class="page-link" @click="goToPage(currentPage - 1)">Prev</button>
            </li>
            <li v-for="page in pages" :key="page" class="page-item" :class="{ active: page === currentPage, disabled: page === '...' }">
                <button v-if="page !== '...'" class="page-link" @click="goToPage(page)">
                    {{ page }}
                </button>
                <span v-else class="page-link">{{ page }}</span>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <button class="page-link" @click="goToPage(currentPage + 1)">Next</button>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    totalPages: {
        type: Number,
        required: true,
    },
    currentPage: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(["page-changed"]);

const pages = computed(() => {
    const pages = [];
    const maxVisiblePages = 5;

    if (props.totalPages <= maxVisiblePages) {
        for (let i = 1; i <= props.totalPages; i++) {
            pages.push(i);
        }
    } else {
        if (props.currentPage <= 3) {
            pages.push(1, 2, 3, 4, "...", props.totalPages);
        } else if (props.currentPage >= props.totalPages - 2) {
            pages.push(1, "...", props.totalPages - 3, props.totalPages - 2, props.totalPages - 1, props.totalPages);
        } else {
            pages.push(1, "...", props.currentPage - 1, props.currentPage, props.currentPage + 1, "...", props.totalPages);
        }
    }

    return pages;
});

const goToPage = (page: number | string) => {
    // Emit only if the page is a valid number and not '...'
    if (typeof page === 'number' && page >= 1 && page <= props.totalPages) {
        emit('page-changed', page);
    }
};
</script>

<style scoped>
.pagination .page-item .page-link {
    border-radius: 50px;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}
</style>
