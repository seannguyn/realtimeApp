<template>
    <v-container>
        <v-form @submit.prevent="signup">

            <v-text-field
            label="Email"
            v-model="form.email"
            type="email"
            required
            ></v-text-field>
            <span class="red--text" v-if="error.email ">{{error.email[0]}}</span>

            <v-text-field
            label="Name"
            v-model="form.name"
            type="text"
            required
            ></v-text-field>
            <span class="red--text" v-if="error.name ">{{error.name[0]}}</span>

            <v-text-field
            label="Password"
            v-model="form.password"
            type="password"
            required
            ></v-text-field>
            <span class="red--text" v-if="error.password ">{{error.password[0]}}</span>

            <v-text-field
            label="Confirm Password"
            v-model="form.password_confirmation"
            type="password"
            required
            ></v-text-field>
            <span class="red--text" v-if="error.password ">{{error.password[0]}}</span>

            <v-btn
            type="submit">
            SignUp
            </v-btn>

            <router-link to="/login">
                <v-btn
                color="green">
                Login
                </v-btn>
            </router-link>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            error: {}
        }
    },
    created() {
        if (User.loggedIn() == true) {
            this.$router.push({name:'forum'})
        }
    },
    methods: {
        signup() {

            axios.post('api/auth/signup',this.form)
            .then(res => {
                User.responseAfterLogin(res);
            })
            .catch(errorMsg => console.log(errorMsg))

            this.$router.push({name:'forum'})
        }
    }
}
</script>

<style>

</style>
