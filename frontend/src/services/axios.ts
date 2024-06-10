import Axios from 'axios';
import auth from './auth';

if (auth.isAuthenticated()) {
    Axios.defaults.headers.common['Authorization'] = `Bearer ${auth.getToken()}`;
}
Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default Axios;
