<script setup lang="ts">
import { ref } from 'vue';
import { useToast } from "vue-toastification";
import { useMutation } from '@tanstack/vue-query';
const email = ref('');
const password = ref('');
const toast = useToast();
import loginUser from '@/api/auth/loginUser';
import { useRouter } from 'vue-router';
import auth from '@/services/auth';

const router = useRouter();

const validateForm = () => {
    if (!email.value) {
        toast.error('O campo de e-mail é obrigatório.');
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email.value)) {
        toast.error('Por favor, insira um e-mail válido.');
        return false;
    }

    if (!password.value) {
        toast.error('O campo de senha é obrigatório.');
        return false;
    }

    if (password.value.length < 8) {
        toast.error('A senha deve ter pelo menos 8 caracteres.');
        return false;
    }

    return true;
};

const mutation = useMutation(loginUser, {
    onMutate: () => {
        toast.info('Loading...', {
            timeout: false,
            id: 'loading-toast',
        });
    },
    onSuccess: (response) => {
        toast.dismiss('loading-toast');
        if (response.data && response.data.access_token) {
            auth.login(response.data.access_token, email.value);
            toast.success('Login bem-sucedido!');
            setTimeout(() => {
                router.push('/sample-page');
            }, 150);
        } else {
            toast.error('Erro ao processar a resposta do servidor.');
        }
    },
    onError: (error) => {
        toast.dismiss('loading-toast');
        if (error.response && error.response.data && error.response.data.errors) {
            const errors = error.response.data.errors;
            Object.keys(errors).forEach((key) => {
                errors[key].forEach((message: string) => {
                    toast.error(message);
                });
            });
        } else {
            toast.error('Erro ao fazer login, tente mais tarde.');
            console.error('Erro LOGIN', error);
        }
    },
});

const submitForm = async () => {
    if (validateForm()) {
        mutation.mutate({
            email: email.value,
            password: password.value
        });
    }
};

</script>

<template>
    <div>
        <v-row class="mb-3">
            <v-col cols="12">
                <v-label class="font-weight-medium mb-1">E-mail</v-label>
                <v-text-field variant="outlined" v-model="email"
                              class="pwdInput" hide-details color="primary" type="email"></v-text-field>
            </v-col>
            <v-col cols="12">
                <v-label class="font-weight-medium mb-1">Senha</v-label>
                <v-text-field variant="outlined" v-model="password" class="border-borderColor" type="password" hide-details
                    color="primary"></v-text-field>
            </v-col>
            <v-col cols="12 " class="py-0">
                <div class="d-flex flex-wrap align-center w-100 ">
                    <div class="ml-sm-auto">
                        <RouterLink to="/auth/forgotd"
                            class="text-primary text-decoration-none text-body-1 opacity-1 font-weight-medium">
                            Esqueceu a senha ?</RouterLink>
                    </div>
                </div>
            </v-col>
            <v-col cols="12">
                <v-btn size="large" rounded="pill" color="primary" class="rounded-pill" block type="submit" flat
                       @click="submitForm">
                    Entrar</v-btn>
            </v-col>
        </v-row>
    </div>
</template>
