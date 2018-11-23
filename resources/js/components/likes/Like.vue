<template>
    <div>
        <v-btn icon @click="clickAction">
            <v-icon :color="customColor">favorite</v-icon>{{likeCount}}
        </v-btn>
    </div>
</template>

<script>
export default {
    props:['data'],
    data() {
        return {
            likeCount: this.data.like_count,
            liked: this.data.liked,
        }
    },
    computed: {
        customColor() {
            return this.liked === true ? "red" : "red lighten-4";
        }
    },
    methods: {
        clickAction() {
            this.liked === true ? this.unlike() : this.like();
        },
        like(){
            this.likeCount += 1;
            this.liked = !this.liked;
        },
        unlike() {
            this.likeCount -= 1;
            this.liked = !this.liked;
        }
    }
}
</script>

<style>

</style>
