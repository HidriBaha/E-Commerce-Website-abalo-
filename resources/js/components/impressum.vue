<script setup>
import{ref} from "vue";

const props = defineProps({
    isVisible: Boolean,
});
</script>

<template>
<div v-if="isVisible" class="impressum">
    <h2>Impressum</h2>
    <p>This is the impressum content. Here you can put your legal information, contact details, etc.</p>


</div>
</template>

<style scoped>
.impressum {
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #ddd;
    margin: 10px 0;
}
</style>
