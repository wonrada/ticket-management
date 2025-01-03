import { Vue } from "vue-class-component";

import { Vue } from "vue-class-component";

<template>
    <div class="d-flex flex-row vh-100">
        <!-- Left Sidebar -->
        <aside v-bind:class="['sidebar', { 'sidebar-expanded': sidebarExpanded }]" class="bg-dark text-white">
            <!-- ปุ่มเปิด/ปิด Sidebar -->
            <button @click="toggleSidebar" class="sidebar-toggle-btn btn btn-link text-white">
                ☰
            </button>

            <ul class="list-unstyled">
                <li @click="toggleSidebar">
                    <router-link to="/" class="d-flex align-items-center py-2 px-3">
                        <span class="icon">🎟️</span>
                        <span v-if="sidebarExpanded">Ticket</span>
                    </router-link>
                </li>
                <li @click="toggleSidebar">
                    <router-link to="/" class="d-flex align-items-center py-2 px-3">
                        <span class="icon">📁</span>
                        <span v-if="sidebarExpanded">About</span>
                    </router-link>
                </li>
                <li @click="toggleSidebar" class="d-flex align-items-center py-2 px-3">
                    <span class="icon">⚙️</span>
                    <span v-if="sidebarExpanded">Settings</span>
                </li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <div class="d-flex flex-row flex-grow-1 overflow-hidden">
            <!-- Main Content -->
            <div class="d-flex flex-column w-100">
                <!-- Top Bar -->
                <header class="text-white p-3 d-flex justify-content-between align-items-center"
                    style="background-color: #fff; width: 100%; height: 40px;">
                    <!-- ปุ่มเปิด/ปิด Sidebar -->
                    <div style="color: #4b4b4b;">
                        <h4>Ticket Management</h4>
                    </div>
                    <div class="right-icons d-flex align-items-center">
                        <span class="notification-icon pe-3" style="color: black;">🔔</span>
                        <span class="user-name" style="color: #4b4b4b;">{{ userName }}</span>
                        <span class="user-icon ps-2">👤</span>
                    </div>
                </header>

                <!-- Main Content -->
                <main class="flex-grow-1 overflow-auto p-2" style="background-color: #c9c9c9;">
                    <RouterView />
                </main>

                <!-- Footer -->
                <footer class="p-2" style="background-color: #fff; color: #4b4b4b;">
                    © 2024 Ticket Management 
                </footer>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { Vue } from "vue-class-component";

export default class App extends Vue {
    sidebarExpanded: boolean = false;
    userName: string = "Wonrada Kaaungku";

    toggleSidebar() {
        this.sidebarExpanded = !this.sidebarExpanded;
    }
}
</script>

<style scoped>
#app {
    display: flex;
    min-height: 100vh;
    flex-direction: row;
}

.sidebar {
    width: 60px;
    background-color: #2c3e50;
    color: white;
    padding: 10px;
    transition: width 0.3s;
    flex-shrink: 0;
    position: relative;
    display: flex;
    /* เพิ่ม flexbox เพื่อจัดตำแหน่ง */
    justify-content: center;
    /* จัดตำแหน่งให้ปุ่มอยู่กลางในแนวนอน */
    align-items: center;
    /* จัดตำแหน่งให้ปุ่มอยู่กลางในแนวตั้ง */
}

.sidebar-expanded {
    width: 200px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar li {
    display: flex;
    align-items: center;
    /* จัดตำแหน่ง icon ให้อยู่กลางแนวตั้ง */
    justify-content: center;
    /* จัดตำแหน่ง icon ให้อยู่กลางแนวนอน */
    padding: 10px;
    cursor: pointer;
}

.sidebar .icon {
    font-size: 20px;
    margin-right: 10px;
}

.sidebar-toggle-btn {
    text-decoration: none;
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    font-size: 24px;
}

.sidebar a {
    text-decoration: none;
    color: white;
    /* ทำให้ข้อความมีสีขาว */
}

.sidebar a:hover {
    color: #f39c12;
    /* เปลี่ยนสีเมื่อ hover */
}

.main-content {
    flex: 1;
    /* ทำให้เนื้อหาหลักยืดได้เต็มพื้นที่ที่เหลือ */
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    padding: 15px;
}

.right-icons {
    position: absolute;
    right: 20px;
    display: flex;
    align-items: center;
}

.right-icons span {
    margin-left: 10px;
    cursor: pointer;
}

.content {
    flex: 1;
    padding: 20px;
    background-color: #c9c9c9;
    overflow-y: auto;
    /* ป้องกันไม่ให้เนื้อหาหลักยืดออกไปข้างนอก */
}

.footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 10px;
    position: relative;
    bottom: 0;
    width: 100%;
}

@media (max-width: 768px) {
    #app {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        position: absolute;
        z-index: 999;
        top: 0;
        left: 0;
        height: 100vh;
        display: none;
    }

    .sidebar-expanded {
        display: block;
    }

    .main-content {
        margin-left: 0;
    }

    .top-bar {
        padding: 10px;
        justify-content: space-between;
    }

    .footer {
        position: relative;
        bottom: auto;
    }
}

@media (min-width: 769px) {
    .sidebar {
        display: block;
    }
}
</style>