<script setup>

import { ref } from 'vue';

const navItems = ref([
    {
        name: "Home",
        subItems: [],
        ref: "/home"
    },
    {
        name: "Kategorien",
        subItems: [],
        ref: "/categories"
    },
    {
        name: "Verkaufen",
        subItems: [],
        ref: "/sell"
    },
    {
        name: "Unternehmen",
        subItems: [
            {
                name: "Philosophie",
                subItems: [],
                ref: "/philosophy"
            },
            {
                name: "Karriere",
                subItems: [],
                ref: "/career"
            }
        ],
        ref: "/company"
    }
]);
</script>


<template>
    <div>
        <nav id="navmenu">
            <ul>
                <!-- Main navigation items -->
                <li v-for="item in navItems" :key="item.name">
                    <a :href="item.ref">{{ item.name }}</a>
                    <!-- Check if there are subItems -->
                    <ul v-if="item.subItems.length > 0">
                        <li v-for="subItem in item.subItems" :key="subItem.name">
                            <a :href="subItem.ref">{{ subItem.name }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</template>

<style scoped>

</style>
