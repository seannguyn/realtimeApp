<template>
      <v-card class="mt-3">
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">
                <router-link :to="question.path">
                    {{question.title}}
                </router-link>
                
            </h3>
            <div class="grey--text">
                {{question.user}} posted {{question.created_at}}
            </div>
          </div>
        </v-card-title>
        <v-card-text>
            {{question.body}}
        </v-card-text>
      </v-card>
</template>

<script>
export default {
    props: ['question'],
}
</script>

<style>

</style>


// :to="{ path: question.path, name: 'read', params: { question: question } }"