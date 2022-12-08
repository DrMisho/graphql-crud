<template>
  <div class="home">

  </div>
</template>

<script>
// @ is an alias to /src
import gql from 'graphql-tag'
export default {
  name: 'HomeView',
  apollo: {
    // Simple query that will update the 'hello' vue property
    hello: gql`query {
      hello
    }`
  }
}
</script>
