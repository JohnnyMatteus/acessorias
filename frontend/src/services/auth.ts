export default {
    isAuthenticated() {
        const token = localStorage.getItem('access_token');
        return !!token;
    },
    login(token: string, email: string) {
        localStorage.setItem('access_token', token);
        localStorage.setItem('email', email);
    },
    logout() {
        localStorage.removeItem('access_token');
        localStorage.removeItem('email')
    },
    getToken() {
        return localStorage.getItem('access_token');
    },
};