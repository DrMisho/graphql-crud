<template>
  <div class="home">
    <ApolloQuery :query="categoriesQuery">
    <!-- The result will automatically updated -->
    <template slot-scope="{ result: { data }, isLoading }">
      <!-- Some content -->
      <div v-if="isLoading">Loading...</div>
      <div v-else>
        <a href="#" class="link-margin" @click.prevent="selectCategory('all')">all Categories</a>
        <a href="#" class="link-margin" @click.prevent="selectCategory('featured')">Featured</a>
        <a href="#" v-for="category of data.categories" :key="category.id" @click.prevent="selectCategory(category.id)" class="link-margin">
          {{ category.id }} - {{ category.name }}
        </a>
      </div>
    </template>
  </ApolloQuery>

  <div v-if="selectedCategory === 'all'">
    <ApolloQuery :query="query">
      <template slot-scope="{ result: { data }, isLoading }">
        <div v-if="isLoading">Loading...</div>
        <div v-else>
          <div v-for="book of data.books" :key="book.id" class="link-margin">
            <router-link :to="`/books/${book.id}`" >
              {{ book.id }} - {{ book.title }}
            </router-link>
            <div>{{ book.author }}</div>
            <img :src="book.image" alt="cover image" style="width: 15%; height: 50%;">
          </div>
        </div>
      </template>
    </ApolloQuery>
  </div>

  <div v-else-if="selectedCategory === 'featured'">
    <ApolloQuery :query="query" :variables="{featured : true}">
      <template slot-scope="{ result: { data }, isLoading }">
        <div v-if="isLoading">Loading...</div>
        <div v-else>
          <div v-for="book of data.booksByFeatured" :key="book.id" class="link-margin">
            <router-link :to="`/books/${book.id}`" >
              {{ book.id }} - {{ book.title }}
            </router-link>
            <div>{{ book.author }}</div>
            <img :src="book.image" alt="cover image" style="width: 15%; height: 50%;">
          </div>
        </div>
      </template>
    </ApolloQuery>
  </div>

  <div v-else>
    <ApolloQuery :query="query" :variables="{id: selectedCategory}">
      <template slot-scope="{ result: { data }, isLoading }">
        <div v-if="isLoading">Loading...</div>
        <div v-else>
          <div v-for="book of data.category.books" :key="book.id" class="link-margin">
            <router-link :to="`/books/${book.id}`"  >
              {{ book.id }} - {{ book.title }}
            </router-link>
            <div>{{ book.author }}</div>
            <img :src="book.image" alt="cover image" style="width: 15%; height: 50%;">
          </div>
        </div>
      </template>
    </ApolloQuery>
  </div>

  </div>
</template>

<script>
// @ is an alias to /src
import categoryQuery from '@/graphql/queries/Category.gql';
import booksQuery from '@/graphql/queries/Books.gql';
import categoriesQuery from '@/graphql/queries/Categories.gql';
import booksFeaturedQuery from '@/graphql/queries/BooksFeatured.gql';


export default {
  name: 'HomeView',
  data()
  {
    return {
      categoriesQuery,
      categoryQuery,
      booksQuery,
      booksFeaturedQuery,
      selectedCategory: 'all',
      query: booksQuery,
      categories : []
    }
  },
  methods: {
    selectCategory(category)
    {
      if (category == 'all')
      {
        this.query = booksQuery;
      }
      else if(category == 'featured')
      {
        this.query = booksFeaturedQuery;
      }
      else
      {
        this.query = categoryQuery;
      }
      this.selectedCategory = category;
    }
  }
}
</script>

<style>
.link-margin {
  margin-right: 24px;
}
</style>