<script setup lang="ts">
import { ref } from 'vue';
import { useToast } from 'vue-toastification';
import { useMutation } from '@tanstack/vue-query';
import registerUser from '@/api/auth/registerUser';
import { useRouter } from 'vue-router';

const email = ref('');
const name = ref('');
const password = ref('');
const toast = useToast();
const router = useRouter();

const validateForm = () => {
    if (!name.value) {
        toast.error('O campo de nome é obrigatório.');
        return false;
    }
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

const mutation = useMutation(registerUser, {
    onMutate: () => {
        toast.info('Loading...', {
            timeout: false,
            id: 'loading-toast',
        });
    },
    onSuccess: (response) => {
        toast.dismiss('loading-toast');
        if (response.data && response.data.access_token) {
            localStorage.setItem('access_token', response.data.access_token);
            toast.success('Cadastro bem-sucedido!');
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
            toast.error('Erro ao fazer registro.');
            console.error('Erro ao fazer registro:', error);
        }
    },
});

const submitForm = async () => {
    if (validateForm()) {
        mutation.mutate({
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password.value
        });
    }
};
</script>

<template>
    <v-row class="d-flex mb-3">
        <v-col cols="12">
            <v-label class="font-weight-medium mb-1">Nome</v-label>
            <v-text-field variant="outlined" v-model="name" hide-details color="primary"></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-label class="font-weight-medium mb-1">Endereço de e-mail</v-label>
            <v-text-field variant="outlined" v-model="email" type="email" hide-details color="primary"></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-label class="font-weight-medium mb-1">Senha</v-label>
            <v-text-field variant="outlined" v-model="password" type="password" hide-details color="primary"></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-btn size="large" rounded="pill" color="primary" class="rounded-pill" block type="submit" flat
                   @click="submitForm">
                Cadastrar
            </v-btn>
        </v-col>
    </v-row>
</template>
