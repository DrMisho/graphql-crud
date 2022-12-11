<template>
    <div>
        <router-link :to="`/books/${book.id}`" class="h-64 mb-2">
            <img :src="book.image" alt="cover image" class="h-64 mb-2">
        </router-link>  
      <div class="w-3/5">
        <router-link :to="`/books/${book.id}`" class="text-lg font-bold text-black hover:text-gray-700 mb-3">
        {{ book.title }}
        </router-link>
        <div class="text-gray-600">{{ book.author }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BookListing",
    props: ['book']
}
</script>

<style>

</style>