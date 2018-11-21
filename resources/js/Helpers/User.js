
import Token from './Token'
import AppStorage from './AppStorge';

class User {

    login(form) {
        axios.post('/api/auth/login',form)
            .then(res => {
                this.responseAfterLogin(res);
            })
            .catch(error => console.log(error))
    }

    responseAfterLogin(res) {

        const {access_token} = res.data
        const {user} = res.data;
        
        if (Token.isValid(access_token) == true) {
            AppStorage.store(access_token,user);
            window.location='/forum'
        }
        
    }

    hasToken() {
        const storedToken = AppStorage.getToken();

        if (storedToken) {
            return Token.isValid(storedToken) ? true : false;
        }
        return false
    }

    loggedIn() {
        return this.hasToken()
    }

    logout() {
        AppStorage.clear()
        window.location='/forum'
    }

    name() {
        if (this.loggedIn()) {
            return AppStorage.getUser()
        }
    }

    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub
        }
    }

    own(id) {
        return this.id() == id;
    }

}

export default User = new User();