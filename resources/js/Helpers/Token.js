class Token {

    payload(token) {
        const payload = token.split('.')[1];
        // console.log(JSON.parse(atob(payload)));
        return JSON.parse(atob(payload))
    }

    isValid(token) {
        const payload = this.payload(token);
        if (payload) {
            return payload.iss == "http://127.0.0.1:8000/api/auth/login" ? true : false
        }
        
        return false;
        
    }

}

export default Token = new Token();