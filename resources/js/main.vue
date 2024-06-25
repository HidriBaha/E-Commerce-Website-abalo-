<script setup>
import { ref } from 'vue';
import siteHeader from './components/siteHeader.vue';
import siteFooter from "./components/siteFooter.vue";
import Impressum from "./components/impressum.vue";
import articleSearch from "./components/articleSearch.vue";
import SiteBody from "./components/siteBody.vue";

const isImpressumVisible = ref(false);
const toggleImpressum = () => {
    isImpressumVisible.value = !isImpressumVisible.value;
};
</script>

<template>  <div id="app">
    <siteHeader></siteHeader>
    <siteBody @toggleImpressum="toggleImpressum" />

    <impressum :isVisible="isImpressumVisible" />
    <articleSearch v-if="!isImpressumVisible" />

    <siteFooter></siteFooter>
</div>

</template>

<style scoped>

</style>
