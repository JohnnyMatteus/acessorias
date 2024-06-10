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

interface productData {
    data: {
        id: string,
        name: string,
        description: string,
        stock: number,
        price: number,
        created_at: string,
        updated_at: string
    };
    message: string;
}

async function createProduct(productData: productData): Promise<IndexReturnData> {
    try {
        const response = await axios.post<IndexReturnData>('/api/v1/products', productData);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao buscar produtos');
    }
}

export default createProduct;
