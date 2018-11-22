<template>
    <div class="mt-3">
        <v-card>
          <v-card-title>
              <div class="headline">{{reply.user}}</div>
              <div class="ml-2">said {{reply.created_at}}</div>
              <v-spacer></v-spacer>
          </v-card-title>
          <v-divider></v-divider>

        <div v-if="!editing">
            <v-card-text v-html="replyParse"></v-card-text>
            
            <v-card-actions v-if="own">
                <v-btn icon small @click="editMode">
                    <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn icon small @click="deleteReply">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </div>

        <div v-else>
            <edit-reply :data=reply></edit-reply>
        </div>
        
      </v-card>
    </div>
    
</template>

<script>

import EditReply from './EditReply'

export default {
    components: {EditReply,},
    data() {
        return {
            reply: {},
            own: false,
            editing: false,
        }
    },
    props: ['data','question_slug'],
    created() {
        this.reply = this.data;
        this.own = User.own(this.reply.user_id);
        this.listen();
    },
    computed:{
        replyParse(){
            return md.parse(this.reply.reply)
        }
    },
    methods: {
        deleteReply() {
            axios.delete(`/api/question/${this.question_slug}/reply/${this.reply.id}`)
            .then(res => EventBus.$emit('deleteReply', this.reply))
            .catch(error => console.log(error));
        },
        editMode() {
            this.editing = true;
        },
        listen() {
            EventBus.$on('editReply',($reply) => {
                this.editing = false;
            })

            EventBus.$on('cancelReply',() => {
                this.editing = false;
            })
        }
    }
}
</script>

<style>

</style>
