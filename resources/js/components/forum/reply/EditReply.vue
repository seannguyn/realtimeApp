<template>
    <div>
        <markdown-editor v-model="data.reply"></markdown-editor>

        <v-btn dark color="green" @click="editReply">Save</v-btn>
        <v-btn dark color="black" @click="cancelReply">Cancel</v-btn>
    </div>
    
</template>

<script>
export default {
    props: ['data'],
    methods:{
        editReply() {
            axios.put(`/api/question/${this.data.question_slug}/reply/${this.data.id}`,{body: this.data.reply})
            .then(res => EventBus.$emit('editReply',this.data))
            .catch(erroe => console.log(error))
            
        },
        cancelReply() {
            EventBus.$emit('cancelReply')
        }
    }
}
</script>

<style>

</style>
