<template>
    <div>
        <div v-if="editing">
            <edit-question 
            :data=question
            v-if="question">
            </edit-question>
        </div>
        <div v-else>
            <show-question 
            :data=question
            v-if="question">
            </show-question>
        </div>
    </div>
    
    
</template>

<script>
import ShowQuestion from './ShowQuestion';
import EditQuestion from './EditQuestion';

export default {
    components: {ShowQuestion,EditQuestion},
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
