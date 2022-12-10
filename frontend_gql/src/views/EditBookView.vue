<template>
  <div class="create">
    <h1>Edit Book</h1>
    <form action="" method="POST" @submit.prevent="editBook">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" v-model="title">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" v-model="author">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" name="image" id="image" v-model="image">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" v-model="description">
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="text" name="link" id="link" v-model="link">
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="featured" v-model="featured">Featured</label>
        </div>
        <div class="form-group">
            <label for="link">Category</label>
            <ApolloQuery :query="require('@/graphql/queries/Categories.gql')">
                <!-- The result will automatically updated -->
                <template slot-scope="{ result: { data }, isLoading }">
                <!-- Some content -->
                <div v-if="isLoading">Loading...</div>
                <select v-else v-model="category">
                    <option v-for="category of data.categories" :key="category.id" :value="parseInt(category.id)">
                    {{ category.name }}
                    </option>
                </select>
                </template>
            </ApolloQuery>
        </div>
        <div class="form-group">
            <button type="submit">Edit a Book</button>
        </div>
    </form>
  </div>
</template>

<script>
import EditBook from '@/graphql/mutations/EditBook.gql';
import Book from '@/graphql/queries/Book.gql';
import gql from 'graphql-tag'
export default {
    name: "EditBookView",
    data() {
        return {
            title: null,
            author: null,
            image: null,
            link: null,
            description: null,
            category: 1,
            featured: null,
            book: null,
        }
    },
    methods: {
        editBook() {
            this.$apollo.mutate({
                mutation: EditBook,
                variables: {
                    id: this.$route.params.id,
                    title: this.title, 
                    author: this.author, 
                    image: this.image, 
                    link: this.link,
                    description: this.description, 
                    featured: this.featured,
                    category: parseInt(this.category)
                }
            }).then((data) => {
                console.log(data)
                this.$router.push(`/books/${this.$route.params.id}`)
            }).catch((error) => {
                console.log(error)
            })
        }
            
    },
    apollo: {
        // Simple query that will update the 'hello' vue property
        book: {
            query: Book,
            variables() {
                if (this.$route && this.$route.params)
                {
                    return {
                        id: this.$route.params.id
                    }
                }
            },
            result({ data, loading, networkStatus }) {
                this.title = data.book.title
                this.author = data.book.author
                this.image = data.book.image
                this.link = data.book.link
                this.description = data.book.description
                this.featured = data.book.featured
                this.category = data.category.id
            },
        },

    },
}
</script>

<style scoped>
    .form-group {
        margin-bottom: 32px;
    }
    input[type="text"] {
        padding: 10px 14px;
    }
    button {
        padding: 16px;
        background: #027BFF;
        color: white;
        border-radius: 5px;
        font-size: 16px;
    }
</style>