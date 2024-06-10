import axios from 'axios';

interface resetData {
    email: string;
    password: string;
    password_confirmation: string;
}

interface UserData {
    data: {
        atualizado: string;
        status: boolean;
    };
    message: string;
}

async function resetPasseordUser(resetData: resetData): Promise<UserData> {
    try {
        const response = await axios.post<UserData>('/api/auth/registerNewPassword', resetData);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao alterer a senha');
    }
}

export default resetPasseordUser;
