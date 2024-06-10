import axios from 'axios';

interface forgotData {
    email: string;
}

interface UserData {
    data: {
        validado: string;
        status: boolean;
    };
    message: string;
}

async function forgotUser(forgotData: forgotData): Promise<UserData> {
    try {
        const response = await axios.post<UserData>('/api/auth/forgot-password', forgotData);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao fazer recuperar senha');
    }
}

export default forgotUser;
