<template>
  <div class="book container">
    <ApolloQuery :query="require('@/graphql/queries/Book.gql')" :variables="{id : this.$route.params.id}">
      <template slot-scope="{ result: { data }, isLoading }">
        <div v-if="isLoading">Loading...</div>
        <div v-else class="flex mt-16 flex-col lg:flex-row">
          <div class="w-full lg:w-1/3 ml-0 mt-8 lg:mt-0 lg:ml:16 px-3 lg:px-4">
            <img :src="data.book.image" alt="cover image">
          </div>
          <div class="w-full lg:w-2/3 ml-0 mt-8 lg:mt-0 lg:ml:16">
            <div class="text-4xl font-bold">
              {{ data.book.title }}
            </div>
            <div class="text-2xl text-gray-700 mb-8">
              {{ data.book.author }}
            </div>
            <div class="text-lg text-gray-700 leading-normal">
              {{ data.book.description }}
            </div>
            <div class="my-12">
              <a :href="data.book.link" target="_blank" class="border border-purple-700 border-solid rounded text-purple-800 px-4 py-4 hover:bg-purple-700 hover:text-white">Link</a>
            </div>
            <div class="text-lg text-gray-700 leading-normal">
              <router-link :to="`/books/${data.book.id}/edit`" class="link-margin">Edit</router-link>
              <a href="#" class="link-margin" @click.prevent="deleteBook">Delete</a>
            </div>
          </div>
        </div>
      </template>
    </ApolloQuery>
  </div>
</template>

<script>
import DeleteBook from '@/graphql/mutations/DeleteBook.gql';
export default {
  name: 'BookView',
    methods: {
      deleteBook()
      {
        this.$apollo.mutate({
          mutation: DeleteBook,
          variables: {
            id: this.$route.params.id,
          }
        }).then((data) => {
          console.log(data);
          this.$router.push('/');
        })
      }
    },
}
</script>

<style>

</style>