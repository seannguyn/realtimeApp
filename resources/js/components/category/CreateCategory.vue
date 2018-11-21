<template>
    <v-container>
        <v-form @submit.prevent="createCategory">

            <v-text-field
            label="Category"
            v-model="form.name"
            type="text"
            required
            ></v-text-field>

            <div v-if="editMode">
                <v-btn
                color="pink"
                @click="updateCategory">
                Update
                </v-btn>

                <v-btn
                color="grey"
                @click="cancel">
                Cancel
                </v-btn>
            </div>

            <div v-else>
                <v-btn
                color="green"
                type="submit">
                Create
                </v-btn>
            </div>
            

        </v-form>
        <v-card class="mt-4">
          <v-toolbar color="indigo" dark dense>
          <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>

        <v-list>
            <div v-for="(category,index) in categories" :key="category.id">
                <v-list-tile>

                <v-list-tile-action>
                    <v-btn icon small @click="editCategory(category.slug, index)">
                        <v-icon color="orange">edit</v-icon>
                    </v-btn>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>
                        {{category.name}}
                    </v-list-tile-title>
                </v-list-tile-content>

                <v-list-tile-action>
                    <v-btn icon small @click="deleteCategory(category.slug,index)">
                        <v-icon color="red">delete</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
            <v-divider></v-divider>
            </div>
        </v-list>
      </v-card>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: null,
            },
            categories: [],
            editMode: false,
            editingCategory: {}
        }
    },
    created() {
        if (!User.admin()) {
            this.$router.push('/forum');
        } else {
            this.fetchCategory();
        }
        
    },
    methods: {
        createCategory() {
            axios.post('/api/category',this.form)
            .then(res => {
                this.categories.unshift(res.data);
                this.form.name = null;
            })
            .catch(error => console.log(error));
        },
        updateCategory() {
            axios.put(`/api/category/${this.editingCategory.slug}`,this.form)
            .then(res => {
                this.categories.unshift(res.data);
                this.clear();
            })
        },
        fetchCategory() {
            axios.get('/api/category')
            .then(res => {
                this.categories = res.data.data                
            })
            .catch(error => console.log(error))
        },
        deleteCategory(slug,index) {
            axios.delete(`/api/category/${slug}`)
            .then(res => {
                this.categories.splice(index,1);  
            })
            .catch(error => console.log(error))
        },
        editCategory(slug, index) {
            this.editMode = true;
            this.editingCategory = this.categories[index];
            this.form.name = this.editingCategory.name;
            this.categories.splice(index,1);
        },
        cancel() {
            
            this.categories.unshift(this.editingCategory)
            this.clear();
        },

        clear() {
            this.editMode = false;
            this.form.name = null;
            this.editingCategory = {};
        }

    }
}
</script>

<style>

</style>
