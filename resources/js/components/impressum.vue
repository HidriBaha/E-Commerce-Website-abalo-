<script setup>
import { defineProps } from "vue";

const props = defineProps({
    isVisible: Boolean,
});
</script>

<template>
    <div v-if="isVisible" class="impressum">
        <h2 class="impressum__title">Impressum</h2>
        <p class="impressum__text">This is the impressum content. Here you can put your legal information, contact details, etc.</p>
        <div class="impressum__content">
            <p class="impressum__text"><strong>Angaben gemäß § 5 TMG</strong></p>
            <p class="impressum__text">

                FH Aachen<br>
                52066 Aachen<br>
            </p>
            <p class="impressum__text"><strong>Vertreten durch:</strong></p>
            <p class="impressum__text">Baha Eddine Hidri & Robin Berckhardt</p>
            <p class="impressum__text"><strong>Kontakt:</strong></p>
            <p class="impressum__text">
                Telefon: 01234-567890<br>
                E-Mail: Abalo.kontakt@mail.com
            </p>
            <p class="impressum__text"><strong>Umsatzsteuer-ID:</strong></p>
            <p class="impressum__text">Umsatzsteuer-Identifikationsnummer gemäß §27a Umsatzsteuergesetz: DE123456789</p>
        </div>
    </div>
</template>

<style scoped>
.impressum {
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    max-width: 600px;
    margin: 20px auto;
}

.impressum__title {
    font-size: 1.5em;
    margin-bottom: 20px;
    text-align: center;
}

.impressum__content {
    line-height: 1.6;
}

.impressum__text {
    margin-bottom: 10px;
}

.impressum__text strong {
    display: block;
    margin-bottom: 5px;
}
</style>
