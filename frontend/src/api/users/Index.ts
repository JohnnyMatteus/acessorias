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

async function indexUsers(): Promise<IndexReturnData> {
    try {
        const response = await axios.get<IndexReturnData>('/api/v1/users');
        return response.data;
    } catch (error) {
        throw new Error('Erro ao buscar usuários');
    }
}

export default indexUsers;
