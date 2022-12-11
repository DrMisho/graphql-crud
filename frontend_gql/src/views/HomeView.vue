<template>
  <div class="home">
    <div class="hero bg-gray-300 mb-24">
      <div class="container grid gap-10 grid-cols-2 items-center">
        <div>
          <h1 class="text-5xl w-3/4">Book Recommendation site built with GraphQL</h1>
          <br>
          <p class="w-3/4 mb-6">Built with Laravel(Lighthouse GraphQL), VueJS (vue-apollo) and Tailwind CSS</p>
          <div class="flex items-center">
            <a href="" class="bg-purple-400 text-white rounded px-4 py-4 mr-4 hover:bg-purple-100 hover:text-black">View Books</a>
            <a href="" class="border border-purple-800 border-solid text-purple-500 hover:text-white rounded px-4 py-4 mr-4 hover:bg-purple-500">
              View Screencasts
            </a>
          </div>
        </div>
        <div>
          <img src="../assets/images/Cart-Hero.png" alt="Hero" class="w-3/4">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="flex flex-wrap -mx-4">
        <div class="w-1/4 px-4 mb-12">
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
                  <li href="#" v-for="category of data.categories" :key="category.id" @click.prevent="selectCategory(category.id)" class="mb-6">
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
        <div class="w-3/4 px-4 flex flex-wrap mb-12">
          <div>
            <ApolloQuery :query="query" v-if="selectedCategory === 'all'">
              <template slot-scope="{ result: { data }, isLoading }">
                <div v-if="isLoading">Loading...</div>
                <div v-else class="flex flex-wrap">
                  <div v-for="book of data.books" :key="book.id" class="w-1/3 px-4 mb-12">
                    <router-link :to="`/books/${book.id}`" >
                      <img :src="book.image" alt="cover image" class="h-64 mb-2">
                    </router-link>
                    <div class="w-3/5">
                      <router-link :to="`/books/${book.id}`" class="text-lg font-bold text-black hover:text-gray-700 mb-3">
                        {{ book.title }}
                      </router-link>
                      <div class="text-gray-600">{{ book.author }}</div>
                    </div>
                  </div>
                </div>
              </template>
            </ApolloQuery>
            <ApolloQuery :query="query" :variables="{featured : true}" v-else-if="selectedCategory === 'featured'">
              <template slot-scope="{ result: { data }, isLoading }">
                <div v-if="isLoading">Loading...</div>
                <div v-else class="flex flex-wrap">
                  <div v-for="book of data.booksByFeatured" :key="book.id"  class="w-1/3 px-4 mb-12">
                    <router-link :to="`/books/${book.id}`" >
                      <img :src="book.image" alt="cover image" class="h-64 mb-2">
                    </router-link>
                    <div class="w-3/5">
                      <router-link :to="`/books/${book.id}`" class="text-lg font-bold text-black hover:text-gray-700 mb-3" >
                        {{ book.title }}
                      </router-link>
                      <div class="text-gray-600">{{ book.author }}</div>
                    </div>
                  </div>
                </div>
              </template>
            </ApolloQuery>
            <ApolloQuery :query="query" :variables="{id: selectedCategory}" v-else>
              <template slot-scope="{ result: { data }, isLoading }">
                <div v-if="isLoading">Loading...</div>
                <div v-else class="flex flex-wrap">
                  <div v-for="book of data.category.books" :key="book.id"  class="w-1/3 px-4 mb-12">
                    <router-link :to="`/books/${book.id}`" >
                      <img :src="book.image" alt="cover image" class="h-64 mb-2">
                    </router-link>
                    <div class="w-3/5">
                      <router-link :to="`/books/${book.id}`"  class="text-lg font-bold text-black hover:text-gray-700 mb-3">
                        {{ book.title }}
                      </router-link>
                      <div class="text-gray-600">{{ book.author }}</div>
                    </div>
                  </div>
                </div>
              </template>
            </ApolloQuery>
          </div>
        </div>
      </div>
    </div>

    
    

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