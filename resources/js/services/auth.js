import axios from 'axios';

const API_URL = 'http://localhost:8000/api/'; 

export const AuthService = {
    login(user) {
        return axios
            .post(API_URL + 'login', {
                email: user.email,
                password: user.password,
            })
            .then(response => {
                if (response.data.token) {
                    localStorage.setItem('user', JSON.stringify(response.data));
                }
                return response.data;
            });
    },
    logout() {
        localStorage.removeItem('user');
    },
    register(user) {
        return axios.post(API_URL + 'register', user);
    },
};
