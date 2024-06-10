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

interface userData {
    data: {
        id: number,
        name: string,
        email: string,
        created_at: string,
        updated_at: string
    };
    message: string;
}

async function updateUser(id: number, data: userData): Promise<IndexReturnData> {
    try {
        const response = await axios.put<IndexReturnData>(`/api/v1/users/${id}`, data);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao atualizar usuário');
    }
}

export default updateUser;
