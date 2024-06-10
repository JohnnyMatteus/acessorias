<script setup lang="ts">
import { ref } from 'vue';
import { useToast } from "vue-toastification";

const password = ref('');
const password_confirm = ref('');
const toast = useToast();
const router = useRouter();
import resetPasseordUser from '@/api/auth/resetPasswordUser';
import { useMutation } from '@tanstack/vue-query';
import { useRouter } from 'vue-router';

const email = localStorage.getItem('email');
if (!email) {
    toast.error('Acesso negado!');
    router.push('/auth/login');
}
const validateForm = () => {
    if (!password.value) {
        toast.error('O campo de nova senha é obrigatório.');
        return false;
    }

    if (password.value.length < 8) {
        toast.error('A senha deve ter pelo menos 8 caracteres.');
        return false;
    }

    if (!password_confirm.value) {
        toast.error('O campo de confirmação de senha é obrigatório.');
        return false;
    }

    if (password.value !== password_confirm.value) {
        toast.error('A confirmação de senha não corresponde.');
        return false;
    }

    return true;
};

const mutation = useMutation(resetPasseordUser, {
    onMutate: () => {
        toast.info('Loading...', {
            timeout: false,
            id: 'loading-toast',
        });
    },
    onSuccess: (response) => {
        toast.dismiss('loading-toast');
        if (response.data && response.data.status && response.data.atualizado) {
            localStorage.removeItem('email');
            toast.success('Senha atualizada sucesso!');
            setTimeout(() => {
                router.push('/auth/login');
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
            toast.error('Erro ao atualizar senha.');
            console.error('Erro ao validar registro:', error);
        }
    },
});

const submitForm = async () => {
    if (validateForm()) {
        const emailFromStorage = localStorage.getItem('email');
        if (!emailFromStorage) {
            toast.error("E-mail não encontrado.");
            return;
        }
        mutation.mutate({
            email: emailFromStorage,
            password: password.value,
            password_confirmation: password_confirm.value
        });
    }
};
</script>

<template>
    <div>
        <v-row class="mb-3">
            <v-col cols="12">
                <v-label class="font-weight-medium mb-1">Nova senha</v-label>
                <v-text-field variant="outlined" v-model="password" class="border-borderColor" type="password" hide-details
                              color="primary"></v-text-field>
            </v-col>
            <v-col cols="12">
                <v-label class="font-weight-medium mb-1">Confirme a senha</v-label>
                <v-text-field variant="outlined" v-model="password_confirm" class="border-borderColor" type="password" hide-details
                              color="primary"></v-text-field>
            </v-col>
            <v-col cols="12">
                <v-btn size="large" rounded="pill" color="primary" class="rounded-pill" block type="submit" flat
                       @click="submitForm">
                    Recuperar</v-btn>
            </v-col>
        </v-row>
    </div>
</template>
