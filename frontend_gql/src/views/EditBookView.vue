<template>
  <div class="create container mt-12">
    <h1 class="mb-4">Edit Book</h1>
    <form action="" method="POST" @submit.prevent="editBook">
        <div class="form-group">
            <label class="text-bold" for="title">Title</label>
            <input class="border border-purple-800 border-radius h-8" type="text" name="title" id="title" v-model="title">
        </div>
        <div class="form-group">
            <label class="text-bold" for="author">Author</label>
            <input class="border border-purple-800 border-radius h-8" type="text" name="author" id="author" v-model="author">
        </div>
        <div class="form-group">
            <label class="text-bold" for="image">Image</label>
            <input class="border border-purple-800 border-radius h-8" type="text" name="image" id="image" v-model="image">
        </div>
        <div class="form-group">
            <label class="text-bold" for="description">Description</label>
            <textarea name="description" id="description" cols="50" rows="30" class="border border-purple-800 border-radius h-8" v-model="description"></textarea>
        </div>
        <div class="form-group">
            <label class="text-bold" for="link">Link</label>
            <input class="border border-purple-800 border-radius h-8" type="text" name="link" id="link" v-model="link">
        </div>
        <div class="form-group">
            <label class="text-bold"><input type="checkbox" name="featured" v-model="featured">Featured</label>
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
            result({ data }) {
                this.title = data.book.title
                this.author = data.book.author
                this.image = data.book.image
                this.link = data.book.link
                this.description = data.book.description
                this.featured = data.book.featured
                this.category = data.book.category.id
            },
        },

    },
}
</script>

<style scoped>
    .form-group {
        margin-bottom: 32px;
    }
    input[type="text"] textarea {
        padding: 10px 14px;
        border: 1px solid lightgray;
        border-radius: 5px;
    }
    label {
        display: block;
    }
    button {
        padding: 16px;
        background: #027BFF;
        color: white;
        border-radius: 5px;
        font-size: 16px;
    }
</style>