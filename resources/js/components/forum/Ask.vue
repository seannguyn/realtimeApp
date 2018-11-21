<template>
    <v-container>
        <v-form @submit.prevent="askQuestion">

            <v-text-field
            label="title"
            v-model="form.title"
            type="text"
            required
            ></v-text-field>

            <v-autocomplete
            v-model="form.category_id"
            :items="categories"
            item-text="name"
            item-value="id"
            label="Category"
            autocomplete
            ></v-autocomplete>

            <markdown-editor v-model="form.body"></markdown-editor>

            <v-btn
            color="green"
            type="submit">
            Ask
            </v-btn>
            
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                title: null,
                category_id: null,
                body: null,
            },
            categories: []
        }
    },
    created() {
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    },
    methods: {
        askQuestion() {
            axios.post('/api/question',this.form)
            .then(res => {
                console.log(res.data);
                this.$router.push(res.data.path);
            })
            .catch(error => console.log(error))
        }
    }
}
</script>

<style>

</style>
