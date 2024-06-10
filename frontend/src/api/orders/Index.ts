import axios from '../../services/axios';

interface IndexReturnData {
    data: {
        product_id: number,
        quantity: number,
        user_id: number,
        status: string,
        created_at: string,
        updated_at: string,
        product: string,
        user: string
    };
    message: string;
}

async function indexOrders(): Promise<IndexReturnData> {
    try {
        const response = await axios.get<IndexReturnData>('/api/v1/orders');
        return response.data;
    } catch (error) {
        throw new Error('Erro ao buscar orders');
    }
}

export default indexOrders;
