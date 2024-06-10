import axios from 'axios';

interface LoginData {
    email: string;
    password: string;
}

interface UserData {
    token: string;
}

async function loginUser(loginData: LoginData): Promise<UserData> {
    try {
        const response = await axios.post<UserData>('/api/auth/login', loginData);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao fazer login');
    }
}

export default loginUser;
