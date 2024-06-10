import axios from '../../services/axios';

interface IndexReturnData {
    data: {};
    message: string;
}

async function deleteOrder(id: number): Promise<IndexReturnData> {
    try {
        const response = await axios.delete<IndexReturnData>(`/api/v1/orders/${id}`);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao apagar order');
    }
}

export default deleteOrder;
