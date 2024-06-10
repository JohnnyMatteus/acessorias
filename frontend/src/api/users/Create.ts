import axios from '../../services/axios';

interface IndexReturnData {
    data: {
        id: number,
        name: string,
        email: string,
        created_at: string,
        updated_at: string
    };
    message: string;
}

interface usersData {
    data: {
        id: number,
        name: string,
        email: string,
        created_at: string,
        updated_at: string
    };
    message: string;
}

async function createUser(data: usersData): Promise<IndexReturnData> {
    try {
        const response = await axios.post<IndexReturnData>('/api/v1/users', data);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao registrar usuário');
    }
}

export default createUser;
