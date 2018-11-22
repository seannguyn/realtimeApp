<template>
    <div class="mt-5 mb-3">
        <markdown-editor v-model="form.body"></markdown-editor>

        <v-btn dark color="green" @click="newReply">Reply</v-btn>
    </div>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            form: {
                body: "",
            }
        }
    },
    methods: {
        newReply() {
            if (this.form.body.length > 0) {
                axios.post(`/api/question/${this.data.slug}/reply`,this.form)
                .then(res => { 
                    console.log(res.data.reply);
                    this.form.body="";
                    window.scrollTo(0,0);
                    EventBus.$emit('newReply',res.data.reply);
                    
                })
                .catch(error => console.log(error))
            }
            
        }
    }
}
</script>

<style>

</style>
