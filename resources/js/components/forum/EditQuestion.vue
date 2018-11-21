<template>
    <v-container>
        <h1> Edit Question </h1>
        <v-form @submit.prevent="editQuestion">

            <v-text-field
            label="title"
            v-model="form.title"
            type="text"
            required
            ></v-text-field>

            <markdown-editor v-model="form.body"></markdown-editor>

            <v-btn
            color="green"
            type="submit">
            Save
            </v-btn>

            <v-btn
            @click="cancelEdit">
            Cancel
            </v-btn>
            
        </v-form>
    </v-container>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            form: {
                title: null,
                body: null,
            }
        }
    },
    methods:{
        cancelEdit() {
            EventBus.$emit('cancelEdit');
        },
        editQuestion() {
            axios.put(`/api/question/${this.data.slug}`,this.form)
            .then(res => {
                this.cancelEdit();
            })
            .catch(error => console.log(error));
        }
    },
    created() {
        this.form = this.data;
    }
}
</script>

<style>

</style>
