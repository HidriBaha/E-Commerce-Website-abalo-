<script setup>
//import { toggleVisibility } from './impressum.vue'; // Import the toggle method
//import articleSearch from "./components/articleSearch.vue";
import { defineEmits } from 'vue';

const emit = defineEmits(['toggleImpressum']);

const showImpressum = () => {
    emit('toggleImpressum');
};
</script>

<template>
    <a href="#" @click.prevent="showImpressum">Impressum</a>
</template>

<style scoped>

</style>
