<template>
  <div class="book">
    <ApolloQuery :query="require('@/graphql/queries/Book.gql')" :variables="{id : this.$route.params.id}">
      <template slot-scope="{ result: { data }, isLoading }">
        <div v-if="isLoading">Loading...</div>
        <div v-else>
          <div>
            {{ data.book.title }}
          </div>
          <div>
            {{ data.book.author }}
          </div>
          <img :src="data.book.image" alt="cover image" style="width: 15%; height: 50%;">
          <div>
            <router-link :to="`/books/${data.book.id}/edit`" class="link-margin">Edit</router-link>
            <a href="#" class="link-margin" @click.prevent="deleteBook">Delete</a>
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