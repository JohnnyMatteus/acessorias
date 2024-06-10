import axios from '../../services/axios';

interface IndexReturnData {
    data: {};
    message: string;
}

async function deleteUser(id: number): Promise<IndexReturnData> {
    try {
        const response = await axios.delete<IndexReturnData>(`/api/v1/users/${id}`);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao apagar usuário');
    }
}

export default deleteUser;
