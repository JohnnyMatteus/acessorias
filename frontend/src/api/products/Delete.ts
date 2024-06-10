import axios from '../../services/axios';

interface IndexReturnData {
    data: {};
    message: string;
}

async function deleteProduct(id: string): Promise<IndexReturnData> {
    try {
        const response = await axios.delete<IndexReturnData>(`/api/v1/products/${id}`);
        return response.data;
    } catch (error) {
        throw new Error('Erro ao buscar produtos');
    }
}

export default deleteProduct;
