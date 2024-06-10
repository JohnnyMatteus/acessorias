import axios from '../../services/axios';

interface IndexReturnData {
    data: number;
    message: string;
}
interface LogoutData {
    email: string;
}

async function logout(data: LogoutData): Promise<IndexReturnData> {
    try {
        const response = await axios.post<IndexReturnData>('/api/v1/logout/', data);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao fazer logout');
    }
}

export default logout;
