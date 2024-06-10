<script setup lang="ts">
import { computed, nextTick, onMounted, ref } from 'vue';
const toast = useToast();
import indexProducts from '@/api/products/Index';
import createProduct from '@/api/products/Create';
import updateProduct from '@/api/products/Update';
import deleteProduct from '@/api/products/Delete';
import { useToast } from 'vue-toastification';

interface Item {
        name: string;
        description: string;
        price: string;
        stock: string;
        created_at:string;
        updated_at: string;
    }

    const dialog = ref(false);
    const headers = ref([
        { text: 'Nome', value: 'name' },
        { text: 'Descrição', value: 'description' },
        { text: 'Preço', value: 'price' },
        { text: 'Estoque', value: 'stock' },
        { text: 'Cadastro', value: 'created_at' },
        { text: 'Atualização', value: 'updated_at' },
        { text: 'Acões', value: 'actions', sortable: false }
    ]);

    const items = ref<Item[]>([]);
    const editedIndex = ref(-1);
    const editedItem = ref<Item>({
        id: '',
        name: '',
        description: '',
        price: '',
        stock: '',
        created_at:'',
        updated_at: ''
    });

    const defaultItem = {
        id: '',
        name: '',
        description: '',
        price: '',
        stock: '',
    };

    const formTitle = computed(() => (editedIndex.value === -1 ? 'Novo produto' : 'Editar produto'));

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
            if (window.confirm('Deseja realmente excluir este produto?')) {
                const index = items.value.indexOf(item);
                await deleteProduct(item.id);
                items.value.splice(index, 1);
                toast.success('Produto excluído com sucesso!');
            } else {
                toast.info('Exclusão de produto cancelada.');
            }
        } catch (error) {
            console.error('Erro ao excluir produto:', error.message);
            toast.error('Erro ao excluir produto. Por favor, tente novamente.');
        }
    }

    const saveItem = async () => {
        try {
            if (editedIndex.value > -1) {
                await updateProduct(items.value[editedIndex.value].id, editedItem.value);
                toast.success('Atualização realizada com sucesso');
            } else {
                await createProduct(editedItem.value);
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
            const { data } = await indexProducts();
            items.value = data.map((item: any) => {
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
                    <v-btn color="primary" @click="openDialog">Novo Produto</v-btn>
                </v-toolbar>
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
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editedItem.description" label="Description"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editedItem.price" label="Price" type="number"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editedItem.stock" label="Stock" type="number"></v-text-field>
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