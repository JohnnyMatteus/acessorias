import axios from '../../services/axios';

interface IndexReturnData {
    data: {
        name: string,
        description: string,
        stock: number,
        price: number,
        created_at: string,
        updated_at: string
    };
    message: string;
}

async function indexProducts(): Promise<IndexReturnData> {
    try {
        const response = await axios.get<IndexReturnData>('/api/v1/products');
        return response.data;
    } catch (error) {
        throw new Error('Erro ao buscar produtos');
    }
}

export default indexProducts;
