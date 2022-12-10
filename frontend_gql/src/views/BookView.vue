<template>
  <div class="book">
    <ApolloQuery :query="require('@/graphql/queries/Book.gql')" :variables="{id : $route.params.id}">
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
        </div>
      </template>
    </ApolloQuery>
  </div>
</template>

<script>
export default {
    name: 'BookView'
}
</script>

<style>

</style>