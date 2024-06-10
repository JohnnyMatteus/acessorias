import axios from 'axios';

interface RegisterData {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
}

interface ResponseData {
    data: {
        access_token: string;
        status: boolean;
    };
    message: string;
}

export default async function registerUser(registerData: RegisterData): Promise<ResponseData> {
    const response = await axios.post<ResponseData>('/api/auth/register', registerData);
    return response.data;
}
