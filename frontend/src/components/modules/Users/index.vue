<script setup lang="ts">
import { computed, nextTick, onMounted, ref } from 'vue';
const toast = useToast();
import indexUsers from '@/api/users/Index';
import createUser from '@/api/users/Create';
import updateUser from '@/api/users/Update';
import deleteUser from '@/api/users/Delete';
import { useToast } from 'vue-toastification';

interface Item {
        id: number,
        name: string,
        email: string,
        created_at: string,
        updated_at: string
    }

    const dialog = ref(false);
    const headers = ref([
        { text: 'Nome', value: 'name' },
        { text: 'E-mail', value: 'email' },
        { text: 'Cadastro', value: 'created_at' },
        { text: 'Atualização', value: 'updated_at' }
    ]);

    const items = ref<Item[]>([]);
    const editedIndex = ref(-1);
    const editedItem = ref<Item>({
        id: 0,
        name: '',
        email: '',
        created_at:'',
        updated_at: ''
    });

    const defaultItem = {
        id: 0,
        name: '',
        email: ''
    };

    const formTitle = computed(() => (editedIndex.value === -1 ? 'Novo usuário' : 'Editar usuário'));

    function openDialog() {
        dialog.value = true;
    }

    function closeDialog() {
        dialog.value = false;
        nextTick(() => {
            editedItem.value = { ...defaultItem };
            editedIndex.value = -1;
        });
    }

    function editItem(item: Item) {
        editedIndex.value = items.value.indexOf(item);
        editedItem.value = { ...item };
        dialog.value = true;
    }

    const deleteItem = async (item: Item) =>{
        try {
            if (window.confirm('Deseja realmente excluir este usuário?')) {
                const index = items.value.indexOf(item);
                await deleteUser(item.id);
                items.value.splice(index, 1);
                toast.success('Usuário excluído com sucesso!');
            } else {
                toast.info('Exclusão de usuário cancelada.');
            }
        } catch (error) {
            console.error('Erro ao excluir usuário:', error.message);
            toast.error('Erro ao excluir usuário. Por favor, tente novamente.');
        }
    }

    const saveItem = async () => {
        try {
            if (editedIndex.value > -1) {
                await updateUser(items.value[editedIndex.value].id, editedItem.value);
                toast.success('Atualização realizada com sucesso');
            } else {
                await createUser(editedItem.value);
                toast.success('Cadastro realizado com sucesso');
            }
            fetchData();
            closeDialog();
        } catch (error) {
            console.error('Erro ao salvar item:', error.message);
        }
    };

    const fetchData = async () => {
        try {
            const { data } = await indexUsers();
            items.value = data.map((item: any) => {
                return ({
                    id: item.id,
                    name: item.name,
                    email: item.email,
                    created_at: item.created_at,
                    updated_at: item.updated_at
                });
            });
        } catch (error) {
            console.error('Erro ao buscar usuários:', error.message);
        }
    };

    onMounted(() => {
        fetchData();
    });
</script>

<template>
    <v-container>
        <v-data-table
            :headers="headers"
            :items="items"
            class="elevation-1"
            item-key="value"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title></v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                </v-toolbar>
            </template>
        </v-data-table>
    </v-container>
</template>

<style scoped>

</style>