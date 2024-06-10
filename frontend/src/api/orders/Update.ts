import axios from '../../services/axios';

interface IndexReturnData {
    data: {
        id: string,
        product_id: number,
        quantity: number,
        user_id: number,
        status: string,
        created_at: string,
        updated_at: string
    };
    message: string;
}

interface orderData {
    data: {
        product_id: number,
        quantity: number,
        user_id: number,
        status: string,
        created_at: string,
        updated_at: string
    };
    message: string;
}

async function updateOrder(id: number, data: orderData): Promise<IndexReturnData> {
    try {
        const response = await axios.put<IndexReturnData>(`/api/v1/orders/${id}`, data);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao atualizar order');
    }
}

export default updateOrder;
