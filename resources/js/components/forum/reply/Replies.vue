<template>
    <div>
        <reply v-for="reply in replies" :key=reply.id :data=reply :question_slug=data.slug></reply>
    </div>    
</template>

<script>
import Reply from './Reply';
export default {
    data() {
        return {
            replies: this.data.replies
        }
    },
    components:{Reply,},
    props: ['data'],
    created() {
        this.listen();
    },
    methods: {
        listen() {
            EventBus.$on('newReply', ($reply) => {
                this.replies.unshift($reply);
            })

            EventBus.$on('deleteReply', ($reply) => {
                const newReplies = this.replies.filter((eachReply) => eachReply.id !== $reply.id)
                this.replies = newReplies;
            })

            EventBus.$on('editReply', ($reply) => {
                const newReplies = this.replies.map((eachReply) => eachReply.id === $reply.id ? (eachReply = $reply): eachReply)
                this.replies = newReplies;
            })
        }
    }
}
</script>

<style>

</style>
