<script setup lang="ts">
import logoutUser from '@/api/auth/logoutUser';
import { useMutation } from '@tanstack/vue-query';
import { useRouter } from 'vue-router';
import { useToast } from "vue-toastification";
import auth from '@/services/auth';
const toast = useToast();
const router = useRouter();

const mutation = useMutation(logoutUser, {
    onMutate: () => {
        toast.info('Loading...', {
            timeout: false,
            id: 'loading-toast',
        });
    },
    onSuccess: (response) => {
        toast.dismiss('loading-toast');
        if (response.data) {
            auth.logout();
            router.push('/auth/login');
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
            toast.error('Erro ao deslogar');
            console.error('Erro ao deslogar:', error);
        }
    },
});

const submitForm = async () => {
    let mail = localStorage.getItem('email');
    mutation.mutate({
        email: mail
    });
};
</script>

<template>
    <!-- ---------------------------------------------- -->
    <!-- notifications DD -->
    <!-- ---------------------------------------------- -->
    <v-menu :close-on-content-click="false">
        <template v-slot:activator="{ props }">
            <v-btn class="" variant="text" v-bind="props" icon>
                <v-avatar size="35">
                    <img src="@/assets/images/profile/user-1.jpg" height="35" alt="user" />
                </v-avatar>
            </v-btn>
        </template>
        <v-sheet rounded="xl" width="200" elevation="10" class="mt-2">
            <div class="pt-4 pb-4 px-5 text-center">
                <v-btn color="primary" variant="outlined" class="rounded-pill" block @click="submitForm">Sair</v-btn>
            </div>
        </v-sheet>
    </v-menu>
</template>
