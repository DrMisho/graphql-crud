<template>
  <div class="home">
    <div class="hero bg-gray-300 mb-24">
      <div class="container flex flex-col lg:flex-row lg:justify-between py-10" >
        <div>
          <h1 class="w-full text-5xl lg:w-3/4">Book Recommendation site built with GraphQL</h1>
          <br>
          <p class="lg:w-3/4 mb-6">Built with Laravel(Lighthouse GraphQL), VueJS (vue-apollo) and Tailwind CSS</p>
          <div class="flex items-center">
            <a href="" class="bg-purple-400 text-white rounded px-4 py-4 mr-4 hover:bg-purple-100 hover:text-black">View Books</a>
            <a href="" class="border border-purple-800 border-solid text-purple-500 hover:text-white rounded px-4 py-4 mr-4 hover:bg-purple-500">
              View Screencasts
            </a>
          </div>
        </div>
        <div class="mt-10 lg:mt-0">
          <img src="../assets/images/Cart-Hero.png" alt="Hero" class="w-3/4">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-1/4 px-4 mb-12">
          <div class="bg-grey-400 h-12">
            <ApolloQuery :query="categoriesQuery">
              <!-- The result will automatically updated -->
              <template slot-scope="{ result: { data }, isLoading }">
                <!-- Some content -->
                <div v-if="isLoading">Loading...</div>
                <ul v-else class="text-lg">
                  <li class="mb-6">
                    <a href="#" class="text-black hover:text-gray-600" @click.prevent="selectCategory('all')">all Categories</a>
                  </li>
                  <li class="mb-6">
                    <a href="#" class="text-black hover:text-gray-600" @click.prevent="selectCategory('featured')">Featured</a>
                  </li>
                  <li href="#" v-for="category of data.categories" :key="category.id" @click.prevent="selectCategory(parseInt(category.id))" class="mb-6">
                    <a href="">{{ category.name }}</a>
                  </li>
                  <li class="mb-6">
                    <router-link to="/books/add">add a Book</router-link>
                  </li>
                </ul>
              </template>
            </ApolloQuery>
          </div>
        </div>
        <div class="w-full lg:w-3/4 px-4 mb-12">
            <ApolloQuery :query="query" v-if="selectedCategory === 'all'">
              <template slot-scope="{ result: { data }, isLoading }">
                <div v-if="isLoading">Loading...</div>
                <div v-else class="flex flex-wrap">
                  <div v-for="book of data.books" :key="book.id" class=" w-full lg:w-1/3 px-4 mb-12">
                    <book-listing :book="book"></book-listing>
                  </div>
                </div>
              </template>
            </ApolloQuery>
            <ApolloQuery :query="query" :variables="{featured : true}" v-else-if="selectedCategory === 'featured'">
              <template slot-scope="{ result: { data }, isLoading }">
                <div v-if="isLoading">Loading...</div>
                <div v-else class="flex flex-wrap">
                  <div v-for="book of data.booksByFeatured" :key="book.id"  class="w-full lg:w-1/3 px-4 mb-12">
                    <book-listing :book="book"></book-listing>
                  </div>
                </div>
              </template>
            </ApolloQuery>
            <ApolloQuery v-else :query="query" :variables="{id: selectedCategory}" >
              <template slot-scope="{ result: { data }, isLoading }">
                <div v-if="isLoading">Loading...</div>
                <div v-else class="flex flex-wrap">
                  <div v-for="book of data.category.books" :key="book.id"  class="w-full lg:w-1/3 px-4 mb-12">
                    <book-listing :book="book"></book-listing>
                  </div>
                </div>
              </template>
            </ApolloQuery>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import categoryQuery from '@/graphql/queries/Category.gql';
import booksQuery from '@/graphql/queries/Books.gql';
import categoriesQuery from '@/graphql/queries/Categories.gql';
import booksFeaturedQuery from '@/graphql/queries/BooksFeatured.gql';
import BookListing from '../components/BookListing.vue';

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
  components: {

    BookListing
  },
  methods: {
    selectCategory(category)
    {
      if (category === 'all')
      {
        this.query = booksQuery;
      }
      else if(category === 'featured')
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