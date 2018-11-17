class Token {

    payload(token) {
        const payload = token.split('.')[1];
        // console.log(JSON.parse(atob(payload)));
        return JSON.parse(atob(payload))
    }

    isValid(token) {
        const issLogin = "http://127.0.0.1:8000/api/auth/login";
        const issSignup = "http://127.0.0.1:8000/api/auth/signup";        
        
        const payload = this.payload(token);
        
        if (payload) {
            return payload.iss == issSignup || issLogin ? true : false
        }

        return false;
        
    }

}

export default Token = new Token();