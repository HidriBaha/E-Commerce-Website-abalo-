<template>
    <div id="filter-div">
        <h2>Search Article</h2>
        <p>Search for:</p>
        <p>{{ message }}</p>
        Artikel suchen:
        <input id="filter" type="text" v-model="searchTerm" @input="handleInput" autofocus>
        <div id="gefundeneArtikel">
            <ul v-if="articles.length">
                <li v-for="item in articles" :key="item.id">
                    ID: {{ item.id }} Name: {{ item.ab_name }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import {ref, watch} from 'vue';
import axios from 'axios';

const name = "SearchArticleTab";
const message = ref('');
const searchTerm = ref('');
const articles = ref([]);
const offset = 0;
const limit = 5;

const emit = defineEmits(['isLoading']);

const handleInput = () => {
    if (searchTerm.value.length >= 3) {
        fetchArticles();
    } else if (searchTerm.value.length === 0) {
        articles.value = [];
    }
};

const fetchArticles = () => {
    emit('isLoading', true);

    axios
        .get(`/api/articles/?search=${searchTerm.value}&limit=${limit}&offset=${offset}`)
        .then(response => {
            articles.value = response.data;
            emit('isLoading', false);
        })
        .catch(error => {
            console.error(error);
            emit('isLoading', false);
        });
};

watch(searchTerm, handleInput);
</script>

<style scoped>
#gefundeneArtikel {
    margin-top: 15px;
}
</style>
