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

async function createOrder(data: orderData): Promise<IndexReturnData> {
    try {
        const response = await axios.post<IndexReturnData>('/api/v1/orders', data);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao buscar produtos');
    }
}

export default createOrder;
