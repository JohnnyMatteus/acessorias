<script setup lang="ts">
import { computed, nextTick, onMounted, ref } from 'vue';
const toast = useToast();
import indexOrders from '@/api/orders/Index';
import createOrder from '@/api/orders/Create';
import updateOrder from '@/api/orders/Update';
import deleteOrder from '@/api/orders/Delete';
import indexProducts from '@/api/products/Index';
import indexUsers from  '@/api/users/Index';

import { useToast } from 'vue-toastification';

interface Item {
    id: number,
        product_id: number,
        quantity: number,
        user_id: number,
        status: string,
        created_at: string,
        updated_at: string
    }
interface Product {
    id: number;
    name: string;
    description: string;
    price: string;
    stock: string;
    created_at:string;
    updated_at: string;
}
interface User {
    id: number,
    name: string,
    email: string,
    created_at: string,
    updated_at: string
}
interface StatusOption {
    text: string;
    value: string;
}

    const dialog = ref(false);
    const headers = ref([
        { text: 'Produto', value: 'product' },
        { text: 'Quantidade', value: 'quantity' },
        { text: 'Responsável', value: 'user' },
        { text: 'Status', value: 'status' },
        { text: 'Cadastro', value: 'created_at' },
        { text: 'Atualização', value: 'updated_at' },
        { text: 'Acões', value: 'actions', sortable: false }
    ]);

    const items = ref<Item[]>([]);
    const products = ref<Product[]>([]);
    const users = ref<User[]>([]);
    const editedIndex = ref(-1);
    const editedItem = ref<Item>({
        id: 0,
        product_id: 0,
        quantity: 0,
        user_id: 0,
        status: '',
        created_at:'',
        updated_at: ''
    });
    const statusOptions =  [
        { text: 'Ativo', value: 'A' },
        { text: 'Notificado', value: 'N' }
    ];

const itemst = ['foo', 'bar', 'fizz', 'buzz']
    const defaultItem = {
        product_id: 0,
        quantity: 0,
        user_id: 0,
        status: '',
    };

    const formTitle = computed(() => (editedIndex.value === -1 ? 'Nova ordem' : 'Editar ordem'));

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
            if (window.confirm('Deseja realmente excluir esta ordem?')) {
                const index = items.value.indexOf(item);
                await deleteOrder(item.id);
                items.value.splice(index, 1);
                toast.success('Ordem excluído com sucesso!');
            } else {
                toast.info('Exclusão de ordem cancelada.');
            }
        } catch (error) {
            console.error('Erro ao excluir ordem:', error.message);
            toast.error('Erro ao excluir ordem. Por favor, tente novamente.');
        }
    }

    const saveItem = async () => {
        try {
            if (editedIndex.value > -1) {
                await updateOrder(items.value[editedIndex.value].id, editedItem.value);
                toast.success('Atualização realizada com sucesso');
            } else {
                await createOrder(editedItem.value);
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
            const { data } = await indexOrders();
            items.value = data.map((item: any) => {
                return ({
                    id: item.id,
                    product_id: item.product_id,
                    quantity: item.quantity,
                    user_id: item.user_id,
                    status: item.status.toString(),
                    created_at: item.created_at,
                    updated_at: item.updated_at,
                    product: item.product,
                    user: item.user
                });
            });
        } catch (error) {
            console.error('Erro ao buscar ordens:', error.message);
        }
    };
    const fetchUsersData = async () => {
        try {
            const { data } = await indexUsers();
            users.value = data.map((item: any) => {
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
    const fetchProductsData = async () => {
    try {
        const { data } = await indexProducts();
        products.value = data.map((item: any) => {
            return ({
                id: item.id,
                name: item.name,
                description: item.description,
                price: item.price,
                stock: item.stock.toString(),
                created_at: item.created_at,
                updated_at: item.updated_at
            });
        });
    } catch (error) {
        console.error('Erro ao buscar produtos:', error.message);
    }
};

    onMounted(() => {
        fetchData();
        fetchUsersData();
        fetchProductsData();
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
                    <v-btn color="primary" @click="openDialog">Nova Ordem</v-btn>
                </v-toolbar>
            </template>

            <template v-slot:item.status="{ value }">
                <v-chip :color="value == 'A' ? 'primary': 'success'">
                    {{ value }}
                </v-chip>
            </template>

            <template v-slot:item.actions="{ item }">
                <v-icon small @click="editItem(item)">mdi-pencil</v-icon>
                <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
            </template>
        </v-data-table>

        <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{ on, attrs }"></template>
            <v-card>
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="6">
                                <v-autocomplete
                                    v-model="editedItem.product_id"
                                    :items="products"
                                    item-title="name"
                                    item-value="id"
                                    label="Produto"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field v-model="editedItem.quantity" label="Qunatity" type="number"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-autocomplete
                                    v-model="editedItem.user_id"
                                    :items="users"
                                    item-title="name"
                                    item-value="id"
                                    label="Usuário"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-autocomplete
                                    v-model="editedItem.status"
                                    :items="statusOptions"
                                    item-title="text"
                                    item-value="value"
                                    label="Status"
                                ></v-autocomplete>

                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeDialog">Fechar</v-btn>
                    <v-btn color="success" @click="saveItem">Salvar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<style scoped>

</style>