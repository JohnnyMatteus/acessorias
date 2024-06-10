<script setup lang="ts">
import { ref } from 'vue';
import { useToast } from "vue-toastification";

const email = ref('');
const toast = useToast();
const router = useRouter();
import forgotUser from '@/api/auth/forgotUser';
import { useMutation } from '@tanstack/vue-query';
import { useRouter } from 'vue-router';

const emailValidated = localStorage.getItem('email');
if (!emailValidated) {
    toast.error('Acesso negado!');
    router.back();
}

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

    return true;
};

const mutation = useMutation(forgotUser, {
    onMutate: () => {
        toast.info('Loading...', {
            timeout: false,
            id: 'loading-toast',
        });
    },
    onSuccess: (response) => {
        toast.dismiss('loading-toast');
        if (response.data && response.data.status && response.data.valido) {

            toast.success('Dados confirmado com sucesso!');
            setTimeout(() => {
                router.push('/auth/reset-password');
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
            toast.error('Erro ao validar e-mail.');
            console.error('Erro ao validar registro:', error);
        }
    },
});

const submitForm = async () => {
    if (validateForm()) {
        mutation.mutate({
            email: email.value
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
                <v-btn size="large" rounded="pill" color="primary" class="rounded-pill" block type="submit" flat
                       @click="submitForm">
                    Recuperar</v-btn>
            </v-col>
        </v-row>
    </div>
</template>
