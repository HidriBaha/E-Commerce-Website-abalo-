<template>
    <div class="artikel">
        <h1 class="artikel__title">Artikel einkaufen</h1>
        <div id="filter-div" class="filter-div">
            <p class="filter-div__message">{{ message }}</p>
            <label for="filter" class="filter-div__label">Artikel suchen:</label>
            <input id="filter" type="text" @input="addEvent" v-model="searchText" class="filter-div__input search-input"><br>
            <div class="filter-div__articles articles-container">
                <div v-for="item in articles" :key="item.id" class="articles-container__card article-card">
                    <img :src="`/articelimages/${item.id}.jpg`" alt="Image" class="article-card__image img-thumbnail">
                    <div class="article-card__details article-details">
                        <p class="article-details__id">ID: {{ item.id }}</p>
                        <p class="article-details__name">Name: {{ item.ab_name }}</p>
                        <p class="article-details__price">Price: {{ item.ab_price +"€" }}</p>
                    </div>
                </div>
            </div>
            <div class="pagination-controls">
                <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
                <span>Page {{ currentPage }}</span>
                <button @click="nextPage" >Next</button>
            </div>
        </div>
    </div>
    <h2>Artikelübersicht</h2>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

// State variables
const message = ref(null);
const articles = ref([]);
const currentPage = ref(1);
const limit = 5;
const totalCount = ref(0);
const searchText = ref('');

// Methods
const addEvent = (event) => {
    searchText.value = event.target.value;
    sendAjax(searchText.value, currentPage.value);
};

const sendAjax = (text, page = 1) => {
    axios
        .get(`/api/articles/?search=${text}&limit=${limit}&offset=${(page - 1) * limit}`)
        .then((response) => {
            articles.value = response.data.articles;
            totalCount.value = response.data.count;
            console.log('Total count:', totalCount.value);
        })
        .catch((error) => console.log(error));
};

const nextPage = () => {
    currentPage.value++;
    sendAjax(searchText.value, currentPage.value);
};

const prevPage = () => {
    currentPage.value--;
    sendAjax(searchText.value, currentPage.value);
};
</script>

<style scoped>
#filter-div {
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 4px;
    max-width: 1000px;
    margin: auto;
}

.search-input {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.articles-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.article-card {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 200px;
    text-align: center;
}

.article-card img {
    width: 100%;
    height: auto;
    border-radius: 4px;
}

.article-details p {
    margin: 5px 0;
}

.pagination-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.pagination-controls button {
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.pagination-controls button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

.pagination-controls span {
    font-weight: bold;
}
</style>
