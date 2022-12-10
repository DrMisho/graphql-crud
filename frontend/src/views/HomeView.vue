<template>
  <div class="home">
    <ApolloQuery :query="gql => gql`query categories {categories {id name }}`">
      <template v-slot="{ result: { data, loading } }">
        <div v-if="loading">Loading...</div>
        <ul v-else>
          <li v-for="category of data.categories" :key="category.id" class="user">
            {{ category.name }}
          </li>
        </ul>
      </template>
    </ApolloQuery>
  </div>
</template>

<script>
// @ is an alias to /src
export default {
  name: 'HomeView'
}
</script>
