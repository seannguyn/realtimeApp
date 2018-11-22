<template>
    <div v-if="question">
        <div v-if="editing">
            <edit-question 
            :data=question
            v-if="question">
            </edit-question>
        </div>
        <div v-else>
            <show-question 
            :data=question>
            </show-question>
        </div>

        <v-container>
            <replies :data=question></replies>
            <v-divider></v-divider>
            <new-reply :data=question></new-reply>
        </v-container>
        
    </div>
    
    
</template>

<script>
import ShowQuestion from './ShowQuestion';
import EditQuestion from './EditQuestion';
import Replies from './reply/Replies';
import NewReply from './reply/NewReply';

export default {
    components: {ShowQuestion,EditQuestion,Replies,NewReply,},
    data() {
        return {
            question: null,
            editing: false,
        }
    },
    created() {
        this.getQuestion();
        this.listen();
    },
    methods: {
        listen() {
            EventBus.$on('editing',() => {
                this.editing = true;
            });

            EventBus.$on('cancelEdit',() => {
                this.editing = false;
            });
        },
        getQuestion() {
            axios.get(`/api/question/${this.$route.params.slug}`).then(res => {this.question=res.data.data})
        }
    }
}
</script>

<style>

</style>
